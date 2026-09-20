<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudar senha</title>
</head>

<body>
    <h1>Alterar senha</h1>

    <a href="{{ url('user.update-profissional') }}">Voltar</a>
    
    <a href="{{ url('emails.esqueci-senha') }}" class="link">Esqueci minha senha</a>

    <form action="{{ route('senha.atualizar') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="senhaAtual">Senha atual</label>
            <input type="password" name="senhaAtual" id="senhaAtual" required>
        </div>

        <div>
            <label for="novaSenha">Nova senha</label>
            <input type="password" name="novaSenha" id="novaSenha" required>
        </div>

        <div>
            <label for="confirmarSenha">Confirmar nova senha</label>
            <input type="password" name="confirmarSenha" id="confirmarSenha" required>
        </div>

        <button type="submit">Alterar senha</button>
    </form>
</body>

</html>
