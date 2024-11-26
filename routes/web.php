<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** Route Home */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('dashboard', DashboardController::class);
    /** Routes Resource */
    Route::resource('extratos', TransactionsController::class);
    Route::resource('bancos', BanksController::class);
});

require __DIR__.'/auth.php';
