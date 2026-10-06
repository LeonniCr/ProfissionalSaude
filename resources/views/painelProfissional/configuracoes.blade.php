<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações | Vênus</title>

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

                    <a href="{{ url('/caixa-de-entrada') }}" class="nav-item">
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

                    <a href="{{ url('/configuracoes') }}" class="nav-item active">
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
                <span class="breadcrumb">Vênus / <strong>Configurações</strong></span>

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

            <main class="page-content cf-page">

                <div class="page-header">
                    <div>
                        <h1>Configurações</h1>
                        <p class="subtitle">Preferências da conta, segurança e aparência.</p>
                    </div>
                </div>

                <div class="cf-grid">

                    {{-- ============ CONTA ============ --}}
                    <div class="card">
                        <div class="card-head">
                            <h3>Conta</h3>
                        </div>

                        <label class="cf-label">E-mail de login</label>
                        <input type="text" class="cf-input" value="{{ $profissional->emailProfissionalSaude }}" readonly>

                        <a href="{{ url('user.mudar-senha') }}" class="cf-row" style="margin-top: 8px;">
                            <strong>Alterar senha</strong>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                        </a>

                        <div class="cf-row">
                            <strong>Sessões ativas</strong>
                            <span>2 dispositivos
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </span>
                        </div>
                    </div>

                    {{-- ============ SEGURANÇA ============ --}}
                    <div class="card">
                        <div class="card-head">
                            <h3>Segurança</h3>
                        </div>

                        <div class="cf-toggle">
                            <div>
                                <strong>Verificação de duas etapas</strong>
                                <span>Proteja sua conta com uma camada extra</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="cf-toggle">
                            <div>
                                <strong>Alertas de acesso</strong>
                                <span>Receber avisos em novos dispositivos</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    {{-- ============ APARÊNCIA ============ --}}
                    <div class="card">
                        <div class="card-head">
                            <h3>Aparência</h3>
                        </div>

                        <div class="cf-theme" id="cfTema">
                            <button type="button" class="cf-theme-btn active">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4" /><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4" /></svg>
                                Claro
                            </button>
                            <button type="button" class="cf-theme-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z" /></svg>
                                Escuro
                            </button>
                        </div>

                        <label class="cf-label" for="cfIdioma">Idioma</label>
                        <select id="cfIdioma" class="cf-select">
                            <option>Português (Brasil)</option>
                            <option>English</option>
                            <option>Español</option>
                        </select>
                    </div>

                    {{-- ============ ZONA DE RISCO ============ --}}
                    <div class="card cf-danger">
                        <div class="card-head">
                            <h3>Zona de Risco</h3>
                        </div>

                        <p>A exclusão da conta é permanente e exige confirmação de duas etapas.</p>

                        <button type="button" class="cf-btn-danger" onclick="abrirModalExcluir()">Excluir conta</button>
                    </div>

                </div>

            </main>

        </div>

    </div>

    {{-- ===================== MODAL EXCLUIR CONTA (somente visual) ===================== --}}
    <div id="modalExcluir" class="cf-modal">
        <div class="cf-modal-box">
            <button type="button" class="cf-modal-close" onclick="fecharModalExcluir()" aria-label="Fechar">&times;</button>

            <div class="cf-modal-icon">!</div>
            <h2>Excluir conta?</h2>
            <p>Essa ação é permanente. Todos os dados associados à sua conta serão processados conforme a política de privacidade.</p>

            <div class="cf-modal-actions">
                <button type="button" class="cf-btn-cancel" onclick="fecharModalExcluir()">Cancelar</button>
                <button type="button" class="cf-btn-danger" onclick="fecharModalExcluir()">Continuar</button>
            </div>
        </div>
    </div>

    <script>
        var modalExcluir = document.getElementById('modalExcluir');

        function abrirModalExcluir() {
            modalExcluir.classList.add('open');
        }

        function fecharModalExcluir() {
            modalExcluir.classList.remove('open');
        }

        // Fecha ao clicar fora da caixa ou apertar Esc
        modalExcluir.addEventListener('click', function (e) {
            if (e.target === modalExcluir) fecharModalExcluir();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') fecharModalExcluir();
        });

        // Alterna visualmente entre Claro e Escuro (ainda sem tema escuro aplicado)
        document.querySelectorAll('#cfTema .cf-theme-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('#cfTema .cf-theme-btn').forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');
            });
        });
    </script>

</body>

</html>