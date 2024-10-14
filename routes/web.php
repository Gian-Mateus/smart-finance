<?php

use App\Http\Controllers\Configuration\BancoController;
use App\Http\Controllers\Configuration\CategoriaController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HistoricoExtratoController;
use App\Http\Controllers\Configuration\OrcamentoCategoriaController;
use App\Http\Controllers\Configuration\OrcamentoSubcategoriaController;
use App\Http\Controllers\Configuration\PeriodicidadeController;
use App\Http\Controllers\Configuration\SubcategoriaController;
use App\Http\Controllers\Configuration\TipoTransacaoController;
use Illuminate\Support\Facades\Route;

// Rotas Resource
Route::resource('bancos', BancoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('historico-extratos', HistoricoExtratoController::class);
Route::resource('orcamento-categorias', OrcamentoCategoriaController::class);
Route::resource('orcamento-subcategorias', OrcamentoSubcategoriaController::class);
Route::resource('periodicidades', PeriodicidadeController::class);
Route::resource('subcategorias', SubcategoriaController::class);
Route::resource('tipos-transacoes', TipoTransacaoController::class);

// Rotas Personalizadas para Configurações
Route::prefix('configuracoes')->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'categorias'])->name('configuracoes.categorias');
    Route::get('/periodicidades', [PeriodicidadeController::class, 'periodicidades'])->name('configuracoes.periodicidades');
    Route::get('/tipos-transacoes', [TipoTransacaoController::class, 'tiposTransacoes'])->name('configuracoes.tipos-transacoes');
    Route::get('/orcamentos', [OrcamentoCategoriaController::class, 'orcamentos'])->name('configuracoes.orcamentos');
    Route::get('/bancos', [BancoController::class, 'bancos'])->name('configuracoes.bancos');
});

// Rota para Importação de Histórico de Extrato
Route::get('/importacoes/historico-extrato', [HistoricoExtratoController::class, 'importar'])->name('importacoes.historico-extrato');

// Rota do Dashboard (Home)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');