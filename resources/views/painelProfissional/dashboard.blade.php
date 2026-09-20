<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashborad</title>
</head>
<body>
    <h1>Olá Profissional.</h1>

    <form action="/logout" method="post">
        @csrf
        <button type="submit">Sair</button>
    </form>

    <br />
    <a href="{{ url('user.perfil-profissional') }}">visualizar perfil</a>
</body>
</html>
