<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use App\Models\User;
use Illuminate\Http\Request;

class ConteudoController extends Controller
{
    public function index(Request $request)
    {
        $profissional = User::find(session('id'));

        $consulta = Conteudo::with(['categoria', 'tipo'])
            ->where('codProfissionalSaude', session('id'));

        $statusAtivo = null;
        if ($request->status && array_key_exists($request->status, Conteudo::STATUS)) {
            $statusAtivo = $request->status;
            $consulta->where('statusConteudo', $statusAtivo);
        }

        $conteudos = $consulta->orderBy('dataCriacao', 'desc')->get();

        $categorias = TipoCategoria::orderBy('codTipoCategoria')->get();
        $tipos = TipoConteudo::orderBy('codTipoConteudo')->get();

        return view('painelProfissional.conteudo', compact('profissional', 'conteudos', 'statusAtivo', 'categorias', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tituloConteudo' => 'required|string|max:150',
            'codTipoCategoria' => 'required|exists:tbtipocategoria,codTipoCategoria',
            'codTipoConteudo' => 'required|exists:tbtipoconteudo,codTipoConteudo',
            'corpoConteudo' => 'required_if:acao,revisao|nullable|string',
            'acao' => 'required|in:rascunho,revisao',
        ], [
            'tituloConteudo.required' => 'Informe o título do conteúdo.',
            'tituloConteudo.max' => 'O título deve ter no máximo 150 caracteres.',

            'codTipoCategoria.required' => 'Escolha uma categoria.',
            'codTipoCategoria.exists' => 'Categoria inválida.',

            'codTipoConteudo.required' => 'Escolha o formato.',
            'codTipoConteudo.exists' => 'Formato inválido.',

            'corpoConteudo.required_if' => 'Escreva o conteúdo antes de enviar para revisão.',
        ]);

        if ($request->acao == 'revisao') {
            $status = 'em_revisao';
            $mensagem = 'Conteúdo enviado para revisão editorial.';
        } else {
            $status = 'rascunho';
            $mensagem = 'Rascunho salvo com sucesso.';
        }
        
        $corpo = $request->corpoConteudo ?? '';

        Conteudo::create([
            'tituloConteudo' => $request->tituloConteudo,
            'corpoConteudo' => $corpo,
            'tempoLeituraMinutos' => Conteudo::calcularTempoLeitura($corpo),
            'codTipoCategoria' => $request->codTipoCategoria,
            'codTipoConteudo' => $request->codTipoConteudo,
            'codProfissionalSaude' => session('id'),
            'statusConteudo' => $status,
        ]);

        return redirect()->route('conteudos.index')->with('sucesso', $mensagem);
    }

    public function update(Request $request, $id)
    {
        $conteudo = Conteudo::where('codConteudo', $id)
            ->where('codProfissionalSaude', session('id'))
            ->first();

        if (!$conteudo) {
            return redirect()->route('conteudos.index')->with('erro', 'Conteúdo não encontrado.');
        }

        if ($conteudo->statusConteudo == 'em_revisao') {
            return redirect()->route('conteudos.index')->with('erro', 'Este conteúdo está em revisão e não pode ser editado agora.');
        }

        $request->validate([
            'tituloConteudo' => 'required|string|max:150',
            'codTipoCategoria' => 'required|exists:tbtipocategoria,codTipoCategoria',
            'codTipoConteudo' => 'required|exists:tbtipoconteudo,codTipoConteudo',
            'corpoConteudo' => 'required_if:acao,revisao|nullable|string',
            'acao' => 'required|in:rascunho,privar,revisao',
        ], [
            'tituloConteudo.required' => 'Informe o título do conteúdo.',
            'tituloConteudo.max' => 'O título deve ter no máximo 150 caracteres.',

            'codTipoCategoria.required' => 'Escolha uma categoria.',
            'codTipoCategoria.exists' => 'Categoria inválida.',

            'codTipoConteudo.required' => 'Escolha o formato.',
            'codTipoConteudo.exists' => 'Formato inválido.',

            'corpoConteudo.required_if' => 'Escreva o conteúdo antes de enviar para revisão.',
        ]);

        if ($request->acao == 'privar' && $conteudo->statusConteudo != 'publicado') {
            return redirect()->route('conteudos.index')->with('erro', 'Só é possível privar um conteúdo publicado.');
        }

        if ($request->acao == 'revisao') {
            $status = 'em_revisao';
            $mensagem = 'Conteúdo enviado para revisão editorial.';
        } elseif ($request->acao == 'privar') {
            $status = 'rascunho';
            $mensagem = 'Conteúdo privado: ele não está mais público.';
        } else {
            $status = 'rascunho';
            $mensagem = 'Rascunho salvo com sucesso.';
        }

        $corpo = $request->corpoConteudo ?? '';

        $conteudo->tituloConteudo = $request->tituloConteudo;
        $conteudo->corpoConteudo = $corpo;
        $conteudo->tempoLeituraMinutos = Conteudo::calcularTempoLeitura($corpo);
        $conteudo->codTipoCategoria = $request->codTipoCategoria;
        $conteudo->codTipoConteudo = $request->codTipoConteudo;
        $conteudo->statusConteudo = $status;
        $conteudo->save();

        return redirect()->route('conteudos.index')->with('sucesso', $mensagem);
    }
}
