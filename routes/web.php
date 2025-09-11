<?php
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Dashboard\Index as Dashboard;
use App\Livewire\Pages\Statements\Index as Statements;
use App\Livewire\Pages\Imports\Index as Imports;

use App\Livewire\Pages\Settings\Banks\BankIndex;
use App\Livewire\Pages\Settings\Budgets\BudgetsIndex;
use App\Livewire\Pages\Settings\Categories\CategoriesIndex;
use App\Livewire\Pages\Settings\Recurrencetypes\RecurrencetypesIndex;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    /**
     * Criar uma landing page top e deixar na rota "/"
    */
});

Route::middleware('auth')->group(function () {
    /** Route Home */
    Route::get('/', [Dashboard::class, 'render'])->name('dashboard.index');


    /** Route Pages */
    Route::get('/extratos', Statements::class)->name('statements');
    Route::get('/importações', Imports::class)->name('imports');

    /** Routes Settings */
    Route::get('/categorias-subcategorias', CategoriesIndex::class)->name('categories');
    Route::get('/bancos-contas', BankIndex::class)->name('banks');
    Route::get('/orcamentos', BudgetsIndex::class)->name('budgets');
    Route::get('/transacoes-recorrentes', RecurrencetypesIndex::class)->name('recurrences');
});
