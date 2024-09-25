<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/configuracoes', function () {
    return view('configuration');
});

Route::get('/importacoes', function () {
    return view('imports');
});
