<?php

use App\Livewire\Welcome;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Settings\Banks\BankIndex;
use App\Livewire\Pages\Settings\Banks\AddAccount;
use App\Livewire\Pages\Dashboard\Index as Dashboard;
use App\Livewire\Pages\Settings\Categories\CategoriesIndex;

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

    /** Routes General */
    Route::get('/categorias-subcategorias', CategoriesIndex::class)->name('categories');
    Route::name('banks.')->group(function(){
        Route::get('/bancos', BankIndex::class)->name('index');
        // Route::get('/bancos/adicionar-conta', AddAccount::class)->name('addAccount');
    });
    //Route::get('/extratos', TransactionsController::class)->name('statements');
});