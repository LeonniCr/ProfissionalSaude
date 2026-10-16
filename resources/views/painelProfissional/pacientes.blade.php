<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
    <script src="{{ asset('js/sidebar.js') }}"></script>
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
                        @if (($naoLidas ?? 0) > 0)
                            <span class="nav-badge">{{ $naoLidas }}</span>
                        @endif
                    </a>

                    <a href="{{ route('agenda.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                        <span>Agenda</span>
                    </a>

                    <a href="{{ route('pacientes.index') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg>
                        <span>Pacientes</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Gestão</p>

                    <a href="{{ route('conteudos.index') }}" class="nav-item">
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
                <span class="breadcrumb">Vênus / <strong>Pacientes</strong></span>

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


            <main class="page-content pc-page">

                <div class="page-header">
                    <div>
                        <h1>Pacientes</h1>
                        <p class="subtitle">Histórico de usuárias atendidas por você.</p>
                    </div>
                </div>

                <section class="card pc-card">

                    <div class="pc-toolbar">
                        <div class="pc-busca">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                            <input type="text" id="pcBusca" placeholder="Buscar pacientes..." autocomplete="off">
                        </div>

                        <div class="pc-periodo">
                            <button type="button" class="pc-periodo-btn" id="pcPeriodoBtn" aria-haspopup="true" aria-expanded="false">{{ $periodos[$periodo] }}</button>
                            <ul class="pc-periodo-menu" id="pcPeriodoMenu">
                                @foreach ($periodos as $valor => $rotulo)
                                    <li><a href="{{ route('pacientes.index', ['periodo' => $valor]) }}" class="{{ $valor == $periodo ? 'ativo' : '' }}">{{ $rotulo }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @if (count($linhas) == 0)
                        <div class="pc-vazio">
                            <strong>Nenhuma paciente encontrada</strong>
                            <p>{{ $periodo == 'todos' ? 'Quando você concluir atendimentos, as usuárias atendidas aparecerão aqui.' : 'Nenhum atendimento nesse período. Tente outro filtro.' }}</p>
                        </div>
                    @else
                        <div class="pc-scroll">
                            <table class="pc-tabela">
                                <thead>
                                    <tr>
                                        <th>Nome / Apelido</th>
                                        <th>Último atendimento</th>
                                        <th>Consultas</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($linhas as $l)
                                        <tr class="pc-linha" data-nome="{{ mb_strtolower($l['nome']) }}">
                                            <td>
                                                <div class="pc-nome">
                                                    <span class="pc-avatar">{{ $l['inicial'] }}</span>
                                                    <strong>{{ $l['nome'] }}</strong>
                                                </div>
                                            </td>
                                            <td>{{ $l['ultimo'] }}</td>
                                            <td>
                                                @if ($l['estrelas'] === null)
                                                    <span class="pc-sem-nota">Sem avaliação</span>
                                                @else
                                                    <span class="pc-estrelas" title="Média {{ $l['media'] }} de 5">{{ str_repeat('★', $l['estrelas']) }}{{ str_repeat('☆', 5 - $l['estrelas']) }}</span>
                                                @endif
                                            </td>
                                            <td><span class="pc-status pc-status--{{ $l['statusClasse'] }}">{{ $l['status'] }}</span></td>
                                            <td class="pc-acao"><button type="button" class="pc-historico" data-id="{{ $l['id'] }}">Ver histórico</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="pc-sem-resultado" id="pcSemResultado" hidden>Nenhuma paciente encontrada com esse nome.</p>
                        </div>
                    @endif

                </section>

                <p class="ag-rodape">Vênus &bull; A Saúde da Mulher</p>

            </main>

        </div>

    </div>

    {{-- ===================== MODAL: HISTÓRICO ===================== --}}
    <div class="ag-modal" id="modalHistorico" role="dialog" aria-modal="true" aria-labelledby="pcHistNome">
        <div class="ag-modal-box pc-modal-box">
            <button type="button" class="ag-modal-close" id="fecharHistoricoX" aria-label="Fechar">&times;</button>

            <div class="pc-hist-topo">
                <span class="pc-avatar pc-avatar--lg" id="pcHistInicial"></span>
                <div>
                    <h2 id="pcHistNome"></h2>
                    <span class="pc-status" id="pcHistStatus"></span>
                </div>
            </div>

            <ul class="pc-hist-lista" id="pcHistLista"></ul>

            <button type="button" class="pc-fechar-historico" id="fecharHistorico">Fechar histórico</button>
        </div>
    </div>

    <script type="application/json" id="pcDados">@json($historicos)</script>
    <script>
        (function () {
            var dados = JSON.parse(document.getElementById('pcDados').textContent || '{}');
            var modal = document.getElementById('modalHistorico');
            var linhaAtiva = null;

            function semAcento(t) { return t.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, ''); }

            // Busca por nome (na própria lista)
            var busca = document.getElementById('pcBusca');
            var linhas = Array.prototype.slice.call(document.querySelectorAll('.pc-linha'));
            var aviso = document.getElementById('pcSemResultado');
            busca.addEventListener('input', function () {
                var termo = semAcento(busca.value.trim());
                var visiveis = 0;
                linhas.forEach(function (l) {
                    var ok = semAcento(l.dataset.nome).indexOf(termo) !== -1;
                    l.style.display = ok ? '' : 'none';
                    if (ok) visiveis++;
                });
                if (aviso) aviso.hidden = visiveis > 0;
            });

            // Filtro de período
            var btn = document.getElementById('pcPeriodoBtn');
            var menu = document.getElementById('pcPeriodoMenu');
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var aberto = menu.classList.toggle('aberto');
                btn.setAttribute('aria-expanded', aberto);
            });
            document.addEventListener('click', function () { menu.classList.remove('aberto'); });

            // Histórico
            function fechar() {
                modal.classList.remove('open');
                if (linhaAtiva) { linhaAtiva.classList.remove('pc-linha--ativa'); linhaAtiva = null; }
            }

            document.querySelectorAll('.pc-historico').forEach(function (b) {
                b.addEventListener('click', function () {
                    var d = dados[b.dataset.id];
                    if (!d) return;

                    document.getElementById('pcHistInicial').textContent = d.inicial;
                    document.getElementById('pcHistNome').textContent = d.nome;
                    var st = document.getElementById('pcHistStatus');
                    st.textContent = d.status;
                    st.className = 'pc-status pc-status--' + d.statusClasse;

                    var lista = document.getElementById('pcHistLista');
                    lista.innerHTML = '';
                    d.itens.forEach(function (i) {
                        var li = document.createElement('li');
                        var t = document.createElement('strong');
                        t.textContent = i.data + ' - ' + i.titulo;
                        var p = document.createElement('span');
                        p.textContent = i.descricao;
                        li.appendChild(t);
                        li.appendChild(p);
                        lista.appendChild(li);
                    });

                    linhaAtiva = b.closest('tr');
                    linhaAtiva.classList.add('pc-linha--ativa');
                    modal.classList.add('open');
                });
            });

            document.getElementById('fecharHistorico').addEventListener('click', fechar);
            document.getElementById('fecharHistoricoX').addEventListener('click', fechar);
            modal.addEventListener('click', function (e) { if (e.target === modal) fechar(); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') fechar(); });
        })();
    </script>
</body>

</html>
