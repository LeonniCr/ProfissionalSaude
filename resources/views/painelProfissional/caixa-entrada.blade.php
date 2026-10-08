<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <span class="nav-badge" id="navBadge" style="display: none;">0</span>
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
                        <p class="subtitle">Converse com outros profissionais em um único lugar.</p>
                    </div>

                    <a href="#" class="btn-outline-sm" id="btnLimpar">Limpar Filtros</a>
                </div>

                <div class="inbox-grid">

                    {{-- ===================== LISTA ===================== --}}
                    <div class="inbox-list card">

                        <div class="inbox-tabs">
                            <a href="#" class="inbox-tab active" data-filtro="todas">Todas <span class="inbox-tab-count" id="cntTodas">0</span></a>
                            <a href="#" class="inbox-tab" data-filtro="naolidas">Não lidas <span class="inbox-tab-count" id="cntNaoLidas">0</span></a>
                        </div>

                        <div class="inbox-search">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                            <input type="text" id="inboxBusca" placeholder="Buscar pelo nome do profissional..." autocomplete="off">
                        </div>

                        <div id="inboxLista"></div>
                    </div>

                    {{-- ===================== CHAT ===================== --}}
                    <div class="card inbox-panel">

                        <div class="inbox-empty" id="inboxEmpty">
                            <div class="inbox-envelope">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                            </div>
                            <strong>Selecione uma conversa</strong>
                            <p>Escolha um profissional na lista ou pesquise pelo nome para começar.</p>
                        </div>

                        <div id="inboxChat" style="display: none;">

                            <div class="chat-head">
                                <span id="chatAvatar"></span>
                                <div>
                                    <strong id="chatNome"></strong>
                                    <span class="chat-status" id="chatStatus"></span>
                                </div>
                            </div>

                            <div class="chat-warning">Sigilo médico: esta conversa é confidencial e deve ser utilizada exclusivamente para o atendimento.</div>

                            <div class="chat-body" id="chatBody"></div>

                            <div class="chat-input">
                                <input type="text" id="chatTexto" placeholder="Digite sua mensagem…" maxlength="2000" autocomplete="off">
                                <button type="button" class="chat-send" id="chatEnviar">➤</button>
                            </div>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>

    <script>
        var CSRF = document.querySelector('meta[name="csrf-token"]').content;
        var STORAGE = "{{ asset('storage') }}";
        var estado = { filtro: 'todas', conversas: [], resultados: [], termo: '', aberto: null };

        var elLista = document.getElementById('inboxLista');
        var elBusca = document.getElementById('inboxBusca');
        var elEmpty = document.getElementById('inboxEmpty');
        var elChat = document.getElementById('inboxChat');
        var elBody = document.getElementById('chatBody');
        var elTexto = document.getElementById('chatTexto');
        var elEnviar = document.getElementById('chatEnviar');

        function api(url, opcoes) {
            opcoes = opcoes || {};
            opcoes.headers = Object.assign({ 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF }, opcoes.headers || {});
            return fetch(url, opcoes).then(function (r) {
                if (!r.ok) throw new Error(r.status);
                return r.json();
            });
        }

        function criarAvatar(u) {
            if (u.foto) {
                var img = document.createElement('img');
                img.className = 'avatar-circle';
                img.src = STORAGE + '/' + u.foto;
                img.alt = u.nome;
                return img;
            }
            var s = document.createElement('span');
            s.className = 'avatar-circle';
            s.textContent = u.inicial;
            return s;
        }

        function tx(tag, classe, texto) {
            var e = document.createElement(tag);
            if (classe) e.className = classe;
            e.textContent = texto;
            return e;
        }

        // ---------- Lista ----------
        function renderLista() {
            elLista.innerHTML = '';
            var buscando = estado.termo !== '';
            var itens = buscando ? estado.resultados : estado.conversas.filter(function (c) {
                return estado.filtro === 'todas' || c.naoLidas > 0;
            });

            if (buscando) elLista.appendChild(tx('div', 'inbox-label', 'Profissionais'));

            if (!itens.length) {
                elLista.appendChild(tx('div', 'inbox-vazio', buscando
                    ? 'Nenhum profissional encontrado com esse nome.'
                    : (estado.filtro === 'naolidas' ? 'Nenhuma mensagem não lida.' : 'Nenhuma conversa ainda. Pesquise o nome de um profissional para começar.')));
                return;
            }

            itens.forEach(function (u) {
                var item = document.createElement('div');
                item.className = 'queue-item inbox-item' + (estado.aberto && estado.aberto.codigo === u.codigo ? ' inbox-item-active' : '');
                item.appendChild(criarAvatar(u));

                var info = document.createElement('div');
                info.className = 'queue-info';
                info.appendChild(tx('strong', '', u.nome));
                info.appendChild(tx('span', 'inbox-preview', buscando ? (u.subtitulo || 'Profissional') : ((u.minha ? 'Você: ' : '') + u.ultima)));
                item.appendChild(info);

                if (!buscando) {
                    item.appendChild(tx('span', 'queue-time', u.hora));
                    if (u.naoLidas > 0) item.appendChild(tx('span', 'badge-unread', u.naoLidas));
                }

                item.addEventListener('click', function () { abrirConversa(u); });
                elLista.appendChild(item);
            });
        }

        function atualizarConversas() {
            return api('/caixa-de-entrada/conversas').then(function (lista) {
                estado.conversas = lista;
                var nao = lista.reduce(function (t, c) { return t + c.naoLidas; }, 0);
                document.getElementById('cntTodas').textContent = lista.length;
                document.getElementById('cntNaoLidas').textContent = nao;
                var badge = document.getElementById('navBadge');
                badge.textContent = nao;
                badge.style.display = nao > 0 ? '' : 'none';
                if (estado.termo === '') renderLista();
            }).catch(function () {});
        }

        // ---------- Chat ----------
        function renderMensagens(mensagens) {
            var perto = elBody.scrollHeight - elBody.scrollTop - elBody.clientHeight < 80;
            elBody.innerHTML = '';

            if (!mensagens.length) {
                elBody.appendChild(tx('div', 'inbox-vazio', 'Nenhuma mensagem ainda. Diga olá! 👋'));
            }

            mensagens.forEach(function (m) { elBody.appendChild(criarMensagem(m)); });
            if (perto || estado.rolar) elBody.scrollTop = elBody.scrollHeight;
            estado.rolar = false;
        }

        function criarMensagem(m) {
            var div = document.createElement('div');
            div.className = 'chat-msg ' + (m.minha ? 'chat-msg--me' : 'chat-msg--her');
            div.appendChild(tx('p', '', m.texto));
            div.appendChild(tx('span', '', m.hora));
            return div;
        }

        function carregarMensagens() {
            var alvo = estado.aberto;
            if (!alvo) return;
            api('/caixa-de-entrada/mensagens/' + alvo.codigo).then(function (d) {
                if (!estado.aberto || estado.aberto.codigo !== alvo.codigo) return;
                renderMensagens(d.mensagens);
                atualizarConversas();
            }).catch(function () {});
        }

        function abrirConversa(u) {
            estado.aberto = u;
            estado.rolar = true;

            var wrap = document.getElementById('chatAvatar');
            wrap.innerHTML = '';
            wrap.appendChild(criarAvatar(u));
            document.getElementById('chatNome').textContent = u.nome;
            document.getElementById('chatStatus').textContent = u.subtitulo || 'Profissional';

            elEmpty.style.display = 'none';
            elChat.style.display = 'flex';
            elBody.innerHTML = '';
            renderLista();
            carregarMensagens();
            elTexto.focus();
        }

        function enviar() {
            var texto = elTexto.value.trim();
            if (!texto || !estado.aberto) return;

            elEnviar.disabled = true;
            api('/caixa-de-entrada/enviar', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ destinatario: estado.aberto.codigo, texto: texto })
            }).then(function (m) {
                elTexto.value = '';
                if (elBody.querySelector('.inbox-vazio')) elBody.innerHTML = '';
                elBody.appendChild(criarMensagem(m));
                elBody.scrollTop = elBody.scrollHeight;
                atualizarConversas();
            }).catch(function () {
                alert('Não foi possível enviar a mensagem. Tente novamente.');
            }).then(function () {
                elEnviar.disabled = false;
                elTexto.focus();
            });
        }

        elEnviar.addEventListener('click', enviar);
        elTexto.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') { e.preventDefault(); enviar(); }
        });

        // ---------- Busca ----------
        var temporizador = null;
        elBusca.addEventListener('input', function () {
            clearTimeout(temporizador);
            var termo = elBusca.value.trim();
            estado.termo = termo;

            if (termo === '') { renderLista(); return; }

            temporizador = setTimeout(function () {
                api('/caixa-de-entrada/buscar?q=' + encodeURIComponent(termo)).then(function (r) {
                    if (estado.termo !== termo) return;
                    estado.resultados = r;
                    renderLista();
                }).catch(function () {});
            }, 250);
        });

        // ---------- Abas e limpar ----------
        document.querySelectorAll('.inbox-tab').forEach(function (aba) {
            aba.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('.inbox-tab').forEach(function (a) { a.classList.remove('active'); });
                aba.classList.add('active');
                estado.filtro = aba.dataset.filtro;
                renderLista();
            });
        });

        document.getElementById('btnLimpar').addEventListener('click', function (e) {
            e.preventDefault();
            elBusca.value = '';
            estado.termo = '';
            estado.filtro = 'todas';
            document.querySelectorAll('.inbox-tab').forEach(function (a) {
                a.classList.toggle('active', a.dataset.filtro === 'todas');
            });
            renderLista();
        });

        // ---------- Início e atualização automática ----------
        atualizarConversas();
        setInterval(function () {
            if (estado.aberto) carregarMensagens(); else atualizarConversas();
        }, 5000);
    </script>

</body>

</html>