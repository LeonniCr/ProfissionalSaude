<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdos | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/conteudos.css') }}">
    <script src="{{ asset('js/sidebar.js') }}"></script>
</head>

<body>

    @php
        $abrirEdicao = $errors->any() && old('codConteudo');
        $inicial = strtoupper(substr($profissional->nomeProfissionalSaude ?? 'P', 0, 1));
        $filtros = [
            ''           => 'Todos',
            'rascunho'   => 'Rascunhos',
            'em_revisao' => 'Em Revisão',
            'publicado'  => 'Publicados',
            'recusado'   => 'Recusados',
        ];
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

                    <a href="{{ route('pacientes.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg>
                        <span>Pacientes</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Gestão</p>

                    <a href="{{ route('conteudos.index') }}" class="nav-item active">
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
                <span class="breadcrumb">Vênus / <strong>Conteúdos</strong></span>

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

            <main class="page-content ct-page">

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
                        <h1>Publicação de conteúdo</h1>
                        <p class="subtitle">Crie artigos, vídeos e infográficos para a revisão editorial.</p>
                    </div>
                    <button type="button" class="btn-primary-sm" id="abrirModalConteudo">+ Criar novo conteúdo</button>
                </div>

                {{-- Filtros por status --}}
                <nav class="ct-filtros" aria-label="Filtrar por status">
                    @foreach ($filtros as $valor => $rotulo)
                        <a href="{{ $valor === '' ? route('conteudos.index') : route('conteudos.index', ['status' => $valor]) }}"
                           class="ct-pill {{ (string) $statusAtivo === (string) $valor ? 'active' : '' }}">{{ $rotulo }}</a>
                    @endforeach
                </nav>

                {{-- Cards --}}
                @if ($conteudos->isEmpty())
                    <div class="ct-vazio">
                        <strong>Nenhum conteúdo por aqui ainda</strong>
                        <p>Clique em “Criar novo conteúdo” para escrever seu primeiro material.</p>
                    </div>
                @else
                    <div class="ct-grid">
                        @foreach ($conteudos as $c)
                            <article class="ct-card"
                                     role="button" tabindex="0"
                                     data-id="{{ $c->codConteudo }}"
                                     data-titulo="{{ $c->tituloConteudo }}"
                                     data-categoria="{{ $c->codTipoCategoria }}"
                                     data-tipo="{{ $c->codTipoConteudo }}"
                                     data-corpo="{{ $c->corpoConteudo }}"
                                     data-status="{{ $c->statusConteudo }}"
                                     data-status-rotulo="{{ $c->status_rotulo }}">
                                <div class="ct-capa" @if ($c->capaConteudo) style="background-image:url('{{ asset('storage/' . $c->capaConteudo) }}')" @endif>
                                    @unless ($c->capaConteudo)
                                        <span>{{ $c->tituloConteudo }}</span>
                                    @endunless
                                </div>
                                <div class="ct-card-body">
                                    <span class="ct-tag">{{ $c->categoria->nomeTipoCategoria ?? '—' }}</span>
                                    <h3>{{ $c->tituloConteudo }}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($c->corpoConteudo), 90) ?: 'Sem texto ainda.' }}</p>
                                    <div class="ct-card-foot">
                                        <span class="ct-status ct-status--{{ $c->statusConteudo }}">{{ $c->status_rotulo }}</span>
                                        <span class="ct-meta">
                                            {{ $c->tipo->descricaoTipoConteudo ?? '' }}
                                            @if ($c->tempoLeituraMinutos) · {{ $c->tempoLeituraMinutos }} min @endif
                                            · {{ $c->dataCriacao->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif

            </main>

        </div>

    </div>

    {{-- ===================== MODAL: NOVO CONTEÚDO ===================== --}}
    <div class="ct-modal {{ $errors->any() && !$abrirEdicao ? 'open' : '' }}" id="modalConteudo" role="dialog" aria-modal="true" aria-labelledby="ctModalTitulo">
        <form class="ct-modal-box" method="POST" action="{{ route('conteudos.store') }}" novalidate>
            @csrf
            <button type="button" class="ct-modal-close" id="fecharModalConteudo" aria-label="Fechar">&times;</button>

            <h2 id="ctModalTitulo">Novo conteúdo</h2>
            <p class="ct-modal-sub">O conteúdo será enviado para a revisão editorial antes de ser publicado.</p>

            @if ($errors->any() && !$abrirEdicao)
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="field">
                <label for="tituloConteudo">Título</label>
                <input type="text" id="tituloConteudo" name="tituloConteudo" maxlength="150"
                       value="{{ old('tituloConteudo') }}" placeholder="Ex: Como cuidar da saúde menstrual...">
            </div>

            <div class="field-row-2">
                <div class="field">
                    <label for="codTipoCategoria">Categoria</label>
                    <select id="codTipoCategoria" name="codTipoCategoria">
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->codTipoCategoria }}" @selected(old('codTipoCategoria') == $cat->codTipoCategoria)>
                                {{ $cat->nomeTipoCategoria }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="codTipoConteudo">Formato</label>
                    <select id="codTipoConteudo" name="codTipoConteudo">
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->codTipoConteudo }}" @selected(old('codTipoConteudo') == $tipo->codTipoConteudo)>
                                {{ $tipo->descricaoTipoConteudo }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="corpoConteudo">Conteúdo</label>
                <textarea id="corpoConteudo" name="corpoConteudo" rows="7"
                          placeholder="Escreva um conteúdo educativo...">{{ old('corpoConteudo') }}</textarea>
            </div>

            <div class="ct-modal-actions">
                <button type="submit" name="acao" value="rascunho" class="btn-outline-sm">Salvar rascunho</button>
                <button type="submit" name="acao" value="revisao" class="btn-primary-sm">Enviar para revisão</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var modal = document.getElementById('modalConteudo');
            var abrir = document.getElementById('abrirModalConteudo');
            var fechar = document.getElementById('fecharModalConteudo');

            function abrirModal() { modal.classList.add('open'); document.getElementById('tituloConteudo').focus(); }
            function fecharModal() { modal.classList.remove('open'); }

            abrir.addEventListener('click', abrirModal);
            fechar.addEventListener('click', fecharModal);
            modal.addEventListener('click', function (e) { if (e.target === modal) fecharModal(); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') fecharModal(); });

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
    {{-- ===================== MODAL: EDITAR CONTEÚDO ===================== --}}
    <div class="ct-modal {{ $abrirEdicao ? 'open' : '' }}" id="modalEditar" role="dialog" aria-modal="true" aria-labelledby="ctEditarTitulo">
        <form class="ct-modal-box" method="POST" action="" id="formEditar" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" name="codConteudo" id="edId" value="{{ old('codConteudo') }}">
            <button type="button" class="ct-modal-close" id="fecharModalEditar" aria-label="Fechar">&times;</button>

            <h2 id="ctEditarTitulo">Editar conteúdo <span class="ct-status" id="edStatus"></span></h2>
            <p class="ct-modal-sub" id="edSub"></p>

            @if ($abrirEdicao)
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="field">
                <label for="edTitulo">Título</label>
                <input type="text" id="edTitulo" name="tituloConteudo" maxlength="150">
            </div>

            <div class="field-row-2">
                <div class="field">
                    <label for="edCategoria">Categoria</label>
                    <select id="edCategoria" name="codTipoCategoria">
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->codTipoCategoria }}">{{ $cat->nomeTipoCategoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="edTipo">Formato</label>
                    <select id="edTipo" name="codTipoConteudo">
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->codTipoConteudo }}">{{ $tipo->descricaoTipoConteudo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="edCorpo">Conteúdo</label>
                <textarea id="edCorpo" name="corpoConteudo" rows="7"></textarea>
            </div>

            <div class="ct-modal-actions">
                <button type="submit" name="acao" value="privar" class="btn-outline-sm ct-btn-privar" data-para="publicado">Privar conteúdo</button>
                <button type="submit" name="acao" value="rascunho" class="btn-outline-sm" data-para="rascunho" id="btnRascunho">Manter como rascunho</button>
                <button type="submit" name="acao" value="rascunho" class="btn-outline-sm" data-para="recusado">Salvar como rascunho</button>
                <button type="submit" name="acao" value="revisao" class="btn-primary-sm" data-para="rascunho publicado recusado">Enviar para revisão</button>
                <button type="button" class="btn-outline-sm" data-para="em_revisao" id="btnFecharRevisao">Fechar</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var modal = document.getElementById('modalEditar');
            var form = document.getElementById('formEditar');
            var baseUrl = "{{ url('/conteudo') }}";
            var campos = {
                titulo: document.getElementById('edTitulo'),
                categoria: document.getElementById('edCategoria'),
                tipo: document.getElementById('edTipo'),
                corpo: document.getElementById('edCorpo')
            };
            var rotulo = document.getElementById('edStatus');
            var sub = document.getElementById('edSub');
            var idCampo = document.getElementById('edId');

            var textos = {
                rascunho: 'Rascunho: continue editando ou envie para a revisão editorial.',
                publicado: 'Publicado: ao privar, o conteúdo deixa de ser público e volta a ser rascunho.',
                recusado: 'Recusado: ajuste o conteúdo e envie novamente para a revisão.',
                em_revisao: 'Em revisão: a equipe editorial está analisando, por isso a edição está bloqueada.'
            };

            function abrir(dados) {
                form.action = baseUrl + '/' + dados.id;
                idCampo.value = dados.id;
                campos.titulo.value = dados.titulo;
                campos.categoria.value = dados.categoria;
                campos.tipo.value = dados.tipo;
                campos.corpo.value = dados.corpo;

                rotulo.textContent = dados.statusRotulo;
                rotulo.className = 'ct-status ct-status--' + dados.status;
                sub.textContent = textos[dados.status] || '';

                var bloqueado = dados.status === 'em_revisao';
                Object.keys(campos).forEach(function (k) { campos[k].disabled = bloqueado; });

                // Mostra só os botões que valem para o status atual
                form.querySelectorAll('.ct-modal-actions [data-para]').forEach(function (b) {
                    var lista = b.getAttribute('data-para').split(' ');
                    b.style.display = lista.indexOf(dados.status) !== -1 ? '' : 'none';
                });

                modal.classList.add('open');
            }

            function fechar() { modal.classList.remove('open'); }

            document.querySelectorAll('.ct-card[data-id]').forEach(function (card) {
                function abrirCard() {
                    abrir({
                        id: card.dataset.id,
                        titulo: card.dataset.titulo,
                        categoria: card.dataset.categoria,
                        tipo: card.dataset.tipo,
                        corpo: card.dataset.corpo,
                        status: card.dataset.status,
                        statusRotulo: card.dataset.statusRotulo
                    });
                }
                card.addEventListener('click', abrirCard);
                card.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); abrirCard(); }
                });
            });

            document.getElementById('fecharModalEditar').addEventListener('click', fechar);
            document.getElementById('btnFecharRevisao').addEventListener('click', fechar);
            modal.addEventListener('click', function (e) { if (e.target === modal) fechar(); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') fechar(); });

            @if ($abrirEdicao)
            // Erro de validação: reabre o modal do conteúdo certo, com o que a pessoa digitou
            var antigo = @json(old());
            var card = document.querySelector('.ct-card[data-id="' + antigo.codConteudo + '"]');
            if (card) {
                abrir({
                    id: card.dataset.id,
                    titulo: antigo.tituloConteudo !== undefined ? antigo.tituloConteudo : card.dataset.titulo,
                    categoria: antigo.codTipoCategoria || card.dataset.categoria,
                    tipo: antigo.codTipoConteudo || card.dataset.tipo,
                    corpo: antigo.corpoConteudo !== undefined && antigo.corpoConteudo !== null ? antigo.corpoConteudo : card.dataset.corpo,
                    status: card.dataset.status,
                    statusRotulo: card.dataset.statusRotulo
                });
            }
            @endif
        })();
    </script>
</body>

</html>
