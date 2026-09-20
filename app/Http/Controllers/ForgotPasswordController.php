<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RecuperacaoSenha;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\RecuperacaoSenhaMail;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view('emails.esqueci-senha');
    }

    public function enviar(Request $request){
        $request->validate([
            'emailProfissional' => 'required|email',
        ]);

        $profissional = User::where(
            'emailProfissional',
            $request->emailProfissional
        )->first();

        if (!$profissional) {
            return back()->withErrors([
                'emailProfissional' => 'E-mail não encontrado.'
            ])->withInput();
        }

        $chave = Str::random(64);

        RecuperacaoSenha::create([
            'emailProfissional' => $request->emailProfissional,
            'chave' => $chave,
        ]);

        Mail::to($profissional->emailProfissional)
        ->send(new RecuperacaoSenhaMail($chave));

        return back()->with('sucesso', 'Chave de recuperação criada!');
    }

    public function redefinir($chave){
        $recuperacao = RecuperacaoSenha::where('chave', $chave)->first();

        if (!$recuperacao) {
            return 'Chave de recuperação inválida.';
        }

        if ($recuperacao->created_at->addMinutes(10)->isPast()) {
            $recuperacao->delete();

            return 'Chave de recuperação expirada.';
        }

        return view('emails.redefinir-senha', [
            'chave' => $chave
        ]);
    }

    public function atualizarSenha(Request $request, $chave){
        $request->validate([
        'senhaProfissional' => 'required|string|min:8|confirmed',
        ]);

        $recuperacao = RecuperacaoSenha::where('chave', $chave)->first();

        if (!$recuperacao) {
            return 'Chave de recuperação inválida.';
        }

        $profissional = User::where(
            'emailProfissional',
            $recuperacao->emailProfissional
        )->first();

        if (!$profissional) {
            return 'Profissional não encontrado.';
        }

        $profissional->senhaProfissional = Hash::make($request->senhaProfissional);
        $profissional->save();

        $recuperacao->delete();

        return 'Senha alterada com sucesso!';
    }
}
