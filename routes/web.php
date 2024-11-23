<?php

use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StatementsController;
use App\Http\Controllers\HistoryStatementsController;
use App\Http\Controllers\CategoriesBudgetController;
use App\Http\Controllers\SubcategoriesBudgetController;
use App\Http\Controllers\PeriocitiesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\Dashboard\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rotas Resource
Route::resource('bancos', BankController::class);
Route::resource('categorias', CategoriesController::class);
Route::resource('extrato', StatementsController::class);
Route::resource('historico-extratos', HistoryStatementsController::class);
Route::resource('orcamento-categorias', CategoriesBudgetController::class);
Route::resource('orcamento-subcategorias', SubcategoriesBudgetController::class);
Route::resource('periodicidades', PeriocitiesController::class);
Route::resource('subcategorias', SubcategoriesController::class);
Route::resource('tipos-transacoes', TransactionTypeController::class);
Route::resource('categorias', CategoriesController::class);

// Rota para Importação de Histórico de Extrato
Route::get('/importacoes', [HistoryStatementsController::class, 'index'])->name('importacoes.historico-extrato');

// Rota do Dashboard (Home)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
