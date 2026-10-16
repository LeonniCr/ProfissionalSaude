{{-- Cards, gráfico e tabela do Relatório de Impacto (usado na tela e no PDF) --}}
<div class="rl-cards">
    <div class="rl-card">
        <span class="rl-card-icone"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg></span>
        <div>
            <p class="rl-card-rotulo">Usuárias atendidas</p>
            <strong class="rl-card-valor">{{ $cards['usuarias'] }}</strong>
            <p class="rl-card-nota">{{ $cards['atendimentos'] }} {{ $cards['atendimentos'] == 1 ? 'atendimento' : 'atendimentos' }} no período</p>
        </div>
    </div>

    <div class="rl-card">
        <span class="rl-card-icone"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" /></svg></span>
        <div>
            <p class="rl-card-rotulo">Tempo médio de resposta</p>
            <strong class="rl-card-valor">{{ $cards['resposta'] }}</strong>
            <p class="rl-card-nota">Entre a mensagem da usuária e a sua resposta</p>
        </div>
    </div>

    <div class="rl-card">
        <span class="rl-card-icone"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l2.7 5.6 6.1.8-4.5 4.3 1.1 6.1L12 16.9 6.6 19.8l1.1-6.1L3.2 9.4l6.1-.8L12 3Z" /></svg></span>
        <div>
            <p class="rl-card-rotulo">Nota média</p>
            <strong class="rl-card-valor">{{ $cards['nota'] !== null ? $cards['nota'] . ' / 5' : '—' }}</strong>
            <p class="rl-card-nota">{{ $cards['avaliacoes'] > 0 ? 'Baseada em ' . $cards['avaliacoes'] . ' ' . ($cards['avaliacoes'] == 1 ? 'avaliação' : 'avaliações') : 'Nenhuma avaliação no período' }}</p>
        </div>
    </div>
</div>

<section class="card rl-bloco">
    <div class="rl-bloco-topo">
        <div>
            <h3>Evolução mensal dos atendimentos</h3>
            <p>Atendimentos realizados por mês, até {{ $fim->format('d/m/Y') }}.</p>
        </div>
    </div>

    @php $maximo = max(1, max(array_column($grafico, 'total'))); @endphp
    <div class="rl-barras" role="img" aria-label="Gráfico de atendimentos por mês">
        @foreach ($grafico as $g)
            <div class="rl-barra-col">
                <span class="rl-barra-valor">{{ $g['total'] }}</span>
                <div class="rl-barra-trilho">
                    <div class="rl-barra {{ $g['total'] == 0 ? 'rl-barra--zero' : '' }}" style="height: {{ round($g['total'] / $maximo * 100) }}%"></div>
                </div>
                <span class="rl-barra-rotulo">{{ $g['rotulo'] }}</span>
            </div>
        @endforeach
    </div>
</section>

<section class="card rl-bloco">
    <div class="rl-bloco-topo">
        <div>
            <h3>Resumo dos atendimentos</h3>
            <p>{{ count($linhas) }} {{ count($linhas) == 1 ? 'atendimento' : 'atendimentos' }} no período selecionado.</p>
        </div>
    </div>

    @if (count($linhasTabela) == 0)
        <div class="pc-vazio" style="padding: 26px 10px 30px;">
            <strong>Nenhum atendimento no período</strong>
            <p>Escolha outro período para ver os atendimentos realizados.</p>
        </div>
    @else
        <div class="pc-scroll">
            <table class="pc-tabela rl-tabela">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tipo de atendimento</th>
                        <th>Avaliação recebida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($linhasTabela as $l)
                        <tr>
                            <td>{{ $l['data'] }}</td>
                            <td>{{ $l['tipo'] }}</td>
                            <td>
                                @if ($l['nota'] === null)
                                    <span class="pc-sem-nota">Sem avaliação</span>
                                @else
                                    <span class="pc-estrelas" title="{{ $l['nota'] }} de 5">{{ str_repeat('★', $l['nota']) }}{{ str_repeat('☆', 5 - $l['nota']) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($paginacao && $paginacao['paginas'] > 1)
            <div class="rl-paginacao">
                @if ($paginacao['pagina'] > 1)
                    <a href="{{ route('relatorios.index', $filtro + ['pagina' => $paginacao['pagina'] - 1]) }}">&lsaquo; Anterior</a>
                @endif
                <span>Página {{ $paginacao['pagina'] }} de {{ $paginacao['paginas'] }}</span>
                @if ($paginacao['pagina'] < $paginacao['paginas'])
                    <a href="{{ route('relatorios.index', $filtro + ['pagina' => $paginacao['pagina'] + 1]) }}">Próxima &rsaquo;</a>
                @endif
            </div>
        @endif
    @endif
</section>
