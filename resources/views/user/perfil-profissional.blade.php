<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar perfil</title>
</head>

<body>
    <h1>Meu perfil</h1>

    <br />
    <a href="{{ url('user.update-profissional') }}">Editar perfil</a>

    <h1>Meu perfil</h1>

    <h2>{{ $profissional->nomeProfissional }}</h2>
    <div>
        <h2>email</h2>
        <div>
            <p>{{ $profissional->emailProfissional }}</p>
        </div>

        <h2>CPF</h2>
        <div>
            <p>{{ $profissional->cpfProfissional }}</p>
        </div>
    </div>

    <div>
        <h2>Telefone</h2>
        <div>
            <p>{{ $profissional->telefoneProfissional }}</p>
        </div>

        <h2>Data de nascimento</h2>
        <div>
            <p>{{ $profissional->dataNascProfissional }}</p>
        </div>
    </div>

    <div>
        <h2>Conselho de Classe</h2>
        <div>
            <p>{{ $profissional->conselhoClasseProfissional }}-{{ $profissional->ufConselhoProfissional }} {{ $profissional->numConselhoProfissional }}</p>
        </div>

        <h2>Localidade</h2>
        <div>
            <p>{{ $profissional->ufConselhoProfissional }}</p>
        </div>
    </div>

    <div>
        <h2>Categoria Profissional</h2>
        <div>
            <p>{{ $profissional->categoriaProfissional }}</p>
        </div>

        <h2>Especialidade</h2>
        <div>
            <p>{{ $profissional->especialidadeProfissional }}</p>
        </div>
    </div>

    <div>
        <h2>Apresentação profissional</h2>
        <div>
            <p>{{ $profissional->apresentacaoProfissional }}</p>
        </div>
    </div>

    <div>
        <h2>Consulta por chat</h2>
        <div>
            <p>{{ $profissional->atendeChatProfissional }}</p>
        </div>

        <h2>Dúvida Rápida</h2>
        <div>
            <p>{{ $profissional->atendeDuvidaRapidoProfissional }}</p>
        </div>

        <h2>Presencial em parceria</h2>
        <div>
            <p>{{ $profissional->atendePresencialProfissional }}</p>
        </div>
    </div>

    <button type="button" onclick="abrirModal()">
        Desativar conta
    </button>

    <div id="modalDesativar" style="display: none;">

        <div>
            <h2>Desativar conta</h2>

            <p>
                Tem certeza que deseja desativar sua conta?
            </p>

            <form action="{{ route('conta.desativar') }}" method="POST">
                @csrf
                @method('PUT')

                <button type="submit">
                    Sim, desativar
                </button>
            </form>

            <button type="button" onclick="fecharModal()">
                Cancelar
            </button>
        </div>

    </div>

    <script>
        function abrirModal() {
            document.getElementById('modalDesativar').style.display = 'block';
        }

        function fecharModal() {
            document.getElementById('modalDesativar').style.display = 'none';
        }
    </script>
</body>

</html>
