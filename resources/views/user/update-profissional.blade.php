<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
</head>

<body>
    <h1>Editar perfil</h1>
    
    <a href="{{ url('user.perfil-profissional') }}">Voltar</a>
  
    <a href="{{ url('user.mudar-senha') }}">Trocar senha</a>

    <form action="{{ route('perfil.atualizar') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ $profissional->nomeProfissional }}">
        </div>

        <div>
            <label for="email">E-mail</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ $profissional->emailProfissional }}">
        </div>

        <div>
            <label for="telefone">Telefone</label>
            <input
                type="text"
                name="telefone"
                id="telefone"
                value="{{ $profissional->telefoneProfissional }}">
        </div>

        <div>
            <label for="cpf">CPF</label>
            <input
                type="text"
                name="cpf"
                id="cpf"
                value="{{ $profissional->cpfProfissional }}">
        </div>

        <div>
            <label for="dataNasc">Data de Nascimento</label>
            <input
                type="date"
                name="dataNasc"
                id="dataNasc"
                value="{{ $profissional->dataNascProfissional }}">
        </div>

        <div>
            <label for="apresentacao">Apresentação</label>
            <textarea
                name="apresentacao"
                id="apresentacao">{{ $profissional->apresentacaoProfissional }}</textarea>
        </div>

        <div>
            <label for="fotoPerfil">Foto de Perfil</label>
            <input
                type="file"
                name="fotoPerfil"
                id="fotoPerfil"
                accept="image/*"
                valeu="{{ $profissional->fotoPerfilProfissional }}">
        </div>

        <div>
            <label for="categoria">Categoria</label>

            <select name="categoria" id="categoria">
                <option value="">Selecione</option>

                <option value="medico"
                    {{ $profissional->categoriaProfissional == 'medico' ? 'selected' : '' }}>
                    Médica
                </option>

                <option value="enfermeiro"
                    {{ $profissional->categoriaProfissional == 'enfermeiro' ? 'selected' : '' }}>
                    Enfermeira
                </option>

                <option value="psicologo"
                    {{ $profissional->categoriaProfissional == 'psicologo' ? 'selected' : '' }}>
                    Psicóloga
                </option>

                <option value="outro"
                    {{ $profissional->categoriaProfissional == 'outro' ? 'selected' : '' }}>
                    Outro
                </option>
            </select>
        </div>

        <div>
            <label for="especialidade">Especialidade</label>
            <input
                type="text"
                name="especialidade"
                id="especialidade"
                value="{{ $profissional->especialidadeProfissional }}">
        </div>

        <div>
            <label for="conselho">Conselho de Classe</label>

            <select name="conselho" id="conselho">

                @if($profissional->conselhoClasseProfissional)
                    <option value="{{ $profissional->conselhoClasseProfissional }}" selected>
                        {{ $profissional->conselhoClasseProfissional }}
                    </option>
                @else
                    <option value="" selected>Selecione</option>
                @endif

                <option value="CRM">CRM</option>
                <option value="CRP">CRP</option>
                <option value="COREN">COREN</option>
                <option value="CRESS">CRESS</option>

            </select>
        </div>

        <div>
            <label for="numConselho">Número do conselho</label>
            <input
                type="text"
                name="numConselho"
                id="numConselho"
                value="{{ $profissional->numConselhoProfissional }}">
        </div>

        <div>
            <label for="ufConselho">UF do Conselho</label>

            <select name="ufConselho" id="ufConselho">
                <option value="">Selecione a UF</option>

                <option value="AC" {{ $profissional->ufConselhoProfissional == 'AC' ? 'selected' : '' }}>Acre</option>
                <option value="AL" {{ $profissional->ufConselhoProfissional == 'AL' ? 'selected' : '' }}>Alagoas</option>
                <option value="AP" {{ $profissional->ufConselhoProfissional == 'AP' ? 'selected' : '' }}>Amapá</option>
                <option value="AM" {{ $profissional->ufConselhoProfissional == 'AM' ? 'selected' : '' }}>Amazonas</option>
                <option value="BA" {{ $profissional->ufConselhoProfissional == 'BA' ? 'selected' : '' }}>Bahia</option>
                <option value="CE" {{ $profissional->ufConselhoProfissional == 'CE' ? 'selected' : '' }}>Ceará</option>
                <option value="DF" {{ $profissional->ufConselhoProfissional == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                <option value="ES" {{ $profissional->ufConselhoProfissional == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                <option value="GO" {{ $profissional->ufConselhoProfissional == 'GO' ? 'selected' : '' }}>Goiás</option>
                <option value="MA" {{ $profissional->ufConselhoProfissional == 'MA' ? 'selected' : '' }}>Maranhão</option>
                <option value="MT" {{ $profissional->ufConselhoProfissional == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                <option value="MS" {{ $profissional->ufConselhoProfissional == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                <option value="MG" {{ $profissional->ufConselhoProfissional == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                <option value="PA" {{ $profissional->ufConselhoProfissional == 'PA' ? 'selected' : '' }}>Pará</option>
                <option value="PB" {{ $profissional->ufConselhoProfissional == 'PB' ? 'selected' : '' }}>Paraíba</option>
                <option value="PR" {{ $profissional->ufConselhoProfissional == 'PR' ? 'selected' : '' }}>Paraná</option>
                <option value="PE" {{ $profissional->ufConselhoProfissional == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                <option value="PI" {{ $profissional->ufConselhoProfissional == 'PI' ? 'selected' : '' }}>Piauí</option>
                <option value="RJ" {{ $profissional->ufConselhoProfissional == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                <option value="RN" {{ $profissional->ufConselhoProfissional == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                <option value="RS" {{ $profissional->ufConselhoProfissional == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                <option value="RO" {{ $profissional->ufConselhoProfissional == 'RO' ? 'selected' : '' }}>Rondônia</option>
                <option value="RR" {{ $profissional->ufConselhoProfissional == 'RR' ? 'selected' : '' }}>Roraima</option>
                <option value="SC" {{ $profissional->ufConselhoProfissional == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                <option value="SP" {{ $profissional->ufConselhoProfissional == 'SP' ? 'selected' : '' }}>São Paulo</option>
                <option value="SE" {{ $profissional->ufConselhoProfissional == 'SE' ? 'selected' : '' }}>Sergipe</option>
                <option value="TO" {{ $profissional->ufConselhoProfissional == 'TO' ? 'selected' : '' }}>Tocantins</option>
            </select>
        </div>

        <div>
            <input
                type="checkbox"
                name="atendeChat"
                id="atendeChat"
                value="1"
                {{ $profissional->atendeChatProfissional ? 'checked' : '' }}>
            <label for="atendeChat">Atende Chat?</label>

            <input
                type="checkbox"
                name="atendeDuvidaRapido"
                id="atendeDuvidaRapido"
                value="1"
                {{ $profissional->atendeDuvidaRapidoProfissional ? 'checked' : '' }}>
            <label for="atendeDuvidaRapido">Atende Dúvida Rápida?</label>

            <input
                type="checkbox"
                name="atendePresencial"
                id="atendePresencial"
                value="1"
                {{ $profissional->atendePresencialProfissional ? 'checked' : '' }}>
            <label for="atendePresencial">Atende Presencial?</label>
        </div>

        <div>
            <label for="comprovanteConselho">Comprovante do conselho de classe</label>
            <input
                type="file"
                name="comprovanteConselho"
                id="comprovanteConselho"
                valeu="{{ $profissional->comprovanteConselhoProfissional }}">
        </div>

        <div>
            <label for="docComplementar">Documento de Identidade</label>
            <input
                type="file"
                name="docComplementar"
                id="docComplementar"
                valeu="{{ $profissional->docComplementarProfissional }}">
        </div>

        <button type="submit">Salvar alterações</button>
    </form>
</body>

</html>
