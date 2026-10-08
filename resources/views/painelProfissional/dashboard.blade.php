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

                    <a href="{{ url('/caixa-de-entrada') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                        <span>Caixa de Entrada</span>
                        @if (($naoLidas ?? 0) > 0)
                            <span class="nav-badge">{{ $naoLidas }}</span>
                        @endif
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
                        <h1>Boa tarde, Profissional</h1>
                        <p class="subtitle">Visão geral das suas atividades hoje.</p>
                    </div>
                    <a href="#" class="btn-primary-sm">+ Definir disponibilidade</a>
                </div>

                {{-- Cartões de indicadores (dados de exemplo) --}}
                <div class="stats-grid">

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                            Consultas hoje
                        </div>
                        <div class="stat-value">8</div>
                        <p class="stat-foot">+2 em relação a ontem</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                            Mensagens pendentes
                        </div>
                        <div class="stat-value">5</div>
                        <p class="stat-foot">2 aguardando há +2h</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l2.6 5.6 6.1.6-4.6 4 1.3 6-5.4-3.1-5.4 3.1 1.3-6-4.6-4 6.1-.6Z" /></svg>
                            Avaliação média
                        </div>
                        <div class="stat-value">4,9</div>
                        <p class="stat-foot">★★★★★</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg>
                            Usuárias atendidas
                        </div>
                        <div class="stat-value">142</div>
                        <p class="stat-foot">+18 esta semana</p>
                    </div>

                </div>

                {{-- Gráfico de áreas empilhadas + pizza (dados de exemplo) --}}
                <div class="dashboard-grid">

                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Atendimentos da semana</h3>
                                <p>Distribuição por tipo de atendimento</p>
                            </div>
                        </div>
                        <div id="chartSemana" class="chart-box"></div>
                    </div>

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

                {{-- Próximos atendimentos + fila de dúvidas (dados de exemplo) --}}
                <div class="dashboard-grid">

                    <div class="card">
                        <div class="card-head">
                            <h3>Próximos atendimentos</h3>
                            <a href="#">Ver agenda
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </a>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">14:30</span>
                            <div class="appointment-info">
                                <strong>Mariana Lima</strong>
                                <span>Consulta de rotina</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status agendada">Agendada</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">15:30</span>
                            <div class="appointment-info">
                                <strong>Juliana Santos</strong>
                                <span>Dúvida rápida</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status duvida">Dúvida rápida</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">16:00</span>
                            <div class="appointment-info">
                                <strong>Carla Oliveira</strong>
                                <span>Retorno</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status agendada">Agendada</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">16:30</span>
                            <div class="appointment-info">
                                <strong>Fernanda Rocha</strong>
                                <span>Primeira consulta</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status agendada">Agendada</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h3>Fila de dúvidas rápidas</h3>
                            <a href="#">Ver todas
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </a>
                        </div>

                        <div class="queue-item">
                            <span class="avatar-circle">A</span>
                            <div class="queue-info">
                                <strong>Ana Beatriz</strong>
                                <span>Aguardando resposta</span>
                            </div>
                            <span class="queue-time">3m</span>
                        </div>

                        <div class="queue-item">
                            <span class="avatar-circle">C</span>
                            <div class="queue-info">
                                <strong>Camila Ferreira</strong>
                                <span>Aguardando resposta</span>
                            </div>
                            <span class="queue-time">7m</span>
                        </div>

                        <div class="queue-item">
                            <span class="avatar-circle">M</span>
                            <div class="queue-info">
                                <strong>Mariana Souza</strong>
                                <span>Aguardando resposta</span>
                            </div>
                            <span class="queue-time">15m</span>
                        </div>
                    </div>

                </div>

                {{-- Barras com zoom + evolução (dados de exemplo) --}}
                <div class="dashboard-grid">

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

                {{-- Avaliações (dados de exemplo) --}}
                <div class="card">
                    <div class="card-head">
                        <h3>Avaliações recentes</h3>
                    </div>

                    <div class="reviews-grid">
                        <div class="review-card">
                            <div class="review-stars">★★★★★</div>
                            <p>"Me senti acolhida e consegui entender minhas opções sem julgamento."</p>
                        </div>

                        <div class="review-card">
                            <div class="review-stars">★★★★★</div>
                            <p>"Resposta clara e rápida. Muito obrigada."</p>
                        </div>
                    </div>
                </div>

            </main>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    <script>
        // Todos os dados abaixo são de exemplo (fictícios)
        var corTexto = '#8a7680';
        var corGrade = '#f3e6e8';
        var charts = [];

        function criar(id) {
            var el = document.getElementById(id);
            if (!el) return null;
            var c = echarts.init(el);
            charts.push(c);
            return c;
        }

        function grad(c1, c2) {
            return new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                { offset: 0, color: c1 },
                { offset: 1, color: c2 }
            ]);
        }

        var dias = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'];

        // 1) Áreas empilhadas com degradê
        var c1 = criar('chartSemana');
        if (c1) c1.setOption({
            color: ['#6b1330', '#9E182B', '#e0708a'],
            tooltip: { trigger: 'axis', axisPointer: { type: 'cross', label: { backgroundColor: '#6b1330' } } },
            legend: { bottom: 0, icon: 'circle', textStyle: { color: corTexto } },
            grid: { left: 10, right: 16, top: 16, bottom: 36, containLabel: true },
            xAxis: [{ type: 'category', boundaryGap: false, data: dias, axisLine: { lineStyle: { color: corGrade } }, axisLabel: { color: corTexto } }],
            yAxis: [{ type: 'value', splitLine: { lineStyle: { color: corGrade } }, axisLabel: { color: corTexto } }],
            series: [
                { name: 'Consulta por chat', type: 'line', stack: 'Total', smooth: true, lineStyle: { width: 0 }, showSymbol: false,
                  areaStyle: { opacity: 0.9, color: grad('#8f1d3f', '#6b1330') }, emphasis: { focus: 'series' }, data: [14, 23, 11, 26, 9, 34, 25] },
                { name: 'Agendadas', type: 'line', stack: 'Total', smooth: true, lineStyle: { width: 0 }, showSymbol: false,
                  areaStyle: { opacity: 0.9, color: grad('#d9506b', '#9E182B') }, emphasis: { focus: 'series' }, data: [12, 28, 11, 23, 22, 34, 31] },
                { name: 'Dúvidas rápidas', type: 'line', stack: 'Total', smooth: true, lineStyle: { width: 0 }, showSymbol: false,
                  areaStyle: { opacity: 0.9, color: grad('#f6c3cd', '#e0708a') }, emphasis: { focus: 'series' }, data: [22, 30, 18, 23, 21, 29, 15] }
            ]
        });

        // 2) Pizza em formato de rosa (raio variável)
        var c2 = criar('chartAssuntos');
        if (c2) c2.setOption({
            tooltip: { trigger: 'item', formatter: '{b}: {c} ({d}%)' },
            series: [{
                name: 'Assuntos', type: 'pie', radius: ['18%', '68%'], center: ['50%', '52%'], roseType: 'radius',
                data: [
                    { value: 235, name: 'Saúde sexual', itemStyle: { color: '#f1a3b3' } },
                    { value: 274, name: 'Exames', itemStyle: { color: '#e0708a' } },
                    { value: 310, name: 'Ciclo menstrual', itemStyle: { color: '#c23553' } },
                    { value: 335, name: 'Pré-natal', itemStyle: { color: '#9E182B' } },
                    { value: 400, name: 'Anticoncepção', itemStyle: { color: '#6b1330' } }
                ],
                label: { color: corTexto, fontFamily: 'Poppins', fontSize: 11 },
                labelLine: { lineStyle: { color: '#d9c3c8' }, smooth: 0.2, length: 8, length2: 14 },
                itemStyle: { borderColor: '#fff', borderWidth: 2, shadowBlur: 12, shadowColor: 'rgba(107, 19, 48, 0.18)' },
                animationType: 'scale', animationEasing: 'elasticOut',
                animationDelay: function () { return Math.random() * 200; }
            }]
        });

        // 3) Barras com degradê, sombra e zoom ao clicar
        var c3 = criar('chartDias');
        if (c3) {
            var eixo = [], dados = [], sombra = [], yMax = 50, i;
            var valores = [22, 18, 19, 23, 29, 33, 31, 12, 44, 32, 9, 15, 21, 12, 13, 33, 20, 12, 13, 22];
            for (i = 0; i < valores.length; i++) {
                eixo.push(String(i + 1).padStart(2, '0'));
                dados.push(valores[i]);
                sombra.push(yMax);
            }
            c3.setOption({
                grid: { left: 10, right: 10, top: 10, bottom: 10, containLabel: true },
                tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' }, formatter: function (p) { return 'Dia ' + p[0].name + ': ' + p[0].value + ' atendimentos'; } },
                xAxis: { data: eixo, axisLabel: { inside: true, color: '#fff', fontSize: 10 }, axisTick: { show: false }, axisLine: { show: false }, z: 10 },
                yAxis: { max: yMax, axisLine: { show: false }, axisTick: { show: false }, axisLabel: { color: '#b9a5ab' }, splitLine: { show: false } },
                dataZoom: [{ type: 'inside' }],
                series: [{
                    type: 'bar', showBackground: true, backgroundStyle: { color: '#fbefee' },
                    itemStyle: { borderRadius: [6, 6, 0, 0], color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                        { offset: 0, color: '#d9506b' }, { offset: 0.5, color: '#9E182B' }, { offset: 1, color: '#9E182B' }
                    ]) },
                    emphasis: { itemStyle: { color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                        { offset: 0, color: '#9E182B' }, { offset: 0.7, color: '#6b1330' }, { offset: 1, color: '#6b1330' }
                    ]) } },
                    data: dados
                }]
            });

            var zoomSize = 6;
            c3.on('click', function (params) {
                c3.dispatchAction({
                    type: 'dataZoom',
                    startValue: eixo[Math.max(params.dataIndex - zoomSize / 2, 0)],
                    endValue: eixo[Math.min(params.dataIndex + zoomSize / 2, dados.length - 1)]
                });
            });
            c3.getZr().on('dblclick', function () {
                c3.dispatchAction({ type: 'dataZoom', start: 0, end: 100 });
            });
        }

        // 4) Área simples
        var c4 = criar('chartEvolucao');
        if (c4) c4.setOption({
            grid: { left: 10, right: 16, top: 16, bottom: 10, containLabel: true },
            tooltip: { trigger: 'axis' },
            xAxis: { type: 'category', boundaryGap: false, data: dias, axisLine: { lineStyle: { color: corGrade } }, axisLabel: { color: corTexto } },
            yAxis: { type: 'value', splitLine: { lineStyle: { color: corGrade } }, axisLabel: { color: corTexto } },
            series: [{
                name: 'Usuárias atendidas', type: 'line', smooth: true, data: [82, 93, 90, 93, 129, 133, 132],
                symbol: 'circle', symbolSize: 8,
                lineStyle: { width: 3, color: '#9E182B' },
                itemStyle: { color: '#fff', borderColor: '#9E182B', borderWidth: 2 },
                areaStyle: { color: grad('rgba(158, 24, 43, 0.45)', 'rgba(158, 24, 43, 0.02)') }
            }]
        });

        window.addEventListener('resize', function () {
            charts.forEach(function (c) { c.resize(); });
        });
    </script>

</body>

</html>