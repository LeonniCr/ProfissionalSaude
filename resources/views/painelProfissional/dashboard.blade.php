<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/preferencias.js') }}"></script>
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

                    <a href="{{ url('/dashboard') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8" /><path d="M5 10v10h14V10" /></svg>
                        <span>Painel</span>
                    </a>

                    <a href="{{ route('agenda.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                        <span>Agenda</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Gestão</p>

                    <a href="{{ route('conteudos.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg>
                        <span>Conteúdos</span>
                    </a>

                    <a href="{{ route('feedback.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H9l-5 4V5a1 1 0 0 1 1-1Z" /><path d="M8 9h8M8 12.5h5" /></svg>
                        <span>Feedback</span>
                    </a>

                    <a href="{{ route('relatorios.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20V10M12 20V4M20 20v-7" /></svg>
                        <span>Relatórios</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a8 8 0 1 1-3.2-6.4L21 4l-1 4.6c.6 1 1 2.2 1 3.4Z" /></svg>
                        <span>Fórum</span>
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
                <span class="breadcrumb">Vênus / <strong>Painel</strong></span>

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

            <main class="page-content dash-page">

                <div class="page-header">
                    <div>
                        <h1>Bem vinda(o), {{ $profissional->nomeProfissionalSaude }}</h1>
                        <p class="subtitle">Visão geral das suas atividades hoje.</p>
                    </div>
                    <a href="#" class="btn-primary-sm">+ Definir disponibilidade</a>
                </div>

                {{-- ============ CARTÕES DE INDICADORES (DADOS REAIS) ============ --}}
                <div class="stats-grid">

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                            Consultas hoje
                        </div>
                        <div class="stat-value">{{ $consultasHoje }}</div>
                        <p class="stat-foot">{{ $consultasHoje > 0 ? '+' . $consultasHoje . ' hoje' : 'Nenhuma consulta hoje' }}</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                            Mensagens pendentes
                        </div>
                        <div class="stat-value">{{ $mensagensPendentes }}</div>
                        <p class="stat-foot">{{ $mensagensPendentes > 0 ? $mensagensPendentes . ' aguardando' : 'Tudo em dia' }}</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l2.6 5.6 6.1.6-4.6 4 1.3 6-5.4-3.1-5.4 3.1 1.3-6-4.6-4 6.1-.6Z" /></svg>
                            Avaliação média
                        </div>
                        <div class="stat-value">{{ $avaliacaoMedia ? number_format($avaliacaoMedia, 1, ',', '.') : '—' }}</div>
                        <p class="stat-foot">{{ $avaliacaoMedia ? str_repeat('★', floor($avaliacaoMedia)) . str_repeat('☆', 5 - floor($avaliacaoMedia)) : 'Sem avaliações' }}</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg>
                            Usuárias atendidas
                        </div>
                        <div class="stat-value">{{ $usuariasAtendidas }}</div>
                        <p class="stat-foot">{{ $usuariasAtendidas > 0 ? 'Único(s) este período' : 'Nenhuma usuária atendida ainda' }}</p>
                    </div>

                </div>

                {{-- ============ PRÓXIMOS ATENDIMENTOS + FILA DE DÚVIDAS ============ --}}
                <div class="dashboard-grid">

                    <div class="card">
                        <div class="card-head">
                            <h3>Próximos atendimentos</h3>
                            <a href="{{ route('agenda.index') }}">Ver agenda
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </a>
                        </div>

                        @if ($proximosAtendimentos->isEmpty())
                            <div class="ag-vazio" style="padding: 32px; text-align: center;">
                                <strong>Nenhum atendimento agendado</strong>
                                <p>Quando houver agendamentos, eles aparecerão aqui.</p>
                            </div>
                        @else
                            @foreach ($proximosAtendimentos as $atendimento)
                                <div class="appointment-item">
                                    <span class="appointment-time">{{ \Carbon\Carbon::parse($atendimento->dataHoraAgendada)->format('H:i') }}</span>
                                    <div class="appointment-info">
                                        <strong>{{ $atendimento->usuario->nomeUsuario ?? 'Usuária' }}</strong>
                                        <span>{{ $atendimento->historicoConsulta ?? 'Atendimento' }}</span>
                                    </div>
                                    <div class="appointment-actions">
                                        <span class="badge-status {{ $atendimento->tipoConsulta }}">{{ ucfirst($atendimento->tipoConsulta) }}</span>
                                        <a href="#" class="btn-mini">Entrar</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h3>Fila de dúvidas rápidas</h3>
                            <a href="{{ url('/caixa-de-entrada') }}">Ver todas
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </a>
                        </div>

                        @if ($filaDuvidas->isEmpty())
                            <div class="inbox-vazio" style="padding: 32px; text-align: center;">
                                <strong>Nenhuma dúvida rápida pendente</strong>
                                <p>Quando usuárias enviarem dúvidas rápidas, elas aparecerão aqui.</p>
                            </div>
                        @else
                            @foreach ($filaDuvidas as $duvida)
                                <div class="queue-item" style="cursor: pointer;" onclick="window.location='{{ url('/caixa-de-entrada') }}'">
                                    <span class="avatar-circle">{{ strtoupper(substr($duvida->usuario->nomeUsuario ?? 'U', 0, 1)) }}</span>
                                    <div class="queue-info">
                                        <strong>{{ $duvida->usuario->nomeUsuario ?? 'Usuária' }}</strong>
                                        <span>{{ $duvida->historicoConsulta ?? 'Dúvida rápida' }}</span>
                                    </div>
                                    <span class="queue-time">{{ \Carbon\Carbon::parse($duvida->dataHoraAgendada)->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>

                {{-- ============ GRÁFICOS (4 GRÁFICOS - APARECEM MESMO VAZIOS) ============ --}}
                <div class="dashboard-grid">

                    {{-- 1) Atendimentos da semana --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Atendimentos da semana</h3>
                                <p>Esta semana comparada à semana passada</p>
                            </div>
                        </div>
                        <div id="chartSemana" class="chart-box"></div>
                    </div>

                    {{-- 2) Assuntos mais procurados --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Assuntos mais procurados</h3>
                                <p>Temas das dúvidas das usuárias</p>
                            </div>
                        </div>
                        <div id="chartAssuntos" class="chart-box"></div>
                    </div>

                </div>

                <div class="dashboard-grid">

                    {{-- 3) Atendimentos por dia --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Atendimentos por dia</h3>
                                <p>Últimos 20 dias</p>
                            </div>
                        </div>
                        <div id="chartDias" class="chart-box--sm chart-box"></div>
                        <p class="chart-hint">Clique em uma barra para ampliar · duplo clique para voltar.</p>
                    </div>

                    {{-- 4) Evolução das usuárias atendidas --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Usuárias atendidas</h3>
                                <p>Evolução na semana</p>
                            </div>
                        </div>
                        <div id="chartEvolucao" class="chart-box--sm chart-box"></div>
                    </div>

                </div>

                {{-- ============ AVALIAÇÕES RECENTES ============ --}}
                <div class="card">
                    <div class="card-head">
                        <h3>Avaliações recentes</h3>
                    </div>

                    <div class="reviews-grid">
                        @if ($avaliacoesRecentes->isEmpty())
                            <div class="review-card" style="grid-column: 1 / -1; text-align: center; padding: 32px;">
                                <p style="color: var(--text-muted);">Nenhuma avaliação recente.</p>
                            </div>
                        @else
                            @foreach ($avaliacoesRecentes as $avaliacao)
                                <div class="review-card">
                                    <div class="review-stars">{{ str_repeat('★', $avaliacao->nota) }}{{ str_repeat('☆', 5 - $avaliacao->nota) }}</div>
                                    <p>"{{ $avaliacao->comentario ?? 'Sem comentário' }}"</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </main>

        </div>

    </div>

    {{-- ============ DADOS PARA OS GRÁFICOS (PASSADOS PRO JS) ============ --}}
    <script>
        window.dashboardData = {
            atendimentosPorDia: @json($atendimentosPorDia),
            assuntos: @json($assuntos->map(function($a) { return ['assunto' => $a->assunto ?? $a->historicoConsulta, 'total' => $a->total, 'cor' => '#9E182B']; })),
            semanaComparada: @json($semanaComparada),
            evolucaoSemanal: @json($evolucaoSemanal)
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    <script src="{{ asset('js/dashboard-graficos.js') }}"></script>

</body>

</html>