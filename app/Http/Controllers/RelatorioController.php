<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Mensagem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    const POR_PAGINA = 10;

    const TIPOS = ['agendada' => 'Consulta por chat', 'duvida_rapida' => 'Dúvida rápida'];

    private $mesesCurtos = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    private function periodo(Request $request)
    {
        $hoje = Carbon::now(AgendaController::FUSO)->startOfDay();
        $chave = in_array($request->periodo, ['7', '30', '90', 'personalizado']) ? $request->periodo : '30';
        $erro = null;
        $inicio = null;
        $fim = null;

        if ($chave == 'personalizado') {
            $v = validator($request->all(), [
                'inicio' => 'required|date_format:Y-m-d',
                'fim' => 'required|date_format:Y-m-d',
            ], [
                'inicio.required' => 'Informe a data inicial.',
                'inicio.date_format' => 'Data inicial inválida.',
                'fim.required' => 'Informe a data final.',
                'fim.date_format' => 'Data final inválida.',
            ]);

            if ($v->fails()) {
                $erro = $v->errors()->first();
            } else {
                $inicio = Carbon::createFromFormat('!Y-m-d', $request->inicio, AgendaController::FUSO);
                $fim = Carbon::createFromFormat('!Y-m-d', $request->fim, AgendaController::FUSO);

                if ($fim->lt($inicio)) {
                    $erro = 'A data final deve ser igual ou depois da data inicial.';
                } elseif ($fim->gt($inicio->copy()->addDays(366))) {
                    $erro = 'O período personalizado pode ter no máximo 1 ano.';
                } elseif ($fim->gt($hoje)) {
                    $fim = $hoje->copy();
                    if ($inicio->gt($fim)) {
                        $erro = 'A data inicial não pode estar no futuro.';
                    }
                }
            }

            if ($erro) {
                $chave = '30';
            }
        }

        if ($chave != 'personalizado') {
            $inicio = $hoje->copy()->subDays((int) $chave - 1);
            $fim = $hoje->copy();
        }

        return [$chave, $inicio, $fim, $erro];
    }

    private function duracao($segundos)
    {
        if ($segundos === null) {
            return '—';
        }

        $min = (int) round($segundos / 60);
        if ($min < 1) return 'menos de 1 min';
        if ($min < 60) return $min . ' min';

        $h = intdiv($min, 60);
        $m = $min % 60;
        if ($h >= 24) return intdiv($h, 24) . 'd ' . ($h % 24) . 'h';

        return $m == 0 ? $h . 'h' : $h . 'h ' . $m . 'min';
    }

    private function tempoMedioResposta($ini, $final)
    {
        $conversas = Mensagem::where('codProfissionalSaude', session('id'))
            ->where('dataEnvio', '>=', $ini)
            ->orderBy('dataEnvio')->orderBy('codMensagem')
            ->get()->groupBy('codUsuario');

        $soma = 0;
        $qtd = 0;

        foreach ($conversas as $mensagens) {
            $aguardando = null;

            foreach ($mensagens as $m) {
                if ($m->remetenteMensagem == 'usuario') {
                    if ($aguardando === null) {
                        $aguardando = $m->dataEnvio;
                    }
                } elseif ($aguardando !== null) {
                    if ($aguardando->format('Y-m-d H:i:s') <= $final) {
                        $soma += max(0, $m->dataEnvio->getTimestamp() - $aguardando->getTimestamp());
                        $qtd++;
                    }
                    $aguardando = null;
                }
            }
        }

        return $qtd ? $soma / $qtd : null;
    }

    private function montar(Request $request)
    {
        $profissional = User::find(session('id'));
        list($chave, $inicio, $fim, $erro) = $this->periodo($request);

        $ini = $inicio->format('Y-m-d') . ' 00:00:00';
        $final = $fim->format('Y-m-d') . ' 23:59:59';
        $data = function ($c) { return $c->dataHoraAgendada ?? $c->dataCriacao; };

        $consultas = Consulta::with('avaliacao')
            ->where('codProfissionalSaude', session('id'))
            ->whereIn('statusConsulta', PacienteController::STATUS_ATENDIDA)
            ->whereRaw('COALESCE(dataHoraAgendada, dataCriacao) BETWEEN ? AND ?', [$ini, $final])
            ->get()
            ->sortByDesc(function ($c) use ($data) { return $data($c)->format('Y-m-d H:i:s'); })
            ->values();

        $notas = $consultas->map(function ($c) { return $c->avaliacao ? $c->avaliacao->nota : null; })->filter();
        $cards = [
            'usuarias' => $consultas->pluck('codUsuario')->unique()->count(),
            'atendimentos' => $consultas->count(),
            'resposta' => $this->duracao($this->tempoMedioResposta($ini, $final)),
            'nota' => $notas->count() ? number_format($notas->avg(), 1, ',', '') : null,
            'avaliacoes' => $notas->count(),
        ];

        $mesFim = $fim->copy()->startOfMonth();
        $mesIni = $inicio->copy()->startOfMonth();
        $qtdMeses = ($fim->year - $inicio->year) * 12 + $fim->month - $inicio->month + 1;
        if ($qtdMeses < 6) $mesIni = $mesFim->copy()->subMonths(5);
        if ($qtdMeses > 12) $mesIni = $mesFim->copy()->subMonths(11);

        $porMes = Consulta::where('codProfissionalSaude', session('id'))
            ->whereIn('statusConsulta', PacienteController::STATUS_ATENDIDA)
            ->whereRaw('COALESCE(dataHoraAgendada, dataCriacao) BETWEEN ? AND ?', [$mesIni->format('Y-m-d') . ' 00:00:00', $final])
            ->get()
            ->groupBy(function ($c) use ($data) { return $data($c)->format('Y-m'); });

        $grafico = [];
        for ($m = $mesIni->copy(); $m->lte($mesFim); $m->addMonth()) {
            $grafico[] = [
                'rotulo' => $this->mesesCurtos[$m->month - 1] . '/' . $m->format('y'),
                'total' => isset($porMes[$m->format('Y-m')]) ? $porMes[$m->format('Y-m')]->count() : 0,
            ];
        }

        $linhas = $consultas->map(function ($c) use ($data) {
            return [
                'data' => $data($c)->format('d/m/Y - H:i'),
                'tipo' => self::TIPOS[$c->tipoConsulta] ?? $c->tipoConsulta,
                'nota' => $c->avaliacao ? (int) $c->avaliacao->nota : null,
            ];
        })->all();

        $periodoTexto = ($chave == 'personalizado' ? '' : 'Últimos ' . $chave . ' dias · ')
            . $inicio->format('d/m/Y') . ' a ' . $fim->format('d/m/Y');

        $filtro = ['periodo' => $chave];
        if ($chave == 'personalizado') {
            $filtro['inicio'] = $inicio->format('Y-m-d');
            $filtro['fim'] = $fim->format('Y-m-d');
        }

        return compact('profissional', 'chave', 'inicio', 'fim', 'erro', 'cards', 'grafico', 'linhas', 'periodoTexto', 'filtro');
    }

    public function index(Request $request)
    {
        $d = $this->montar($request);

        $total = count($d['linhas']);
        $paginas = max(1, (int) ceil($total / self::POR_PAGINA));
        $pagina = min(max(1, (int) $request->pagina), $paginas);

        $d['linhasTabela'] = array_slice($d['linhas'], ($pagina - 1) * self::POR_PAGINA, self::POR_PAGINA);
        $d['paginacao'] = ['pagina' => $pagina, 'paginas' => $paginas, 'total' => $total];
        $d['hoje'] = Carbon::now(AgendaController::FUSO)->format('Y-m-d');

        return view('painelProfissional.relatorios', $d);
    }

    public function exportar(Request $request)
    {
        $d = $this->montar($request);
        $d['linhasTabela'] = $d['linhas'];
        $d['paginacao'] = null;
        $d['geradoEm'] = Carbon::now(AgendaController::FUSO)->format('d/m/Y H:i');

        return view('painelProfissional.relatorio-pdf', $d);
    }
}
