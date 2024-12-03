<?php

use App\Livewire\Welcome;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Pages\Dashboard\Index as Dashboard;
use App\Livewire\Pages\Settings\Categories\CategoriesIndex;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware('auth')->group(function () {
    /** Route Home */
    Route::get('/', [Dashboard::class, 'render'])->name('dashboard.index');

    /** Routes Resource */
    Route::resource('statements', TransactionsController::class);
    Route::resource('banks', BanksController::class);
    Route::get('/categorias-subcategorias', CategoriesIndex::class)->name('categories');
});