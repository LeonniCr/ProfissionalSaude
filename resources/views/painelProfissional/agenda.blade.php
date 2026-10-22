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

                    <a href="{{ url('/dashboard') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8" /><path d="M5 10v10h14V10" /></svg>
                        <span>Painel</span>
                    </a>

                    <a href="{{ route('agenda.index') }}" class="nav-item active">
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
                <span class="breadcrumb">Vênus / <strong>Agenda</strong></span>

                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                    <input type="text" placeholder="Buscar datas e campanhas...">
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

                @if (session('erro'))
                    <div class="alert-error" style="margin-bottom:16px;">{{ session('erro') }}</div>
                @endif

                <div class="page-header">
                    <div>
                        <h1>Agenda</h1>
                        <p class="subtitle">Datas e campanhas de relevância para a saúde da mulher, mês a mês, para planejar seus conteúdos.</p>
                    </div>

                    @if (count($relevancias) > 0)
                        <button type="button" class="btn-primary-sm" data-criar>+ Criar conteúdo</button>
                    @endif
                </div>

                <section class="ag-card">

                    <div class="ag-toolbar">
                        <div class="ag-nav">
                            <a href="{{ route('agenda.index', ['mes' => $mesAnterior]) }}" class="ag-nav-btn" aria-label="Mês anterior">&lt;</a>
                            <span class="ag-mes">{{ $tituloMes }}</span>
                            <a href="{{ route('agenda.index', ['mes' => $mesSeguinte]) }}" class="ag-nav-btn" aria-label="Próximo mês">&gt;</a>
                            @unless ($ehMesAtual)
                                <a href="{{ route('agenda.index') }}" class="ag-hoje">Hoje</a>
                            @endunless
                        </div>

                        <div class="ag-legenda">
                            <span><i class="ag-dot ag-dot--hoje"></i>Hoje</span>
                            <span><i class="ag-dot ag-dot--data"></i>Data de relevância</span>
                        </div>
                    </div>

                    {{-- Datas de relevância do mês --}}
                    @if (count($relevancias) > 0)
                        <div class="cal-relevancia">
                            <p class="cal-relevancia-titulo">Datas de relevância em {{ $nomeMes }}</p>

                            <div class="cal-relevancia-lista">
                                @foreach ($relevancias as $r)
                                    <article class="cal-rel" style="--cor: {{ $r['cor'] }}">
                                        <span class="cal-rel-rotulo">{{ $r['rotulo'] }}</span>
                                        <div class="cal-rel-corpo">
                                            <h3>{{ $r['nome'] }}</h3>
                                            <p><strong>Sugestão de pauta:</strong> {{ $r['pauta'] }}</p>
                                            @if ($r['categoriaNome'])
                                                <span class="cal-rel-cat">{{ $r['categoriaNome'] }}</span>
                                            @endif
                                        </div>
                                        <button type="button" class="btn-outline-sm cal-rel-btn" data-criar data-id="{{ $r['id'] }}">Criar conteúdo</button>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="cal-sem-datas">Nenhuma data de relevância para a saúde da mulher em {{ $nomeMes }}.</p>
                    @endif

                    {{-- Calendário --}}
                    <div class="ag-scroll">
                        <div class="cal-grade" role="grid" aria-label="Calendário de {{ $tituloMes }}">

                            @foreach ($diasSemana as $nomeDia)
                                <div class="cal-cab" role="columnheader">{{ $nomeDia }}</div>
                            @endforeach

                            @foreach ($semanas as $semana)
                                @foreach ($semana as $celula)
                                    <div class="cal-dia {{ $celula['doMes'] ? '' : 'cal-dia--fora' }} {{ $celula['hoje'] ? 'cal-dia--hoje' : '' }}" role="gridcell">
                                        <span class="cal-num">{{ $celula['numero'] }}</span>

                                        @foreach ($celula['itens'] as $item)
                                            <button type="button" class="cal-chip" style="--cor: {{ $item['cor'] }}"
                                                    data-criar data-id="{{ $item['id'] }}"
                                                    title="{{ $item['nome'] }} — criar conteúdo">{{ $item['nome'] }}</button>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endforeach

                        </div>
                    </div>

                </section>

                <p class="ag-rodape">Vênus &bull; A Saúde da Mulher</p>

            </main>
        </div>
    </div>

    {{-- ===================== MODAL: CRIAR CONTEÚDO ===================== --}}
    <div class="ag-modal {{ $errors->any() ? 'open' : '' }}" id="modalConteudo" role="dialog" aria-modal="true" aria-labelledby="agConteudoTitulo">
        <form class="ag-modal-box ag-modal-box--lg" method="POST" action="{{ route('conteudos.store') }}" novalidate>
            @csrf
            <input type="hidden" name="dataPlanejadaConteudo" id="agDataPlanejada" value="{{ old('dataPlanejadaConteudo') }}">
            <button type="button" class="ag-modal-close" id="fecharModalConteudo" aria-label="Fechar">&times;</button>

            <h2 id="agConteudoTitulo">Criar conteúdo</h2>
            <p class="ag-modal-sub">O conteúdo será enviado para a revisão editorial antes de ser publicado.</p>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (count($relevancias) > 0)
                <div class="field">
                    <label for="agRelevancia">Data de relevância</label>
                    <select id="agRelevancia">
                        @foreach ($relevancias as $r)
                            <option value="{{ $r['id'] }}">{{ $r['rotulo'] }} — {{ $r['nome'] }}</option>
                        @endforeach
                    </select>
                    <p class="cal-pauta" id="agPauta"></p>
                </div>
            @endif

            <div class="field">
                <label for="agTitulo">Título</label>
                <input type="text" id="agTitulo" name="tituloConteudo" maxlength="150"
                       value="{{ old('tituloConteudo') }}" placeholder="Ex: Como cuidar da saúde menstrual...">
            </div>

            <div class="field-row-2">
                <div class="field">
                    <label for="agCategoria">Categoria</label>
                    <select id="agCategoria" name="codTipoCategoria">
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->codTipoCategoria }}" @selected(old('codTipoCategoria') == $cat->codTipoCategoria)>{{ $cat->nomeTipoCategoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="agFormato">Formato</label>
                    <select id="agFormato" name="codTipoConteudo">
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->codTipoConteudo }}" @selected(old('codTipoConteudo') == $tipo->codTipoConteudo)>{{ $tipo->descricaoTipoConteudo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="agCorpo">Conteúdo</label>
                <textarea id="agCorpo" name="corpoConteudo" rows="6" placeholder="Escreva um conteúdo educativo...">{{ old('corpoConteudo') }}</textarea>
            </div>

            <div class="ag-modal-actions">
                <button type="submit" name="acao" value="rascunho" class="btn-outline-sm">Salvar rascunho</button>
                <button type="submit" name="acao" value="revisao" class="btn-primary-sm">Enviar para revisão</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var modal = document.getElementById('modalConteudo');
            var relevancias = @json($relevancias);
            var selRel = document.getElementById('agRelevancia');
            var pauta = document.getElementById('agPauta');

            function abrir() { modal.classList.add('open'); }
            function fechar() { modal.classList.remove('open'); }

            // Preenche título, categoria, data planejada e pauta com a data de relevância escolhida
            function preencher(id) {
                var r = relevancias.filter(function (x) { return String(x.id) === String(id); })[0];
                if (!r) return;
                if (selRel) selRel.value = r.id;
                document.getElementById('agTitulo').value = r.nome;
                document.getElementById('agCategoria').value = r.categoriaId;
                document.getElementById('agDataPlanejada').value = r.data;
                if (pauta) pauta.innerHTML = '<strong>Sugestão de pauta:</strong> ' + r.pauta.replace(/</g, '&lt;');
            }

            // Botões "Criar conteúdo" (cabeçalho, cartões e datas no calendário)
            document.querySelectorAll('[data-criar]').forEach(function (botao) {
                botao.addEventListener('click', function () {
                    if (relevancias.length) preencher(botao.dataset.id || relevancias[0].id);
                    abrir();
                    document.getElementById('agTitulo').focus();
                });
            });

            if (selRel) {
                selRel.addEventListener('change', function () { preencher(selRel.value); });
                // Ao reabrir por erro de validação, só mostra a pauta (mantém o que a pessoa digitou)
                if (modal.classList.contains('open')) {
                    var antiga = document.getElementById('agDataPlanejada').value;
                    var atual = relevancias.filter(function (x) { return x.data === antiga; })[0] || relevancias[0];
                    selRel.value = atual.id;
                    pauta.innerHTML = '<strong>Sugestão de pauta:</strong> ' + atual.pauta.replace(/</g, '&lt;');
                }
            }

            document.getElementById('fecharModalConteudo').addEventListener('click', fechar);
            modal.addEventListener('click', function (e) { if (e.target === modal) fechar(); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') fechar(); });
        })();
    </script>
</body>

</html>
