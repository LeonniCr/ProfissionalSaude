<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Recuperação de senha</h1>

    <p>Você solicitou a recuperação da sua senha no Vênus.</p>

    <p>
        <a href="{{ url('emails.redefinir-senha/' . $chave) }}">
            Clique aqui para redefinir sua senha
        </a>
    </p>

    <p>Esse link ficará disponível por apenas 10 minutos.</p>

    <p>Se você não solicitou essa recuperação, ignore este e-mail.</p>
</body>

</html>
