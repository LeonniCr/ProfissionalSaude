<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudar senha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="recuperar-senha-page">
    <div class="login-page">

        <aside class="login-left">
            <span class="decor-circle decor-circle--top"></span>
            <span class="decor-circle decor-circle--bottom"></span>

            <div class="brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus" class="logo">
            </div>

            <div class="info-card" style="background-image: url('{{ asset('images/RetanguloLogin.png') }}');">
                <span class="info-badge">SEGURANÇA DA CONTA</span>
                <h2>Sua senha, só sua</h2>
                <p>Use uma senha forte e que você não utilize em outros serviços.</p>
            </div>
        </aside>

        <main class="login-right">
            <div class="login-box">

                <a href="{{ url('user.update-profissional') }}" class="back-link">&larr; Voltar</a>

                <span class="eyebrow">Segurança</span>
                <h1>Alterar senha</h1>

                <p class="subtitle">Confirme sua senha atual e defina uma nova.</p>

                <form action="{{ route('senha.atualizar') }}" method="POST" class="login-form">
                    @csrf
                    @method('PUT')

                    <div class="field">
                        <label for="senhaAtual">Senha atual</label>
                        <input type="password" name="senhaAtual" id="senhaAtual" required>
                    </div>

                    <div class="field">
                        <label for="novaSenha">Nova senha</label>
                        <input type="password" name="novaSenha" id="novaSenha" required>
                    </div>

                    <div class="field">
                        <label for="confirmarSenha">Confirmar nova senha</label>
                        <input type="password" name="confirmarSenha" id="confirmarSenha" required>
                    </div>

                    <div class="field-row">
                        <a href="{{ url('emails.esqueci-senha') }}" class="link">Esqueci minha senha</a>
                    </div>

                    <button type="submit" class="btn-primary">Alterar senha</button>
                </form>

                <p class="footer-note">
                    Ao alterar a senha, você continuará conectado neste dispositivo.
                </p>
            </div>
        </main>

    </div>
</body>

</html>
