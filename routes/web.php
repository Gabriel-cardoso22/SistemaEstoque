<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Login / Logout)
|--------------------------------------------------------------------------
*/

// Rota principal → Redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login (formulário)
Route::get('/login', [AuthController::class, 'index'])->name('login');

// Tentativa de login (POST)
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login.attempt');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Somente usuários autenticados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard de Gerente
    Route::get('/dashboard/gerente', [DashboardController::class, 'gerente'])
        ->name('dashboard.gerente');

    // Dashboard de Funcionário
    Route::get('/dashboard/funcionario', [DashboardController::class, 'funcionario'])
        ->name('dashboard.funcionario');

    // CRUD de Gerentes
    Route::resource('gerentes', GerenteController::class);

    // CRUD de Produtos
    Route::resource('produtos', ProdutoController::class);
});

/*
|--------------------------------------------------------------------------
| Rota opcional de teste de tela
|--------------------------------------------------------------------------
*/
Route::get('/telaCadastro', function () {
    return view('telaCadastro');
})->name('telaCadastro');
