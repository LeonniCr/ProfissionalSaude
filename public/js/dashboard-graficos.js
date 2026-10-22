/* ==========================================================
   VÊNUS — Gráficos do dashboard (ECharts) — 4 GRÁFICOS
   public/js/dashboard-graficos.js

   Mesma lógica de antes (mesmos dados, tema e idioma). Mudanças:
   - "Atendimentos da semana" e "Assuntos mais procurados" agora são
     desenhados mesmo sem dados (barras zeradas / anel cinza),
     em vez do quadro cinza "Sem dados ainda".
   - Os nomes das categorias do gráfico da semana seguem a mesma ordem
     dos tipos que o controller conta.
   - As funções repetidas foram unidas em uma só.
   ========================================================== */

(function () {
    'use strict';

    var charts = {};

    function t(texto) { return window.Venus ? Venus.t(texto) : texto; }
    function escuro() { return window.Venus && Venus.getTema() === 'escuro'; }

    function cores() {
        var e = escuro();
        return {
            texto: e ? '#b3b3b3' : '#8a7680',
            grade: e ? '#2b2b2b' : '#f3e6e8',
            destaque: e ? '#ef5b73' : '#6b1330',
            borda: e ? '#151515' : '#ffffff',
            fundoBarra: e ? '#1f1f1f' : '#fbefee',
            linhaRotulo: e ? '#555555' : '#d9c3c8',
            eixoY: e ? '#8a8a8a' : '#b9a5ab',
            miolo: e ? '#151515' : '#ffffff',
            sombra: e ? 'rgba(0, 0, 0, 0.5)' : 'rgba(107, 19, 48, 0.18)',
            tooltip: {
                backgroundColor: e ? '#1f1f1f' : '#ffffff',
                borderColor: e ? '#333333' : '#eadfe1',
                textStyle: { color: e ? '#f5f5f5' : '#3a2530' }
            },
            vazio: e ? '#2a2a2a' : '#fafafa'
        };
    }

    function criar(id) {
        var el = document.getElementById(id);
        if (!el) return null;
        if (!charts[id]) charts[id] = echarts.init(el);
        return charts[id];
    }

    function grad(c1, c2) {
        return new echarts.graphic.LinearGradient(0, 0, 0, 1, [
            { offset: 0, color: c1 },
            { offset: 1, color: c2 }
        ]);
    }

    function tooltip(base, c) {
        var o = {};
        for (var k in base) o[k] = base[k];
        for (var k2 in c.tooltip) o[k2] = c.tooltip[k2];
        return o;
    }

    // Quadro "Sem dados ainda" (usado só se algum gráfico vier realmente sem estrutura)
    function desenharVazio(chart) {
        if (!chart) return;
        var c = cores();
        chart.clear();
        chart.setOption({
            title: {
                text: t('Sem dados ainda'),
                subtext: t('Os dados aparecerão aqui quando houver atendimentos.'),
                left: 'center',
                top: 'middle',
                textStyle: { color: c.texto, fontSize: 14, fontWeight: 500 },
                subtextStyle: { color: c.texto, fontSize: 12 }
            },
            backgroundColor: c.vazio
        }, true);
    }

    function desenhar() {
        if (typeof echarts === 'undefined') return;

        var c = cores();
        var dados = window.dashboardData || {};

        /* ---------- 1) Barras agrupadas: semana passada x esta semana ---------- */
        var c1 = criar('chartSemana');
        if (c1) {
            var sem = dados.semanaComparada || {};
            var passada = sem.semanaPassada || [0, 0, 0, 0, 0];
            var atual = sem.estaSemana || [0, 0, 0, 0, 0];

            c1.setOption({
                tooltip: tooltip({ trigger: 'axis', axisPointer: { type: 'shadow' } }, c),
                legend: { bottom: 0, icon: 'circle', textStyle: { color: c.texto } },
                grid: { left: 10, right: 40, top: 10, bottom: 40, containLabel: true },
                xAxis: {
                    type: 'value',
                    min: 0,
                    minInterval: 1,
                    max: function (v) { return Math.max(v.max, 4); },
                    splitLine: { lineStyle: { color: c.grade } },
                    axisLabel: { color: c.texto }
                },
                yAxis: {
                    type: 'category',
                    // mesma ordem do controller: agendada, duvida_rapida, encerrada, cancelada, aguardando
                    data: ['Agendada', 'Dúvida rápida', 'Encerrada', 'Cancelada', 'Aguardando'].map(t),
                    axisTick: { show: false },
                    axisLine: { lineStyle: { color: c.grade } },
                    axisLabel: { color: c.texto }
                },
                series: [
                    {
                        name: t('Semana passada'), type: 'bar', data: passada, barMaxWidth: 16,
                        itemStyle: { color: '#f1a3b3', borderRadius: [0, 6, 6, 0] },
                        label: { show: true, position: 'right', color: c.texto, fontSize: 11 }
                    },
                    {
                        name: t('Esta semana'), type: 'bar', data: atual, barMaxWidth: 16,
                        itemStyle: { color: '#9E182B', borderRadius: [0, 6, 6, 0] },
                        label: { show: true, position: 'right', color: c.destaque, fontWeight: 700, fontSize: 11 }
                    }
                ]
            }, true);
        }

        /* ---------- 2) Rosa/Pizza: assuntos mais procurados ---------- */
        var c2 = criar('chartAssuntos');
        if (c2) {
            var assuntos = dados.assuntos || [];
            var semAssuntos = !assuntos.length;

            c2.setOption({
                tooltip: semAssuntos ? { show: false } : tooltip({ trigger: 'item', formatter: '{b}: {c} ({d}%)' }, c),
                title: semAssuntos
                    ? {
                        text: t('Sem assuntos ainda'),
                        left: 'center',
                        top: 'middle',
                        textStyle: { color: c.texto, fontSize: 13, fontWeight: 500 }
                    }
                    : { show: false },
                series: [{
                    name: t('Assuntos'),
                    type: 'pie',
                    radius: semAssuntos ? ['52%', '70%'] : ['18%', '68%'],
                    center: ['50%', '52%'],
                    roseType: semAssuntos ? false : 'radius',
                    silent: semAssuntos,
                    data: semAssuntos
                        ? [{ value: 1, name: '', itemStyle: { color: c.fundoBarra } }]
                        : assuntos.map(function (a) {
                            return { value: a.total, name: t(a.assunto), itemStyle: { color: a.cor || '#9E182B' } };
                        }),
                    label: { show: !semAssuntos, color: c.texto, fontFamily: 'Poppins', fontSize: 11 },
                    labelLine: { show: !semAssuntos, lineStyle: { color: c.linhaRotulo }, smooth: 0.2, length: 8, length2: 14 },
                    itemStyle: semAssuntos
                        ? { borderWidth: 0 }
                        : { borderColor: c.borda, borderWidth: 2, shadowBlur: 12, shadowColor: c.sombra },
                    animationType: 'scale',
                    animationEasing: 'elasticOut',
                    animationDelay: function () { return Math.random() * 200; }
                }]
            }, true);
        }

        /* ---------- 3) Barras dos últimos 20 dias, com zoom ---------- */
        var c3 = criar('chartDias');
        if (c3) {
            var dadosDias = dados.atendimentosPorDia || [];
            if (!dadosDias.length) {
                desenharVazio(c3);
            } else {
                var maxY = Math.max(10, Math.max.apply(null, dadosDias.map(function (d) { return d.total; })));
                c3.setOption({
                    grid: { left: 10, right: 10, top: 10, bottom: 10, containLabel: true },
                    tooltip: {
                        trigger: 'axis', axisPointer: { type: 'shadow' },
                        formatter: function (p) {
                            return t('Dia') + ' ' + p[0].name + ': ' + p[0].value + ' ' + t('atendimentos');
                        }
                    },
                    xAxis: {
                        data: dadosDias.map(function (d) { return d.data; }),
                        axisLabel: { inside: true, color: '#fff', fontSize: 10 },
                        axisTick: { show: false }, axisLine: { show: false }, z: 10
                    },
                    yAxis: {
                        max: maxY, axisLine: { show: false }, axisTick: { show: false },
                        axisLabel: { color: c.eixoY }, splitLine: { show: false }
                    },
                    dataZoom: [{ type: 'inside' }],
                    series: [{
                        type: 'bar', showBackground: true, backgroundStyle: { color: c.fundoBarra },
                        itemStyle: {
                            borderRadius: [6, 6, 0, 0],
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                { offset: 0, color: '#d9506b' }, { offset: 0.5, color: '#9E182B' }, { offset: 1, color: '#9E182B' }
                            ])
                        },
                        emphasis: {
                            itemStyle: {
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                    { offset: 0, color: '#9E182B' }, { offset: 0.7, color: '#6b1330' }, { offset: 1, color: '#6b1330' }
                                ])
                            }
                        },
                        data: dadosDias.map(function (d) { return d.total; })
                    }]
                }, true);

                if (!c3.__eventosOk) {
                    c3.__eventosOk = true;
                    c3.on('click', function (params) {
                        var idx = params.dataIndex;
                        var labels = dadosDias.map(function (d) { return d.data; });
                        c3.dispatchAction({
                            type: 'dataZoom',
                            startValue: labels[Math.max(idx - 3, 0)],
                            endValue: labels[Math.min(idx + 3, labels.length - 1)]
                        });
                    });
                    c3.getZr().on('dblclick', function () {
                        c3.dispatchAction({ type: 'dataZoom', start: 0, end: 100 });
                    });
                }
            }
        }

        /* ---------- 4) Linha: usuárias atendidas na semana ---------- */
        var c4 = criar('chartEvolucao');
        if (c4) {
            var evolucao = dados.evolucaoSemanal || [];
            if (!evolucao.length) {
                desenharVazio(c4);
            } else {
                c4.setOption({
                    grid: { left: 10, right: 16, top: 16, bottom: 10, containLabel: true },
                    tooltip: tooltip({ trigger: 'axis' }, c),
                    xAxis: {
                        type: 'category', boundaryGap: false,
                        data: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'].map(t),
                        axisLine: { lineStyle: { color: c.grade } },
                        axisLabel: { color: c.texto }
                    },
                    yAxis: { type: 'value', splitLine: { lineStyle: { color: c.grade } }, axisLabel: { color: c.texto } },
                    series: [{
                        name: t('Usuárias atendidas'), type: 'line', smooth: true, data: evolucao,
                        symbol: 'circle', symbolSize: 8,
                        lineStyle: { width: 3, color: '#9E182B' },
                        itemStyle: { color: c.miolo, borderColor: '#9E182B', borderWidth: 2 },
                        areaStyle: { color: grad('rgba(158, 24, 43, 0.45)', 'rgba(158, 24, 43, 0.02)') }
                    }]
                }, true);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', desenhar);
    document.addEventListener('venus:tema', desenhar);
    document.addEventListener('venus:idioma', desenhar);

    window.addEventListener('resize', function () {
        Object.keys(charts).forEach(function (id) { charts[id].resize(); });
    });
})();