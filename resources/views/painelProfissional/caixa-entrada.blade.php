<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa de Entrada | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    @php
        $inicial = strtoupper(substr($profissional->nomeProfissionalSaude ?? 'P', 0, 1));
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

                    <a href="{{ url('/dashboard') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8" /><path d="M5 10v10h14V10" /></svg>
                        <span>Painel</span>
                    </a>

                    <a href="{{ url('/caixa-de-entrada') }}" class="nav-item active">
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

                    <a href="{{ url('user.perfil-profissional') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" /></svg>
                        <span>Meu Perfil</span>
                    </a>

                    <a href="{{ url('/configuracoes') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3" /><path d="M19 12a7 7 0 0 0-.1-1.2l2-1.6-2-3.4-2.4 1a7 7 0 0 0-2-1.2L14 3h-4l-.5 2.6a7 7 0 0 0-2 1.2l-2.4-1-2 3.4 2 1.6A7 7 0 0 0 5 12a7 7 0 0 0 .1 1.2l-2 1.6 2 3.4 2.4-1a7 7 0 0 0 2 1.2L10 21h4l.5-2.6a7 7 0 0 0 2-1.2l2.4 1 2-3.4-2-1.6c.1-.4.1-.8.1-1.2Z" /></svg>
                        <span>Configurações</span>
                    </a>

                    <a href="{{ url('/suporte') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M9.5 9.2a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.1 1-1.1 1.9" /><path d="M12 17h.01" /></svg>
                        <span>Suporte</span>
                    </a>
                </div>

            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    @if (!empty($profissional->fotoPerfilProfissional))
                        <img class="avatar-circle" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                    @else
                        <span class="avatar-circle">{{ $inicial }}</span>
                    @endif
                    <div class="sidebar-user-info">
                        <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                        <span>{{ $profissional->especialidadeProfissionalSaude }}</span>
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
                <span class="breadcrumb">Vênus / <strong>Caixa de Entrada</strong></span>

                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                    <input type="text" placeholder="Buscar atendimentos, pacientes...">
                </div>

                <div class="topbar-right">
                    <a href="{{ url('/caixa-de-entrada') }}" style="display: inline-flex; align-items: center; text-decoration: none; color: inherit;">
                        <svg class="topbar-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>
                    </a>
                    
                    <div class="topbar-user">
                        @if (!empty($profissional->fotoPerfilProfissional))
                            <img class="avatar-circle" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                        @else
                            <span class="avatar-circle">{{ $inicial }}</span>
                        @endif
                        <div class="topbar-user-info">
                            <a href="{{ url('user.perfil-profissional') }}" style="text-decoration: none;">
                                <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

                <main class="page-content">

    <div class="page-header">
        <div>
            <h1>Caixa de Entrada</h1>
            <p class="subtitle">Gerencie as suas conversas em um único lugar.</p>
        </div>

        <a href="#" class="btn-outline-sm">Limpar Filtros</a>
    </div>

    <div class="inbox-grid">

        {{-- ===================== LISTA DE CONVERSAS ===================== --}}
        <div class="inbox-list card">

            <div class="inbox-tabs">
                <a href="#" class="inbox-tab active">Todas <span class="inbox-tab-count">18</span></a>
                <a href="#" class="inbox-tab">Não lidas <span class="inbox-tab-count">5</span></a>
                <a href="#" class="inbox-tab">Agendadas <span class="inbox-tab-count">6</span></a>
                <a href="#" class="inbox-tab">Dúvidas rápidas <span class="inbox-tab-count">4</span></a>
                <a href="#" class="inbox-tab">Arquivadas</a>
            </div>

            <div class="inbox-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                <input type="text" placeholder="Buscar pelo nome da usuária...">
            </div>

            <div class="queue-item inbox-item" data-conv="ana">
                <span class="avatar-circle">A</span>
                <div class="queue-info">
                    <strong>Ana Beatriz</strong>
                    <span>Tenho dúvida sobre anticoncepcional…</span>
                    <span class="badge-duvida">Dúvida rápida</span>
                </div>
                <span class="queue-time">10:30</span>
                <span class="badge-unread">1</span>
            </div>

            <div class="queue-item inbox-item" data-conv="camila">
                <span class="avatar-circle">C</span>
                <div class="queue-info">
                    <strong>Camila Ferreira</strong>
                    <span>Obrigada pela orientação!</span>
                    <span class="badge-chat">Consulta por chat</span>
                </div>
                <span class="queue-time">09:45</span>
            </div>

            <div class="queue-item inbox-item" data-conv="mariana">
                <span class="avatar-circle">M</span>
                <div class="queue-info">
                    <strong>Mariana Lima</strong>
                    <span>Anexei o resultado do exame.</span>
                    <span class="badge-agendada">Agendada</span>
                </div>
                <span class="queue-time">Ontem</span>
            </div>

            <div class="queue-item inbox-item" data-conv="juliana">
                <span class="avatar-circle">J</span>
                <div class="queue-info">
                    <strong>Juliana Santos</strong>
                    <span>Tudo certo, obrigada!</span>
                    <span class="badge-chat">Consulta por chat</span>
                </div>
                <span class="queue-time">Ontem</span>
            </div>

            <div class="queue-item inbox-item" data-conv="ester">
                <span class="avatar-circle">E</span>
                <div class="queue-info">
                    <strong>Ester Reis</strong>
                    <span>Olá, doutora! Estou com uma dúvida…</span>
                    <span class="badge-duvida">Dúvida rápida</span>
                </div>
                <span class="queue-time">Seg</span>
                <span class="badge-unread">1</span>
            </div>

        </div>

        {{-- ===================== PAINEL DO CHAT ===================== --}}
        <div class="card inbox-panel">

            {{-- Estado vazio (antes de clicar) --}}
            <div class="inbox-empty" id="inboxEmpty">
                <div class="inbox-envelope">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                </div>
                <strong>Selecione uma conversa</strong>
                <p>Escolha uma usuária na lista ao lado para visualizar o atendimento.</p>
            </div>

            {{-- Chat aberto (preenchido via JS) --}}
                <div id="inboxChat" style="display: none;">

                    <div class="chat-head">
                        <span class="avatar-circle" id="chatAvatar">A</span>
                        <div>
                            <strong id="chatNome">Ana Beatriz</strong>
                            <span class="chat-status" id="chatStatus">Online agora</span>
                        </div>
                    </div>

                    {{-- aviso de sigilo lá no topo --}}
                    <div class="chat-warning">Sigilo médico: esta conversa é confidencial e deve ser utilizada exclusivamente para o atendimento.</div>

                    <div class="chat-body" id="chatBody"></div>

                    <div class="chat-input">
                        <button type="button">+</button>
                        <input type="text" placeholder="Digite sua mensagem…">
                        <button type="button" class="chat-send">➤</button>
                    </div>

                </div>

        </div>

    </div>

</main>

<script>
    var conversas = {
        ana: {
            nome: 'Ana Beatriz',
            inicial: 'A',
            status: 'Online agora',
            mensagens: [
                { de: 'ela', texto: 'Olá, doutora! Estou com uma dúvida e queria saber se pode me orientar.', hora: '10:30' },
                { de: 'ela', texto: 'Tenho algumas informações que gostaria de entender melhor antes de marcar um atendimento.', hora: '10:30' },
            ]
        },
        camila: {
            nome: 'Camila Ferreira',
            inicial: 'C',
            status: 'Consulta por chat',
            mensagens: [
                { de: 'ela', texto: 'Doutora, muito obrigada pela orientação do outro dia!', hora: '09:45' },
                { de: 'voce', texto: 'Por nada, Camila! Fico feliz que tenha esclarecido suas dúvidas. 😊', hora: '09:50' },
            ]
        },
        mariana: {
            nome: 'Mariana Lima',
            inicial: 'M',
            status: 'Agendada',
            mensagens: [
                { de: 'ela', texto: 'Anexei o resultado do exame no portal.', hora: 'Ontem' },
                { de: 'voce', texto: 'Recebi, Mariana! Vou analisar e já te retorno.', hora: 'Ontem' },
            ]
        },
        juliana: {
            nome: 'Juliana Santos',
            inicial: 'J',
            status: 'Consulta por chat',
            mensagens: [
                { de: 'ela', texto: 'Tudo certo com os medicamentos, doutora. Muito obrigada!', hora: 'Ontem' },
            ]
        },
        ester: {
            nome: 'Ester Reis',
            inicial: 'E',
            status: 'Online agora',
            mensagens: [
                { de: 'ela', texto: 'Olá, doutora! Estou com uma dúvida sobre os exames.', hora: 'Seg' },
                { de: 'ela', texto: 'Posso enviar uma mensagem para esclarecer?', hora: 'Seg' },
            ]
        }
    };

    var itens = document.querySelectorAll('.inbox-item');
    var empty = document.getElementById('inboxEmpty');
    var chat = document.getElementById('inboxChat');
    var chatBody = document.getElementById('chatBody');
    var chatNome = document.getElementById('chatNome');
    var chatAvatar = document.getElementById('chatAvatar');
    var chatStatus = document.getElementById('chatStatus');

    itens.forEach(function (item) {
        item.addEventListener('click', function () {
            itens.forEach(function (i) { i.classList.remove('inbox-item-active'); });
            item.classList.add('inbox-item-active');

            var c = conversas[item.dataset.conv];
            if (!c) return;

            chatNome.textContent = c.nome;
            chatAvatar.textContent = c.inicial;
            chatStatus.textContent = c.status;
            chatBody.innerHTML = '';

            c.mensagens.forEach(function (m) {
                var div = document.createElement('div');
                div.className = 'chat-msg ' + (m.de === 'voce' ? 'chat-msg--me' : 'chat-msg--her');
                div.innerHTML = '<p>' + m.texto + '</p><span>' + m.hora + '</span>';
                chatBody.appendChild(div);
            });

            empty.style.display = 'none';
            chat.style.display = 'flex';
        });
    });
</script>

        </div>

    </div>

</body>

</html>