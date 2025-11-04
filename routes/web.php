<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;

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

    /*
    |--------------------------------------------------------------------------
    | ROTAS GERENTE
    |--------------------------------------------------------------------------
    */
    Route::prefix('gerente')->group(function () {
        // Dashboard do gerente (rota usada no AuthController)
        Route::get('/dashboard', [GerenteController::class, 'index'])->name('dashboard.gerente');

        // CRUD de gerentes
        Route::get('/', [GerenteController::class, 'list'])->name('gerentes.index');
        Route::get('/create', [GerenteController::class, 'create'])->name('gerentes.create');
        Route::post('/', [GerenteController::class, 'store'])->name('gerentes.store');
        Route::get('/{gerente}/edit', [GerenteController::class, 'edit'])->name('gerentes.edit');
        Route::put('/{gerente}', [GerenteController::class, 'update'])->name('gerentes.update');
        Route::delete('/{gerente}', [GerenteController::class, 'destroy'])->name('gerentes.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ROTAS FUNCIONÁRIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('funcionario')->group(function () {
        // Dashboard do funcionário (rota usada no AuthController)
        Route::get('/dashboard', [FuncionarioController::class, 'index'])->name('dashboard.funcionario');

        // CRUD de funcionários
        Route::get('/', [FuncionarioController::class, 'index'])->name('funcionarios.index');
        Route::get('/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
        Route::post('/', [FuncionarioController::class, 'store'])->name('funcionarios.store');
        Route::get('/{funcionario}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
        Route::put('/{funcionario}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
        Route::delete('/{funcionario}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ROTAS PRODUTOS
    |--------------------------------------------------------------------------
    */
    Route::resource('produtos', ProdutoController::class);
});

/*
|--------------------------------------------------------------------------
| Rota opcional de teste
|--------------------------------------------------------------------------
*/
Route::get('/telaCadastro', fn() => view('telaCadastro'))->name('telaCadastro');
