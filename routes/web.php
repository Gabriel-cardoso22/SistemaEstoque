<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;

// Rota principal → redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Tela de login
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Ação de autenticação
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.autenticar');

// Dashboard (tela inicial após login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Logout (simples - volta ao login)
Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');

//Controller Produto
Route::get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');

Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');