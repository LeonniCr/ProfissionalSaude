<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda | Vênus</title>

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

                    <a href="{{ route('agenda.index') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                        <span>Agenda</span>
                    </a>

                    <a href="{{ route('pacientes.index') }}" class="nav-item">
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

                    <a href="{{ route('relatorios.index') }}" class="nav-item">
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
                <span class="breadcrumb">Vênus / <strong>Agenda</strong></span>

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


            <main class="page-content ag-page">

                @if (session('sucesso'))
                    <div class="toast-sucesso" id="toastSucesso" role="status">
                        <span class="toast-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12" /></svg>
                        </span>
                        {{ session('sucesso') }}
                        <button type="button" class="toast-fechar" aria-label="Fechar">&times;</button>
                    </div>
                @endif

                @if (session('erro'))
                    <div class="alert-error" style="margin-bottom:16px;">{{ session('erro') }}</div>
                @endif

                <div class="page-header">
                    <div>
                        <h1>Agenda e disponibilidade</h1>
                        <p class="subtitle">Gestão dos horários em que o profissional está disponível para atendimento.</p>
                    </div>
                    <button type="button" class="btn-primary-sm" id="abrirModalBloqueio">+ Bloquear horário</button>
                </div>

                <section class="ag-card">

                    <div class="ag-toolbar">
                        <div class="ag-nav">
                            <a href="{{ route('agenda.index', ['semana' => $semanaAnterior]) }}" class="ag-nav-btn" aria-label="Semana anterior">&lt;</a>
                            <span class="ag-mes">{{ $tituloMes }}</span>
                            <a href="{{ route('agenda.index', ['semana' => $semanaSeguinte]) }}" class="ag-nav-btn" aria-label="Próxima semana">&gt;</a>
                            <a href="{{ route('agenda.index') }}" class="ag-hoje">Hoje</a>
                        </div>

                        <div class="ag-legenda">
                            <span><i class="ag-dot ag-dot--disp"></i>Disponível</span>
                            <span><i class="ag-dot ag-dot--ocup"></i>Ocupado</span>
                            <span><i class="ag-dot ag-dot--bloq"></i>Bloqueado</span>
                        </div>
                    </div>

                    @if (count($dias) == 0)
                        <div class="ag-vazio">
                            <strong>Nenhum horário de atendimento configurado</strong>
                            <p>Quando seus dias e horários de atendimento forem cadastrados, eles aparecerão aqui.</p>
                        </div>
                    @else
                        <div class="ag-scroll">
                            <div class="ag-grade" style="--colunas: {{ count($dias) }}">

                                <div class="ag-cab ag-cab--hora">Horário</div>
                                @foreach ($dias as $dia)
                                    <div class="ag-cab {{ $dia['hoje'] ? 'ag-cab--hoje' : '' }}">{{ $dia['rotulo'] }}</div>
                                @endforeach

                                @foreach ($linhas as $linha)
                                    <div class="ag-hora">{{ $linha['hora'] }}</div>

                                    @foreach ($linha['celulas'] as $celula)
                                        <div class="ag-slot">
                                            @if ($celula['tipo'] == 'disponivel')
                                                <div class="ag-cel ag-cel--disp">Disponível</div>
                                            @elseif ($celula['tipo'] == 'ocupado')
                                                <button type="button" class="ag-cel ag-cel--ocup"
                                                        data-nome="{{ $celula['nome'] }}"
                                                        data-tipo="{{ $celula['detalhe'] }}"
                                                        data-data="{{ $celula['data'] }}"
                                                        data-hora="{{ $celula['hora'] }}"
                                                        data-status="{{ $celula['status'] }}"
                                                        data-editar="{{ route('agenda.consultas.editar', $celula['id']) }}"
                                                        title="Clique para ver o atendimento">
                                                    <strong>{{ $celula['nome'] }}</strong>
                                                    <span>{{ $celula['detalhe'] }}</span>
                                                </button>
                                            @elseif ($celula['tipo'] == 'bloqueado')
                                                <button type="button" class="ag-cel ag-cel--bloq"
                                                        data-id="{{ $celula['id'] }}"
                                                        data-motivo="{{ $celula['motivo'] }}"
                                                        data-data="{{ $celula['data'] }}"
                                                        data-intervalo="{{ $celula['intervalo'] }}"
                                                        title="Clique para ver ou remover o bloqueio">Bloqueado</button>
                                            @else
                                                <div class="ag-cel ag-cel--fora"></div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                        </div>
                    @endif

                </section>

                <p class="ag-rodape">Vênus &bull; A Saúde da Mulher</p>

            </main>

        </div>

    </div>

    {{-- ===================== MODAL: BLOQUEAR HORÁRIO ===================== --}}
    <div class="ag-modal {{ $errors->any() ? 'open' : '' }}" id="modalBloqueio" role="dialog" aria-modal="true" aria-labelledby="agBloqueioTitulo">
        <form class="ag-modal-box" method="POST" action="{{ route('agenda.bloquear') }}" novalidate>
            @csrf
            <button type="button" class="ag-modal-close" id="fecharModalBloqueio" aria-label="Fechar">&times;</button>

            <h2 id="agBloqueioTitulo">Bloquear horário</h2>
            <p class="ag-modal-sub">Escolha o período que ficará indisponível para novos atendimentos.</p>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="field-row-2">
                <div class="field">
                    <label for="agData">Data</label>
                    <input type="date" id="agData" name="dataBloqueio" min="{{ $dataMinima }}" value="{{ old('dataBloqueio', $dataMinima) }}">
                </div>
                <div class="field">
                    <label for="agMotivo">Motivo</label>
                    <select id="agMotivo" name="motivoBloqueio">
                        @foreach ($motivos as $valor => $rotulo)
                            <option value="{{ $valor }}" @selected(old('motivoBloqueio') == $valor)>{{ $rotulo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="field-row-2">
                <div class="field">
                    <label for="agInicio">Início</label>
                    <input type="time" id="agInicio" name="horaInicio" value="{{ old('horaInicio') }}">
                </div>
                <div class="field">
                    <label for="agFim">Fim</label>
                    <input type="time" id="agFim" name="horaFim" value="{{ old('horaFim') }}">
                </div>
            </div>

            <div class="ag-modal-actions">
                <button type="button" class="btn-outline-sm" id="cancelarBloqueio">Cancelar</button>
                <button type="submit" class="btn-primary-sm">Bloquear horário</button>
            </div>
        </form>
    </div>

    {{-- ===================== MODAL: VER / REMOVER BLOQUEIO ===================== --}}
    <div class="ag-modal" id="modalDesbloqueio" role="dialog" aria-modal="true" aria-labelledby="agDesbloqueioTitulo">
        <form class="ag-modal-box ag-modal-box--sm" method="POST" action="" id="formDesbloqueio">
            @csrf
            @method('DELETE')
            <button type="button" class="ag-modal-close" id="fecharModalDesbloqueio" aria-label="Fechar">&times;</button>

            <h2 id="agDesbloqueioTitulo">Horário bloqueado</h2>
            <p class="ag-modal-sub">Este período está indisponível para novos atendimentos.</p>

            <dl class="ag-detalhes">
                <div><dt>Motivo</dt><dd id="dsMotivo"></dd></div>
                <div><dt>Data</dt><dd id="dsData"></dd></div>
                <div><dt>Período</dt><dd id="dsIntervalo"></dd></div>
            </dl>

            <div class="ag-modal-actions">
                <button type="button" class="btn-outline-sm" id="cancelarDesbloqueio">Fechar</button>
                <button type="submit" class="btn-primary-sm">Remover bloqueio</button>
            </div>
        </form>
    </div>

    {{-- ===================== MODAL: DETALHES DA CONSULTA ===================== --}}
    <div class="ag-modal" id="modalConsulta" role="dialog" aria-modal="true" aria-labelledby="agConsultaTitulo">
        <div class="ag-modal-box ag-modal-box--sm">
            <button type="button" class="ag-modal-close" id="fecharModalConsulta" aria-label="Fechar">&times;</button>

            <h2 id="agConsultaTitulo">Atendimento</h2>
            <p class="ag-modal-sub">Detalhes do atendimento marcado neste horário.</p>

            <dl class="ag-detalhes">
                <div><dt>Paciente</dt><dd id="coNome"></dd></div>
                <div><dt>Tipo</dt><dd id="coTipo"></dd></div>
                <div><dt>Data</dt><dd id="coData"></dd></div>
                <div><dt>Horário</dt><dd id="coHora"></dd></div>
                <div><dt>Status</dt><dd id="coStatus"></dd></div>
            </dl>

            <div class="ag-modal-actions">
                <button type="button" class="btn-outline-sm" id="cancelarConsulta">Fechar</button>
                <a href="#" class="btn-primary-sm" id="coEditar">Editar consulta</a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var modalConsulta = document.getElementById('modalConsulta');
            var modalBloqueio = document.getElementById('modalBloqueio');
            var modalDes = document.getElementById('modalDesbloqueio');

            function abrir(m) { m.classList.add('open'); }
            function fechar(m) { m.classList.remove('open'); }

            // Bloquear horário
            document.getElementById('abrirModalBloqueio').addEventListener('click', function () { abrir(modalBloqueio); });
            document.getElementById('fecharModalBloqueio').addEventListener('click', function () { fechar(modalBloqueio); });
            document.getElementById('cancelarBloqueio').addEventListener('click', function () { fechar(modalBloqueio); });

            // Ver / remover um bloqueio existente
            var baseUrl = "{{ url('/agenda/bloqueios') }}";
            document.querySelectorAll('.ag-cel--bloq').forEach(function (celula) {
                celula.addEventListener('click', function () {
                    document.getElementById('formDesbloqueio').action = baseUrl + '/' + celula.dataset.id;
                    document.getElementById('dsMotivo').textContent = celula.dataset.motivo;
                    document.getElementById('dsData').textContent = celula.dataset.data;
                    document.getElementById('dsIntervalo').textContent = celula.dataset.intervalo;
                    abrir(modalDes);
                });
            });
            document.getElementById('fecharModalDesbloqueio').addEventListener('click', function () { fechar(modalDes); });
            document.getElementById('cancelarDesbloqueio').addEventListener('click', function () { fechar(modalDes); });

            // Ver uma consulta marcada (botão leva para a edição)
            document.querySelectorAll('.ag-cel--ocup').forEach(function (celula) {
                celula.addEventListener('click', function () {
                    document.getElementById('coNome').textContent = celula.dataset.nome;
                    document.getElementById('coTipo').textContent = celula.dataset.tipo;
                    document.getElementById('coData').textContent = celula.dataset.data;
                    document.getElementById('coHora').textContent = celula.dataset.hora;
                    document.getElementById('coStatus').textContent = celula.dataset.status;
                    document.getElementById('coEditar').href = celula.dataset.editar;
                    abrir(modalConsulta);
                });
            });
            document.getElementById('fecharModalConsulta').addEventListener('click', function () { fechar(modalConsulta); });
            document.getElementById('cancelarConsulta').addEventListener('click', function () { fechar(modalConsulta); });

            [modalBloqueio, modalDes, modalConsulta].forEach(function (m) {
                m.addEventListener('click', function (e) { if (e.target === m) fechar(m); });
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { fechar(modalBloqueio); fechar(modalDes); fechar(modalConsulta); }
            });

            // Aviso de sucesso some sozinho
            var toast = document.getElementById('toastSucesso');
            if (toast) {
                var sair = function () {
                    toast.classList.add('saindo');
                    setTimeout(function () { toast.remove(); }, 300);
                };
                toast.querySelector('.toast-fechar').addEventListener('click', sair);
                setTimeout(sair, 4500);
            }
        })();
    </script>
</body>

</html>
