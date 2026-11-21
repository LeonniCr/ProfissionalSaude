<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reenviar documentos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .reenvio-motivo {
            margin: 0 0 20px;
            padding: 14px 16px;
            background: var(--pink-bg);
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.6;
        }

        .reenvio-motivo strong {
            display: block;
            margin-bottom: 4px;
            color: var(--maroon);
        }
    </style>
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
                <span class="info-badge">ANÁLISE DO CADASTRO</span>
                <h2>Quase lá!</h2>
                <p>Envie os documentos pedidos para a gente continuar a análise do seu cadastro.</p>
            </div>
        </aside>

        <main class="login-right">
            <div class="login-box">

                <a href="{{ url('/') }}" class="back-link">&larr; Voltar para o login</a>

                @if ($invalido)

                    <span class="eyebrow">Reenvio de documentos</span>
                    <h1>Link indisponível</h1>

                    <p class="subtitle">
                        Este link é inválido, já foi usado ou expirou. Se ainda precisar reenviar
                        documentos, entre em contato com o suporte do Vênus.
                    </p>

                @else

                    <span class="eyebrow">Reenvio de documentos</span>
                    <h1>Reenviar documentos</h1>

                    <p class="subtitle">Olá, {{ $profissional->nomeProfissionalSaude }}. Envie apenas os arquivos abaixo.</p>

                    @if ($profissional->motivoVerificacao)
                        <div class="reenvio-motivo">
                            <strong>Motivo do pedido</strong>
                            {{ $profissional->motivoVerificacao }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('user.reenviar-documentos/' . $chave) }}" method="POST" enctype="multipart/form-data" class="login-form" id="form-reenvio">
                        @csrf

                        @foreach ($documentos as $doc)
                            <label class="upload-box upload-box--big">
                                <span class="upload-icon">&#8593;</span>
                                <span class="upload-text">
                                    <strong>{{ $doc['nome'] }}</strong>
                                    <span class="upload-desc">
                                        @if ($doc['campo'] === 'fotoPerfil')
                                            JPG, PNG ou WEBP &middot; até 2 MB
                                        @else
                                            PDF, JPG ou PNG &middot; até 2 MB
                                        @endif
                                    </span>
                                </span>
                                <span class="upload-filename" data-filename-for="{{ $doc['campo'] }}">Nenhum arquivo selecionado</span>
                                <input type="file" name="{{ $doc['campo'] }}" id="{{ $doc['campo'] }}" class="upload-input"
                                       accept="{{ $doc['campo'] === 'fotoPerfil' ? 'image/*' : '.pdf,.jpg,.jpeg,.png' }}" required>
                            </label>
                        @endforeach

                        <button type="submit" class="btn-primary">Enviar documentos</button>
                    </form>

                    <p class="footer-note">
                        Depois do envio, seu cadastro volta para análise e você receberá um e-mail com o resultado.
                    </p>

                @endif
            </div>
        </main>

    </div>

    <script>
        document.querySelectorAll('.upload-input').forEach(function (input) {
            input.addEventListener('change', function () {
                var label = document.querySelector('[data-filename-for="' + input.id + '"]');
                if (label) {
                    label.textContent = input.files.length ? input.files[0].name : 'Nenhum arquivo selecionado';
                }
            });
        });
    </script>
</body>

</html>
