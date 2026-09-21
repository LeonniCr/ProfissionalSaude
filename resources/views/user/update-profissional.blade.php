<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    @php
        $inicial = strtoupper(substr($profissional->nomeProfissional ?? 'P', 0, 1));
    @endphp

    <div class="app-shell">

        {{-- ===================== BARRA LATERAL ===================== --}}
        <aside class="sidebar">

            <div class="sidebar-brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus" class="sidebar-logo">
                <span class="brand-text">Portal do<br>Profissional</span>
            </div>

            <nav class="sidebar-nav">

                <div class="nav-group">
                    <p class="nav-group-label">Principal</p>

                    <a href="{{ url('/painel') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8" /><path d="M5 10v10h14V10" /></svg>
                        <span>Painel</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                        <span>Caixa de Entrada</span>
                        <span class="nav-badge">5</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                        <span>Agenda</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg>
                        <span>Pacientes</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Gestão</p>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg>
                        <span>Conteúdos</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20V10M12 20V4M20 20v-7" /></svg>
                        <span>Relatórios</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a8 8 0 1 1-3.2-6.4L21 4l-1 4.6c.6 1 1 2.2 1 3.4Z" /></svg>
                        <span>Fórum</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 8l10-5 10 5-10 5-10-5Z" /><path d="M6 11v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" /></svg>
                        <span>Aprender</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Conta</p>

                    <a href="{{ url('user.perfil-profissional') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" /></svg>
                        <span>Meu Perfil</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3" /><path d="M19 12a7 7 0 0 0-.1-1.2l2-1.6-2-3.4-2.4 1a7 7 0 0 0-2-1.2L14 3h-4l-.5 2.6a7 7 0 0 0-2 1.2l-2.4-1-2 3.4 2 1.6A7 7 0 0 0 5 12a7 7 0 0 0 .1 1.2l-2 1.6 2 3.4 2.4-1a7 7 0 0 0 2 1.2L10 21h4l.5-2.6a7 7 0 0 0 2-1.2l2.4 1 2-3.4-2-1.6c.1-.4.1-.8.1-1.2Z" /></svg>
                        <span>Configurações</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M9.5 9.2a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.1 1-1.1 1.9" /><path d="M12 17h.01" /></svg>
                        <span>Suporte</span>
                    </a>
                </div>

            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <span class="avatar-circle">{{ $inicial }}</span>
                    <div class="sidebar-user-info">
                        <strong>{{ $profissional->nomeProfissional }}</strong>
                        <span>{{ $profissional->especialidadeProfissional }}</span>
                    </div>
                </div>

                <form action="/logout" method="post" class="sidebar-logout-form">
                    @csrf
                    <button type="submit" class="sidebar-logout-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="M16 17l5-5-5-5" /><path d="M21 12H9" /></svg>
                        Sair
                    </button>
                </form>
            </div>

        </aside>

        {{-- ===================== CONTEÚDO ===================== --}}
        <div class="main-content">

            <header class="topbar">
                <span class="breadcrumb">Vênus / <strong>Meu Perfil</strong></span>

                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                    <input type="text" placeholder="Buscar atendimentos, pacientes...">
                </div>

                <div class="topbar-right">
                    <svg class="topbar-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>

                    <div class="topbar-user">
                        <span class="avatar-circle">{{ $inicial }}</span>
                        <div class="topbar-user-info">
                            <strong>{{ $profissional->nomeProfissional }}</strong>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-content">

                <form action="{{ route('perfil.atualizar') }}" method="POST" id="formEditarPerfil">
                    @csrf
                    @method('PUT')

                    <div class="page-header">
                        <div>
                            <h1>Editar Perfil</h1>
                            <p class="subtitle">Atualize seus dados públicos e profissionais.</p>
                        </div>

                        <div class="profile-actions">
                            <a href="{{ url('user.perfil-profissional') }}" class="btn-outline-sm">Voltar</a>
                            <a href="{{ url('user.mudar-senha') }}" class="btn-outline-sm">Trocar senha</a>
                            <button type="submit" class="btn-primary-sm">Salvar alterações</button>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="profile-grid">

                        {{-- ===================== FORMULÁRIO ===================== --}}
                        <div class="profile-card">

                            <div class="profile-card-head">
                                <div>
                                    <h2>Dados pessoais e profissionais</h2>
                                    <p>Essas informações aparecem no seu perfil público.</p>
                                </div>
                            </div>

                            <div class="avatar-row">
                                <span class="avatar-circle avatar-lg">{{ $inicial }}</span>
                                <div class="avatar-row-info">
                                    <label for="fotoPerfil" class="btn-outline-sm" style="cursor: pointer;">Trocar foto</label>
                                    <input type="file" name="fotoPerfil" id="fotoPerfil" accept="image/*" valeu="{{ $profissional->fotoPerfilProfissional }}" style="position: absolute; width: 1px; height: 1px; opacity: 0;">
                                    <span>JPG ou PNG &middot; até 5MB</span>
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" id="nome" value="{{ $profissional->nomeProfissional }}">
                                </div>
                                <div class="field">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" value="{{ $profissional->emailProfissional }}">
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" value="{{ $profissional->telefoneProfissional }}">
                                </div>
                                <div class="field">
                                    <label for="cpf">CPF</label>
                                    <input type="text" name="cpf" id="cpf" value="{{ $profissional->cpfProfissional }}">
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="dataNasc">Data de Nascimento</label>
                                    <input type="date" name="dataNasc" id="dataNasc" value="{{ $profissional->dataNascProfissional }}">
                                </div>
                                <div class="field">
                                    <label for="categoria">Categoria</label>
                                    <select name="categoria" id="categoria">
                                        <option value="">Selecione</option>
                                        <option value="medico" {{ $profissional->categoriaProfissional == 'medico' ? 'selected' : '' }}>Médica</option>
                                        <option value="enfermeiro" {{ $profissional->categoriaProfissional == 'enfermeiro' ? 'selected' : '' }}>Enfermeira</option>
                                        <option value="psicologo" {{ $profissional->categoriaProfissional == 'psicologo' ? 'selected' : '' }}>Psicóloga</option>
                                        <option value="outro" {{ $profissional->categoriaProfissional == 'outro' ? 'selected' : '' }}>Outro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="especialidade">Especialidade</label>
                                    <input type="text" name="especialidade" id="especialidade" value="{{ $profissional->especialidadeProfissional }}">
                                </div>
                                <div class="field">
                                    <label for="conselho">Conselho de Classe</label>
                                    <select name="conselho" id="conselho">
                                        @if($profissional->conselhoClasseProfissional)
                                            <option value="{{ $profissional->conselhoClasseProfissional }}" selected>{{ $profissional->conselhoClasseProfissional }}</option>
                                        @else
                                            <option value="" selected>Selecione</option>
                                        @endif
                                        <option value="CRM">CRM</option>
                                        <option value="CRP">CRP</option>
                                        <option value="COREN">COREN</option>
                                        <option value="CRESS">CRESS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="numConselho">Número do conselho</label>
                                    <input type="text" name="numConselho" id="numConselho" value="{{ $profissional->numConselhoProfissional }}">
                                </div>
                                <div class="field">
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
                            </div>

                            <div class="field">
                                <label for="apresentacao">Apresentação</label>
                                <textarea name="apresentacao" id="apresentacao" rows="4">{{ $profissional->apresentacaoProfissional }}</textarea>
                            </div>

                            <div class="toggle-row" style="margin-bottom: 20px;">
                                <div class="toggle-item">
                                    <div class="toggle-item-text">
                                        <strong>Atende Chat?</strong>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="atendeChat" id="atendeChat" value="1" {{ $profissional->atendeChatProfissional ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>

                                <div class="toggle-item">
                                    <div class="toggle-item-text">
                                        <strong>Atende Dúvida Rápida?</strong>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="atendeDuvidaRapido" id="atendeDuvidaRapido" value="1" {{ $profissional->atendeDuvidaRapidoProfissional ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>

                                <div class="toggle-item">
                                    <div class="toggle-item-text">
                                        <strong>Atende Presencial?</strong>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="atendePresencial" id="atendePresencial" value="1" {{ $profissional->atendePresencialProfissional ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="field">
                                <label class="upload-box" for="comprovanteConselho">
                                    <span class="upload-icon">&#8593;</span>
                                    <span class="upload-text">
                                        <strong>Comprovante do conselho de classe</strong>
                                        <span class="upload-desc">PDF, JPG ou PNG</span>
                                    </span>
                                    <span class="upload-filename" data-filename-for="comprovanteConselho">Nenhum arquivo escolhido</span>
                                </label>
                                <input type="file" name="comprovanteConselho" id="comprovanteConselho" class="upload-input" valeu="{{ $profissional->comprovanteConselhoProfissional }}">
                            </div>

                            <div class="field">
                                <label class="upload-box" for="docComplementar">
                                    <span class="upload-icon">&#8593;</span>
                                    <span class="upload-text">
                                        <strong>Documento de Identidade</strong>
                                        <span class="upload-desc">PDF, JPG ou PNG</span>
                                    </span>
                                    <span class="upload-filename" data-filename-for="docComplementar">Nenhum arquivo escolhido</span>
                                </label>
                                <input type="file" name="docComplementar" id="docComplementar" class="upload-input" valeu="{{ $profissional->docComplementarProfissional }}">
                            </div>

                        </div>

                        {{-- ===================== PRÉVIA DO PERFIL (ATUALIZA AO DIGITAR) ===================== --}}
                        <div class="preview-card">
                            <p class="preview-card-head">
                                Prévia do perfil
                                <strong>Como a usuária verá você</strong>
                            </p>

                            <span class="avatar-circle avatar-lg" style="margin: 0 auto 10px;">{{ $inicial }}</span>

                            <div class="preview-verified">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M8 12.5l2.5 2.5L16 9.5" /></svg>
                                Verificado
                            </div>

                            <p class="preview-name" id="previewNome">{{ $profissional->nomeProfissional }}</p>
                            <p class="preview-specialty" id="previewEspecialidade">{{ $profissional->especialidadeProfissional }}</p>
                            <p class="preview-bio" id="previewApresentacao">{{ $profissional->apresentacaoProfissional }}</p>

                            <div class="preview-badges" id="previewBadges">
                                @if ($profissional->atendeChatProfissional)
                                    <span class="badge-pill" data-badge="chat">Chat</span>
                                @endif
                                @if ($profissional->atendeDuvidaRapidoProfissional)
                                    <span class="badge-pill" data-badge="duvida">Dúvida rápida</span>
                                @endif
                                @if ($profissional->atendePresencialProfissional)
                                    <span class="badge-pill" data-badge="presencial">Presencial</span>
                                @endif
                            </div>
                        </div>

                    </div>

                </form>

            </main>

        </div>

    </div>

    <script>
        // Nome do arquivo escolhido nas caixas de upload
        document.querySelectorAll('.upload-input').forEach(function (input) {
            input.addEventListener('change', function () {
                var label = document.querySelector('[data-filename-for="' + input.id + '"]');
                if (label) {
                    label.textContent = input.files.length ? input.files[0].name : 'Nenhum arquivo escolhido';
                }
            });
        });

        // Atualiza a prévia do perfil em tempo real (não altera o que é enviado ao back-end)
        var nomeInput = document.getElementById('nome');
        var especialidadeInput = document.getElementById('especialidade');
        var apresentacaoInput = document.getElementById('apresentacao');

        if (nomeInput) {
            nomeInput.addEventListener('input', function () {
                document.getElementById('previewNome').textContent = nomeInput.value;
            });
        }
        if (especialidadeInput) {
            especialidadeInput.addEventListener('input', function () {
                document.getElementById('previewEspecialidade').textContent = especialidadeInput.value;
            });
        }
        if (apresentacaoInput) {
            apresentacaoInput.addEventListener('input', function () {
                document.getElementById('previewApresentacao').textContent = apresentacaoInput.value;
            });
        }
    </script>

</body>

</html>