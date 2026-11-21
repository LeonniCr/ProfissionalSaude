<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\UsuariaController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SuporteController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\DestaqueController;
use App\Http\Controllers\ArquivoController;

// ---------- Rotas públicas (login) ----------
Route::get('/', [UserController::class, 'index'])->name('auth.index');
Route::post('/login', [UserController::class, 'login'])
    ->middleware('throttle:10,1')
    ->name('auth.login');

// ---------- Rotas protegidas (administrador logado) ----------
Route::middleware('autenticacao')->group(function () {

    Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout');
    Route::post('/logout/todos', [UserController::class, 'logoutTodos'])->name('auth.logout.todos');

    Route::get('/painel/dashboard', [DashboardController::class, 'index'])->name('painel.dashboard');
    Route::get('/painel/relatorio-geral', [RelatorioController::class, 'geral'])->name('painel.relatorio');

    // Aprovação de cadastros de profissionais
    Route::get('/painel/cadastros', [ProfissionalController::class, 'index'])->name('cadastros.index');
    Route::post('/painel/cadastros/lote', [ProfissionalController::class, 'lote'])->name('cadastros.lote');
    Route::get('/painel/cadastros/{id}', [ProfissionalController::class, 'show'])->name('cadastros.show');
    Route::post('/painel/cadastros/{id}/decidir', [ProfissionalController::class, 'decidir'])->name('cadastros.decidir');

    // Contas de usuárias: lista, ver a conta e suspender/reativar
    Route::get('/painel/usuarias', [UsuariaController::class, 'index'])->name('usuarias.index');
    Route::get('/painel/usuarias/{id}', [UsuariaController::class, 'show'])->name('usuarias.show');
    Route::patch('/painel/usuarias/{id}/status', [UsuariaController::class, 'atualizarStatus'])->name('usuarias.status');

    // Contas de profissionais: só a lista (os dados completos ficam na tela de análise do cadastro)
    Route::get('/painel/profissionais', [ProfissionalController::class, 'contas'])->name('profissionais.index');

    // Denúncias: lista e decisão (resolver ou reabrir)
    Route::get('/painel/denuncias', [DenunciaController::class, 'index'])->name('denuncias.index');
    Route::patch('/painel/denuncias/{id}/decisao', [DenunciaController::class, 'decidir'])->name('denuncias.decidir');

    // Mensagens denunciadas (por enquanto a tela usa dados de exemplo do adm.js)
    Route::get('/painel/mensagens-denunciadas', [DenunciaController::class, 'mensagens'])->name('mensagens.index');

    // Relatórios
    Route::get('/painel/relatorios/usuarias', [RelatorioController::class, 'usuarias'])->name('relatorios.usuarias');
    Route::get('/painel/relatorios/profissionais', [RelatorioController::class, 'profissionais'])->name('relatorios.profissionais');
    Route::get('/painel/relatorios/atendimento', [RelatorioController::class, 'atendimento'])->name('relatorios.atendimento');
    Route::get('/painel/relatorios/denuncias', [RelatorioController::class, 'denuncias'])->name('relatorios.denuncias');

    // Conteúdos: lista de todos os conteúdos (só visualizar) e criação
    Route::get('/painel/conteudos', [ConteudoController::class, 'index'])->name('conteudos.index');
    Route::get('/painel/conteudos/criar', [ConteudoController::class, 'create'])->name('conteudos.criar');
    Route::get('/painel/conteudos/aprovacao', [ConteudoController::class, 'aprovacao'])->name('conteudos.aprovacao');
    Route::post('/painel/conteudos/{conteudo}/decidir', [ConteudoController::class, 'decidir'])->whereNumber('conteudo')->name('conteudos.decidir');
    Route::post('/painel/conteudos', [ConteudoController::class, 'store'])->name('conteudos.store');
    Route::get('/painel/conteudos/{conteudo}/editar', [ConteudoController::class, 'edit'])->whereNumber('conteudo')->name('conteudos.editar');
    Route::put('/painel/conteudos/{conteudo}', [ConteudoController::class, 'update'])->whereNumber('conteudo')->name('conteudos.update');
    Route::delete('/painel/conteudos/{conteudo}', [ConteudoController::class, 'destroy'])->whereNumber('conteudo')->name('conteudos.destroy');

    // Imagens enviadas (capas e peças): entregues direto do storage, sem precisar do public/storage
    Route::get('/painel/arquivos/{caminho}', [ArquivoController::class, 'mostrar'])->where('caminho', '.*')->name('arquivos.mostrar');

    // Destaque sazonal: lista, criar (publica direto) e editar
    Route::get('/painel/destaques', [DestaqueController::class, 'index'])->name('destaques.index');
    Route::get('/painel/destaques/criar', [DestaqueController::class, 'create'])->name('destaques.criar');
    Route::post('/painel/destaques', [DestaqueController::class, 'store'])->name('destaques.store');
    Route::get('/painel/destaques/{destaque}/editar', [DestaqueController::class, 'edit'])->whereNumber('destaque')->name('destaques.edit');
    Route::put('/painel/destaques/{destaque}', [DestaqueController::class, 'update'])->whereNumber('destaque')->name('destaques.update');

    // Atendimento: feedbacks e chamados de suporte
    Route::get('/painel/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::post('/painel/feedbacks/{feedback}/responder', [FeedbackController::class, 'responder'])->whereNumber('feedback')->name('feedbacks.responder');
    Route::post('/painel/feedbacks/{feedback}/analisar', [FeedbackController::class, 'analisar'])->whereNumber('feedback')->name('feedbacks.analisar');
    Route::get('/painel/suporte', [SuporteController::class, 'index'])->name('suporte.index');

    // Perfil: visualizar, editar e excluir (suspender) a conta
    Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');
    Route::get('/perfil/editar', [UserController::class, 'editar'])->name('perfil.editar');
    Route::put('/perfil/editar', [UserController::class, 'atualizar'])->name('perfil.atualizar');
    Route::get('/perfil/senha', [UserController::class, 'senha'])->name('perfil.senha');
    Route::put('/perfil/senha', [UserController::class, 'atualizarSenha'])
        ->middleware('throttle:5,1')
        ->name('perfil.senha.atualizar');
    Route::put('/perfil/excluir', [UserController::class, 'excluirConta'])->name('perfil.excluir');

    // Configurações (conta, segurança, aparência, notificações)
    Route::get('/configuracoes', [UserController::class, 'configuracoes'])->name('configuracoes');
});
