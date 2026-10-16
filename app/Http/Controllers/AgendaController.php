<?php

namespace App\Http\Controllers;

use App\Models\BloqueioAgenda;
use App\Models\Consulta;
use App\Models\Disponibilidade;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    const FUSO = 'America/Sao_Paulo';

    const DURACAO = 60;

    private $diasCurtos = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];

    private $mesesCurtos = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    private $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

    private function minutos($hora)
    {
        $partes = explode(':', $hora);

        return ((int) $partes[0]) * 60 + (int) $partes[1];
    }

    private function horaTexto($minutos)
    {
        return sprintf('%02d:%02d', intdiv($minutos, 60), $minutos % 60);
    }

    private function hoje()
    {
        return Carbon::now(self::FUSO)->startOfDay();
    }

    public function index(Request $request)
    {
        $profissional = User::find(session('id'));
        $hoje = $this->hoje();

        $inicioSemana = $hoje->copy()->startOfWeek(Carbon::MONDAY);
        if ($request->semana && preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->semana)) {
            $inicioSemana = Carbon::createFromFormat('!Y-m-d', $request->semana, self::FUSO)->startOfWeek(Carbon::MONDAY);
        }
        $fimSemana = $inicioSemana->copy()->addDays(6);

        $janelas = [];
        $disponibilidades = Disponibilidade::where('codProfissionalSaude', session('id'))->get();
        foreach ($disponibilidades as $d) {
            $janelas[$d->diaSemana][] = [$this->minutos($d->horaInicio), $this->minutos($d->horaFim)];
        }

        $consultas = Consulta::with('usuaria')
            ->where('codProfissionalSaude', session('id'))
            ->where('statusConsulta', '!=', 'cancelada')
            ->whereBetween('dataHoraAgendada', [$inicioSemana->format('Y-m-d') . ' 00:00:00', $fimSemana->format('Y-m-d') . ' 23:59:59'])
            ->get();

        $bloqueios = BloqueioAgenda::where('codProfissionalSaude', session('id'))
            ->whereBetween('dataBloqueio', [$inicioSemana->format('Y-m-d'), $fimSemana->format('Y-m-d')])
            ->get();

        $dias = [];
        $horarios = []; 
        for ($i = 0; $i < 7; $i++) {
            $data = $inicioSemana->copy()->addDays($i);
            $dow = $data->dayOfWeek; 

            if (!isset($janelas[$dow])) {
                continue;
            }

            $slots = [];
            foreach ($janelas[$dow] as $janela) {
                for ($m = $janela[0]; $m + self::DURACAO <= $janela[1]; $m += self::DURACAO) {
                    $slots[$m] = true;
                    $horarios[$m] = true;
                }
            }

            $dias[] = [
                'data' => $data->format('Y-m-d'),
                'rotulo' => $this->diasCurtos[$dow] . ' ' . $data->format('d'),
                'hoje' => $data->format('Y-m-d') == $hoje->format('Y-m-d'),
                'slots' => $slots,
            ];
        }

        $horarios = array_keys($horarios);
        sort($horarios);

        $linhas = [];
        foreach ($horarios as $inicio) {
            $fim = $inicio + self::DURACAO;
            $celulas = [];

            foreach ($dias as $dia) {
                $celula = ['tipo' => 'fora'];

                if (isset($dia['slots'][$inicio])) {
                    $celula = ['tipo' => 'disponivel'];

                    foreach ($bloqueios as $b) {
                        if ($b->dataBloqueio->format('Y-m-d') == $dia['data']
                            && $this->minutos($b->horaInicio) < $fim
                            && $this->minutos($b->horaFim) > $inicio) {
                            $celula = [
                                'tipo' => 'bloqueado',
                                'id' => $b->codBloqueio,
                                'motivo' => BloqueioAgenda::MOTIVOS[$b->motivoBloqueio] ?? 'Bloqueio',
                                'data' => $b->dataBloqueio->format('d/m/Y'),
                                'intervalo' => $this->horaTexto($this->minutos($b->horaInicio)) . ' às ' . $this->horaTexto($this->minutos($b->horaFim)),
                            ];
                        }
                    }

                    foreach ($consultas as $c) {
                        $minutoConsulta = $c->dataHoraAgendada->hour * 60 + $c->dataHoraAgendada->minute;
                        if ($c->dataHoraAgendada->format('Y-m-d') == $dia['data'] && $minutoConsulta >= $inicio && $minutoConsulta < $fim) {
                            $celula = [
                                'tipo' => 'ocupado',
                                'id' => $c->codConsulta,
                                'nome' => $this->nomeUsuaria($c->usuaria),
                                'detalhe' => $c->tipoConsulta == 'duvida_rapida' ? 'Dúvida rápida' : 'Consulta',
                                'data' => $c->dataHoraAgendada->format('d/m/Y'),
                                'hora' => $c->dataHoraAgendada->format('H:i'),
                                'status' => Consulta::STATUS[$c->statusConsulta] ?? $c->statusConsulta,
                            ];
                        }
                    }
                }

                $celulas[] = $celula;
            }

            $linhas[] = ['hora' => $this->horaTexto($inicio), 'celulas' => $celulas];
        }

        $mesInicio = (int) $inicioSemana->format('n') - 1;
        $mesFim = (int) $fimSemana->format('n') - 1;
        if ($mesInicio == $mesFim) {
            $tituloMes = $this->meses[$mesInicio] . ' ' . $inicioSemana->format('Y');
        } else {
            $tituloMes = $this->mesesCurtos[$mesInicio] . ' / ' . $this->mesesCurtos[$mesFim] . ' ' . $fimSemana->format('Y');
        }

        $semanaAnterior = $inicioSemana->copy()->subWeek()->format('Y-m-d');
        $semanaSeguinte = $inicioSemana->copy()->addWeek()->format('Y-m-d');
        $semanaAtual = $inicioSemana->format('Y-m-d');
        $dataMinima = $hoje->format('Y-m-d');
        $motivos = BloqueioAgenda::MOTIVOS;

        return view('painelProfissional.agenda', compact(
            'profissional', 'dias', 'linhas', 'tituloMes',
            'semanaAnterior', 'semanaSeguinte', 'semanaAtual', 'dataMinima', 'motivos'
        ));
    }

    private function nomeUsuaria($usuaria)
    {
        if (!$usuaria) {
            return 'Usuária';
        }

        if ($usuaria->anonimaPadraoUsuario) {
            return 'Usuária anônima #' . $usuaria->codUsuario;
        }

        return $usuaria->apelidoUsuario ?: $usuaria->nomeUsuario;
    }

    public function bloquear(Request $request)
    {
        $request->validate([
            'dataBloqueio' => 'required|date_format:Y-m-d|after_or_equal:' . $this->hoje()->format('Y-m-d'),
            'motivoBloqueio' => 'required|in:' . implode(',', array_keys(BloqueioAgenda::MOTIVOS)),
            'horaInicio' => 'required|date_format:H:i',
            'horaFim' => 'required|date_format:H:i|after:horaInicio',
        ], [
            'dataBloqueio.required' => 'Informe a data.',
            'dataBloqueio.date_format' => 'Informe uma data válida.',
            'dataBloqueio.after_or_equal' => 'Escolha uma data de hoje em diante.',

            'motivoBloqueio.required' => 'Escolha o motivo.',
            'motivoBloqueio.in' => 'Motivo inválido.',

            'horaInicio.required' => 'Informe o horário de início.',
            'horaInicio.date_format' => 'Horário de início inválido.',

            'horaFim.required' => 'Informe o horário de fim.',
            'horaFim.date_format' => 'Horário de fim inválido.',
            'horaFim.after' => 'O horário de fim deve ser depois do início.',
        ]);

        $inicio = $this->minutos($request->horaInicio);
        $fim = $this->minutos($request->horaFim);

        $consultas = Consulta::where('codProfissionalSaude', session('id'))
            ->where('statusConsulta', '!=', 'cancelada')
            ->whereDate('dataHoraAgendada', $request->dataBloqueio)
            ->get();

        foreach ($consultas as $c) {
            $minutoConsulta = $c->dataHoraAgendada->hour * 60 + $c->dataHoraAgendada->minute;
            if ($minutoConsulta < $fim && $minutoConsulta + self::DURACAO > $inicio) {
                return back()
                    ->withErrors([
                        'horaInicio' => 'Já existe um atendimento marcado às ' . $this->horaTexto($minutoConsulta) . ' nesse período.'
                    ])
                    ->withInput();
            }
        }

        BloqueioAgenda::create([
            'codProfissionalSaude' => session('id'),
            'dataBloqueio' => $request->dataBloqueio,
            'horaInicio' => $request->horaInicio,
            'horaFim' => $request->horaFim,
            'motivoBloqueio' => $request->motivoBloqueio,
        ]);

        return redirect()
            ->route('agenda.index', ['semana' => $request->dataBloqueio])
            ->with('sucesso', 'Horário bloqueado com sucesso.');
    }

    public function desbloquear(Request $request, $id)
    {
        $bloqueio = BloqueioAgenda::where('codBloqueio', $id)
            ->where('codProfissionalSaude', session('id'))
            ->first();

        if (!$bloqueio) {
            return redirect()->route('agenda.index')->with('erro', 'Bloqueio não encontrado.');
        }

        $semana = $bloqueio->dataBloqueio->format('Y-m-d');
        $bloqueio->delete();

        return redirect()
            ->route('agenda.index', ['semana' => $semana])
            ->with('sucesso', 'Bloqueio removido. O horário voltou a ficar disponível.');
    }


    private function consultaDoProfissional($id)
    {
        return Consulta::with('usuaria')
            ->where('codConsulta', $id)
            ->where('codProfissionalSaude', session('id'))
            ->firstOrFail();
    }

    public function editar($id)
    {
        $profissional = User::find(session('id'));
        $consulta = $this->consultaDoProfissional($id);
        $nomePaciente = $this->nomeUsuaria($consulta->usuaria);
        $statusLista = Consulta::STATUS;
        $tiposLista = Consulta::TIPOS;
        $dataMinima = $this->hoje()->format('Y-m-d');

        return view('painelProfissional.editar-consulta', compact(
            'profissional', 'consulta', 'nomePaciente', 'statusLista', 'tiposLista', 'dataMinima'
        ));
    }

    public function atualizar(Request $request, $id)
    {
        $consulta = $this->consultaDoProfissional($id);

        $request->validate([
            'nomeConsulta' => 'required|string|max:120',
            'tipoConsulta' => 'required|in:' . implode(',', array_keys(Consulta::TIPOS)),
            'data' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
            'statusConsulta' => 'required|in:' . implode(',', array_keys(Consulta::STATUS)),
            'historicoConsulta' => 'nullable|string|max:2000',
        ], [
            'nomeConsulta.required' => 'Informe o título da consulta.',
            'nomeConsulta.max' => 'O título pode ter no máximo 120 caracteres.',
            'tipoConsulta.required' => 'Escolha o tipo de atendimento.',
            'tipoConsulta.in' => 'Tipo de atendimento inválido.',
            'data.required' => 'Informe a data.',
            'data.date_format' => 'Informe uma data válida.',
            'hora.required' => 'Informe o horário.',
            'hora.date_format' => 'Informe um horário válido.',
            'statusConsulta.required' => 'Escolha o status.',
            'statusConsulta.in' => 'Status inválido.',
            'historicoConsulta.max' => 'As observações podem ter no máximo 2000 caracteres.',
        ]);

        $quando = $request->data . ' ' . $request->hora;
        $mudouHorario = !$consulta->dataHoraAgendada
            || $consulta->dataHoraAgendada->format('Y-m-d H:i') != $quando;
        $ativa = in_array($request->statusConsulta, ['aguardando', 'em_andamento']);

        if ($mudouHorario && $ativa) {
            $erro = $this->erroDeHorario($request->data, $request->hora, $consulta->codConsulta);
            if ($erro) {
                return back()->withErrors(['hora' => $erro])->withInput();
            }
        }

        $consulta->nomeConsulta = $request->nomeConsulta;
        $consulta->tipoConsulta = $request->tipoConsulta;
        $consulta->statusConsulta = $request->statusConsulta;
        $consulta->dataHoraAgendada = $quando . ':00';
        $consulta->historicoConsulta = $request->historicoConsulta;
        $consulta->save();

        return redirect()
            ->route('agenda.index', ['semana' => $request->data])
            ->with('sucesso', $request->statusConsulta == 'cancelada'
                ? 'Consulta cancelada. O horário voltou a ficar disponível.'
                : 'Consulta atualizada com sucesso.');
    }

    private function erroDeHorario($data, $hora, $idConsulta)
    {
        if ($data . ' ' . $hora < Carbon::now(self::FUSO)->format('Y-m-d H:i')) {
            return 'Escolha uma data e um horário a partir de agora.';
        }

        $inicio = $this->minutos($hora);
        $fim = $inicio + self::DURACAO;
        $diaSemana = Carbon::createFromFormat('!Y-m-d', $data, self::FUSO)->dayOfWeek;

        $dentro = false;
        $janelas = Disponibilidade::where('codProfissionalSaude', session('id'))->where('diaSemana', $diaSemana)->get();
        foreach ($janelas as $j) {
            if ($this->minutos($j->horaInicio) <= $inicio && $this->minutos($j->horaFim) >= $fim) {
                $dentro = true;
            }
        }
        if (!$dentro) {
            return 'Esse horário está fora do seu período de atendimento.';
        }

        $bloqueios = BloqueioAgenda::where('codProfissionalSaude', session('id'))->whereDate('dataBloqueio', $data)->get();
        foreach ($bloqueios as $b) {
            if ($this->minutos($b->horaInicio) < $fim && $this->minutos($b->horaFim) > $inicio) {
                return 'Esse horário está bloqueado na sua agenda.';
            }
        }

        $outras = Consulta::where('codProfissionalSaude', session('id'))
            ->where('codConsulta', '!=', $idConsulta)
            ->where('statusConsulta', '!=', 'cancelada')
            ->whereDate('dataHoraAgendada', $data)
            ->get();
        foreach ($outras as $o) {
            $m = $o->dataHoraAgendada->hour * 60 + $o->dataHoraAgendada->minute;
            if ($m < $fim && $m + self::DURACAO > $inicio) {
                return 'Já existe outro atendimento marcado às ' . $this->horaTexto($m) . '.';
            }
        }

        return null;
    }
}
