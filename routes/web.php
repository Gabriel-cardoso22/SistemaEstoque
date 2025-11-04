<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Login / Logout)
|--------------------------------------------------------------------------
*/

// Página inicial → redireciona para login
Route::get('/', fn() => redirect()->route('login'));

// Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login.attempt');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (somente autenticados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard do gerente
    Route::get('/dashboard/gerente', [GerenteController::class, 'index'])->name('dashboard.gerente');
    // Lista de gerentes
    Route::get('/gerentes/listar', [GerenteController::class, 'list'])
        ->name('gerentes.list');


    // Dashboard do funcionário
    Route::get('/dashboard/funcionario', [FuncionarioController::class, 'funcionario'])->name('dashboard.funcionario');

    // CRUD de gerentes
    Route::resource('gerentes', GerenteController::class)->except(['index']);

    // CRUD de produtos
    Route::resource('produtos', ProdutoController::class);
});

/*
|--------------------------------------------------------------------------
| Rota opcional de teste
|--------------------------------------------------------------------------
*/
Route::get('/telaCadastro', fn() => view('telaCadastro'))->name('telaCadastro');
