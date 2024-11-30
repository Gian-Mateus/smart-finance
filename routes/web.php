<?php

use App\Livewire\Welcome;
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

Route::get('/', Welcome::class);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     /** Route Home */
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
//     Route::resource('dashboard', DashboardController::class);
//     /** Routes Resource */
//     Route::resource('extratos', TransactionsController::class);
//     Route::resource('bancos', BanksController::class);
// });