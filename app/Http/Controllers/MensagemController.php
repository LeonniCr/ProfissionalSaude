<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use App\Models\User;
use Illuminate\Http\Request;

class MensagemController extends Controller
{
    private function eu(): int
    {
        return (int) session('id');
    }

    private function usuario(User $u): array
    {
        return [
            'codigo' => $u->codProfissionalSaude,
            'nome' => $u->nomeProfissionalSaude,
            'inicial' => mb_strtoupper(mb_substr($u->nomeProfissionalSaude ?? 'P', 0, 1)),
            'foto' => $u->fotoPerfilProfissional,
            'subtitulo' => $u->especialidadeProfissionalSaude ?: $u->categoriaProfissional,
        ];
    }

    private function hora($data): string
    {
        return $data->isToday() ? $data->format('H:i') : $data->format('d/m H:i');
    }

    // Só profissionais ativos e aprovados podem receber mensagens
    private function contatoValido(int $id): ?User
    {
        return User::where('codProfissionalSaude', $id)
            ->where('codProfissionalSaude', '!=', $this->eu())
            ->where('statusConta', 'Ativa')
            ->where('statusVerificacao', 'Aprovado')
            ->first();
    }

    public function conversas()
    {
        $eu = $this->eu();

        $mensagens = Mensagem::where('codRemetente', $eu)
            ->orWhere('codDestinatario', $eu)
            ->orderByDesc('codMensagem')
            ->get();

        $grupos = [];
        foreach ($mensagens as $m) {
            $outro = $m->codRemetente == $eu ? $m->codDestinatario : $m->codRemetente;
            if (!isset($grupos[$outro])) {
                $grupos[$outro] = ['ultima' => $m, 'naoLidas' => 0];
            }
            if ($m->codDestinatario == $eu && !$m->lidaMensagem) {
                $grupos[$outro]['naoLidas']++;
            }
        }

        $usuarios = User::whereIn('codProfissionalSaude', array_keys($grupos))->get()->keyBy('codProfissionalSaude');

        $lista = [];
        foreach ($grupos as $id => $g) {
            if (!isset($usuarios[$id])) {
                continue;
            }
            $lista[] = $this->usuario($usuarios[$id]) + [
                'ultima' => $g['ultima']->textoMensagem,
                'minha' => $g['ultima']->codRemetente == $eu,
                'hora' => $this->hora($g['ultima']->dataEnvio),
                'naoLidas' => $g['naoLidas'],
            ];
        }

        return response()->json($lista);
    }

    public function buscar(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        if ($q === '') {
            return response()->json([]);
        }

        $usuarios = User::where('codProfissionalSaude', '!=', $this->eu())
            ->where('statusConta', 'Ativa')
            ->where('statusVerificacao', 'Aprovado')
            ->where('nomeProfissionalSaude', 'like', '%' . $q . '%')
            ->orderBy('nomeProfissionalSaude')
            ->limit(15)
            ->get();

        return response()->json($usuarios->map(fn ($u) => $this->usuario($u))->values());
    }

    public function mensagens($id)
    {
        $eu = $this->eu();
        $outro = $this->contatoValido((int) $id);

        if (!$outro) {
            return response()->json(['erro' => 'Profissional não encontrado.'], 404);
        }

        $entre = fn ($q) => $q->where(function ($w) use ($eu, $outro) {
            $w->where('codRemetente', $eu)->where('codDestinatario', $outro->codProfissionalSaude);
        })->orWhere(function ($w) use ($eu, $outro) {
            $w->where('codRemetente', $outro->codProfissionalSaude)->where('codDestinatario', $eu);
        });

        // Marca como lidas as mensagens recebidas
        Mensagem::where('codRemetente', $outro->codProfissionalSaude)
            ->where('codDestinatario', $eu)
            ->where('lidaMensagem', false)
            ->update(['lidaMensagem' => true]);

        $mensagens = Mensagem::where($entre)->orderBy('codMensagem')->limit(300)->get();

        return response()->json([
            'usuario' => $this->usuario($outro),
            'mensagens' => $mensagens->map(fn ($m) => [
                'id' => $m->codMensagem,
                'texto' => $m->textoMensagem,
                'minha' => $m->codRemetente == $eu,
                'hora' => $this->hora($m->dataEnvio),
            ])->values(),
        ]);
    }

    public function enviar(Request $request)
    {
        $dados = $request->validate([
            'destinatario' => 'required|integer',
            'texto' => 'required|string|max:2000',
        ]);

        $outro = $this->contatoValido((int) $dados['destinatario']);

        if (!$outro) {
            return response()->json(['erro' => 'Profissional não encontrado.'], 404);
        }

        $m = Mensagem::create([
            'codRemetente' => $this->eu(),
            'codDestinatario' => $outro->codProfissionalSaude,
            'textoMensagem' => trim($dados['texto']),
        ])->fresh();

        return response()->json([
            'id' => $m->codMensagem,
            'texto' => $m->textoMensagem,
            'minha' => true,
            'hora' => $this->hora($m->dataEnvio),
        ]);
    }
}