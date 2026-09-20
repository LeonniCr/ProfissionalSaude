<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
</head>

<body>
    <a href="{{ url('/welcome') }}" class="link">Voltar para o login</a>
    <h1>Redefinir senha</h1>

    <p>Digite sua nova senha.</p>

    <form action="{{ url('emails.redefinir-senha/' . $chave) }}" method="POST">
        @csrf

        <div>
            <label for="senhaProfissional">Nova senha</label>

            <input
                type="password"
                name="senhaProfissional"
                id="senhaProfissional"
                placeholder="Digite sua nova senha"
                required>
        </div>

        <div>
            <label for="senhaProfissional_confirmation">
                Confirmar nova senha
            </label>

            <input
                type="password"
                name="senhaProfissional_confirmation"
                id="senhaProfissional_confirmation"
                placeholder="Digite novamente sua senha"
                required>
        </div>

        <button type="submit">Redefinir senha</button>
    </form>
</body>

</html>
