<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:tbProfissional,emailProfissional|max:255',
            'cpf' => 'required|string|max:14|unique:tbProfissional,cpfProfissional',
            'telefone' => 'required|string|max:15',
            'dataNasc' => 'required|date',
            'senha' => 'required|string|min:8',
            'categoria' => 'required|string|max:17',
            'especialidade' => 'required|string|max:255',
            'conselho' => 'required|string|max:5',
            'numConselho' => 'required|string|max:9',
            'ufConselho' => 'required|string|max:2',
            'comprovanteConselho' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'docComplementar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'apresentacao' => 'nullable|string|max:400',
            'fotoPerfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'atendeChat' => 'boolean',
            'atendeDuvidaRapido' => 'boolean',
            'atendePresencial' => 'boolean',
        ], [
            'nome.required' => 'Campo nome obrigatório.',
            'email.required' => 'Campo email obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'cpf.required' => 'Campo CPF obrigatório.',
            'telefone.required' => 'Campo telefone obrigatório.',
            'dataNasc.required' => 'Campo data de nascimento obrigatório.',
            'senha.required' => 'Campo senha obrigatório.',
            'categoria.required' => 'Campo categoria obrigatório.',
            'especialidade.required' => 'Campo especialidade  obrigatório.',
            'conselho.required' => 'Campo conselho obrigatório.',
            'numConselho.required' => 'Campo número do conselho obrigatório.',
            'ufConselho.required' => 'Campo UF do conselho obrigatório.',
            'comprovanteConselho.required' => 'Campo comprovante do conselho obrigatório.',
            'comprovanteConselho.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp.',
            'comprovanteConselho.max' => 'O arquivo deve ter no máximo 2 MB.',
            'docComplementar.required' => 'Campo documento complementar obrigatório',
            'docComplementar.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp.',
            'docComplementar.max' => 'O arquivo deve ter no máximo 2 MB.',
            'fotoPerfil.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp',
            'fotoPerfil.max' => 'O arquivo deve ter no máximo 2 MB',

        ]);

        User::create([
            'nomeProfissional' => $request->nome,
            'emailProfissional' => $request->email,
            'cpfProfissional' => $request->cpf,
            'telefoneProfissional' => $request->telefone,
            'dataNascProfissional' => $request->dataNasc,
            'senhaProfissional' => Hash::make($request->senha),
            'categoriaProfissional' => $request->categoria,
            'especialidadeProfissional' => $request->especialidade,
            'conselhoClasseProfissional' => $request->conselho,
            'numConselhoProfissional' => $request->numConselho,
            'ufConselhoProfissional' => $request->ufConselho,
            'comprovanteConselhoProfissional' => $request->comprovanteConselho,
            'docComplementarProfissional' => $request->docComplementar,
            'apresentacaoProfissional' => $request->apresentacao,
            'fotoPerfilProfissional' => $request->fotoPerfil,
            'atendeChatProfissional' => $request->boolean('atendeChat'),
            'atendeDuvidaRapidoProfissional' => $request->boolean('atendeDuvidaRapido'),
            'atendePresencialProfissional' => $request->boolean('atendePresencial'),
            'statusVerificacaoProfissional' => 'em_analise',
            'statusContaProfissional' => 'ativa',
        ]);

        return redirect('/')->with('sucesso', 'Conta criada com sucesso!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ], [
            'login.required' => 'Campo obrigatório.',
            'senha.required' => 'Campo obrigatório.',
        ]);

        $user = User::where('emailProfissional', $request->login)
            ->orWhere('numConselhoProfissional', $request->login)
            ->first();

        if ($user && $user->statusContaProfissional == 'desabilitada') {
            return redirect('/')->with('erro', 'Esta conta não existe.');
        }elseif (!$user || !Hash::check($request->senha, $user->senhaProfissional)) {
            return redirect('/')->with('erro', 'Email/Número do conselho ou senha incorretos');
        }

        $request->session()->regenerate();

        session([
            'id' => $user->id,
            'nomeProfissional' => $user->nomeProfissional,
        ]);

        return redirect()->route('painel.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }

    public function perfil()
    {
        $profissional = User::find(session('id'));

        return view('user.perfil-profissional', compact('profissional'));
    }

    public function editar()
    {
        $profissional = User::find(session('id'));

        return view('user.update-profissional', compact('profissional'));
    }

    public function atualizar(Request $request)
    {
        $profissional = User::find(session('id'));

        if (!$profissional) {
            return redirect('/')->with('erro', 'Profissional não encontrado.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tbProfissional,emailProfissional,' . $profissional->id . ',id',
            
            'telefone' => 'required|string|max:15',
            'dataNasc' => 'required|date',
            'categoria' => 'required|string|max:17',
            'especialidade' => 'required|string|max:255',
            'conselho' => 'required|string|max:5',
            'numConselho' => 'required|string|max:9',
            'ufConselho' => 'required|string|max:2',
            'apresentacao' => 'nullable|string|max:400',

            'fotoPerfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'atendeChat' => 'boolean',
            'atendeDuvidaRapido' => 'boolean',
            'atendePresencial' => 'boolean',
        ], [
            'nome.required' => 'Campo nome obrigatório.',
            'email.required' => 'Campo email obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            
            'telefone.required' => 'Campo telefone obrigatório.',
            'dataNasc.required' => 'Campo data de nascimento obrigatório.',
            'categoria.required' => 'Campo categoria obrigatório.',
            'especialidade.required' => 'Campo especialidade obrigatório.',
            'conselho.required' => 'Campo conselho obrigatório.',
            'numConselho.required' => 'Campo número do conselho obrigatório.',
            'ufConselho.required' => 'Campo UF do conselho obrigatório.',
            'fotoPerfil.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp.',
            'fotoPerfil.max' => 'O arquivo deve ter no máximo 2 MB.',
        ]);

        $profissional->nomeProfissional = $request->nome;
        $profissional->emailProfissional = $request->email;
        $profissional->telefoneProfissional = $request->telefone;
        $profissional->dataNascProfissional = $request->dataNasc;
        $profissional->categoriaProfissional = $request->categoria;
        $profissional->especialidadeProfissional = $request->especialidade;
        $profissional->conselhoClasseProfissional = $request->conselho;
        $profissional->numConselhoProfissional = $request->numConselho;
        $profissional->ufConselhoProfissional = $request->ufConselho;
        $profissional->apresentacaoProfissional = $request->apresentacao;

        $profissional->atendeChatProfissional = $request->boolean('atendeChat');
        $profissional->atendeDuvidaRapidoProfissional = $request->boolean('atendeDuvidaRapido');
        $profissional->atendePresencialProfissional = $request->boolean('atendePresencial');

        // Atualiza a foto somente se o usuário enviar uma nova
        if ($request->hasFile('fotoPerfil')) {
            $profissional->fotoPerfilProfissional = $request->file('fotoPerfil');
        }

        $profissional->save();

        return redirect('user.perfil-profissional')
            ->with('sucesso', 'Perfil atualizado com sucesso!');
        
    
    }


    public function mudarSenha()
    {
        return view('user.mudar-senha');
    }

    public function atualizarSenha(Request $request)
    {
        $request->validate([
            'senhaAtual' => 'required',
            'novaSenha' => 'required|min:8',
            'confirmarSenha' => 'required|same:novaSenha',
        ]);

        $profissional = User::find(session('id'));

        if (!Hash::check($request->senhaAtual, $profissional->senhaProfissional)) {
            return back()->withErrors([
                'senhaAtual' => 'A senha atual está incorreta.'
            ]);
        }

        $profissional->senhaProfissional = Hash::make($request->novaSenha);
        $profissional->save();

        return back()->with('sucesso', 'Senha alterada com sucesso!');
    }

    public function desativarConta()
    {
        $profissional = User::find(session('id'));

        $profissional->statusContaProfissional = 'desabilitada';
        $profissional->save();

        session()->forget('id');

        return redirect('/')->with('sucesso', 'Sua conta foi desativada.');
    }

    public function dashboard(){
        $profissional = User::find(session('id'));

        return view('painelProfissional.dashboard', compact('profissional'));
    }

    public function indexApi()
    {
        $user = User::orderby('created_at', 'desc')->get();
        return response()->json($user);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:tbProfissional,emailProfissional|max:255',
            'cpf' => 'required|string|max:14|unique:tbProfissional,cpfProfissional',
            'telefone' => 'required|string|max:15',
            'dataNasc' => 'required|date',
            'senha' => 'required|string|min:8',
            'categoria' => 'required|string|max:17',
            'especialidade' => 'required|string|max:255',
            'conselho' => 'required|string|max:5',
            'numConselho' => 'required|string|max:9',
            'ufConselho' => 'required|string|max:2',
            'comprovanteConselho' => 'required|string|max:255',
            'docComplementar' => 'required|string|max:255',
            'apresentacao' => 'nullable|string|max:400',
            'fotoPerfil' => 'nullable|string|max:255',
            'atendeChat' => 'required|boolean',
            'atendeDuvidaRapido' => 'required|boolean',
            'atendePresencial' => 'required|boolean',
        ]);

        $user = User::create([
            'nomeProfissional' => $request->nome,
            'emailProfissional' => $request->email,
            'cpfProfissional' => $request->cpf,
            'telefoneProfissional' => $request->telefone,
            'dataNascProfissional' => $request->dataNasc,
            'senhaProfissional' => Hash::make($request->senha),
            'categoriaProfissional' => $request->categoria,
            'especialidadeProfissional' => $request->especialidade,
            'conselhoClasseProfissional' => $request->conselho,
            'numConselhoProfissional' => $request->numConselho,
            'ufConselhoProfissional' => $request->ufConselho,
            'comprovanteConselhoProfissional' => $request->comprovanteConselho,
            'docComplementarProfissional' => $request->docComplementar,
            'apresentacaoProfissional' => $request->apresentacao,
            'fotoPerfilProfissional' => $request->fotoPerfil,
            'atendeChatProfissional' => $request->atendeChat,
            'atendeDuvidaRapidoProfissional' => $request->atendeDuvidaRapido,
            'atendePresencialProfissional' => $request->atendePresencial,
            'statusVerificacaoProfissional' => $request->statusVerificacao,
            'statusContaProfissional' => $request->statusConta,
        ]);

        return response()->json($user);
    }

    public function updateApi(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        return response()->json([
            'message' => 'Usuário alterado com sucesso',
            'user' => $user
        ]);
    }

    public function destroyApi(string $id)
    {
        User::where('id', $id)->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso',
            'code'    => 200
        ]);
    }

    public function countUserApi()
    {
        return response()->json([
            'count' => User::count(),
            'code'  => 200
        ]);
    }
}
