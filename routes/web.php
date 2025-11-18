<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RelatorioController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Login / Logout)
|--------------------------------------------------------------------------
*/

// Página inicial → redireciona para login
Route::get('/', fn() => redirect()->route('login'));

// Home (dashboard geral)
Route::get('/home', function() {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'gerente') {
            return redirect()->route('dashboard.gerente');
        }
        if ($user->role === 'funcionario') {
            return redirect()->route('dashboard.funcionario');
        }
        // Se não tem role definida, redireciona para o login
        Auth::logout();
        return redirect()->route('login')->withErrors(['error' => 'Usuário sem permissões definidas.']);
    }
    return redirect()->route('login');
})->name('home');

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
        Route::get('/', [FuncionarioController::class, 'list'])->name('funcionarios.index');
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
    Route::prefix('produtos')->group(function () {

        Route::get('/dashboard', [ProdutoController::class, 'index'])->name('dashboard.produto');
    
        Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
        Route::get('/create', [ProdutoController::class, 'create'])->name('produto.create');
        Route::post('/', [ProdutoController::class, 'store'])->name('produto.store');
        Route::get('/{produto}/edit', [ProdutoController::class, 'edit'])->name('produto.edit');
        Route::put('/{produto}', [ProdutoController::class, 'update'])->name('produto.update');
        Route::delete('/{produto}', [ProdutoController::class, 'destroy'])->name('produto.destroy');
    
        // Opcional
        // Route::get('/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
    });
    Route::prefix('fornecedores')->group(function () {
        Route::get('/', [\App\Http\Controllers\FornecedorController::class, 'index'])->name('fornecedores.index');
        Route::get('/create', [\App\Http\Controllers\FornecedorController::class, 'create'])->name('fornecedores.create');
        Route::post('/', [\App\Http\Controllers\FornecedorController::class, 'store'])->name('fornecedores.store');
        Route::get('/{fornecedor}/edit', [\App\Http\Controllers\FornecedorController::class, 'edit'])->name('fornecedores.edit');
        Route::put('/{fornecedor}', [\App\Http\Controllers\FornecedorController::class, 'update'])->name('fornecedores.update');
        Route::delete('/{fornecedor}', [\App\Http\Controllers\FornecedorController::class, 'destroy'])->name('fornecedores.destroy');
    });
    
});

/*
|--------------------------------------------------------------------------
| Rota opcional de teste
|--------------------------------------------------------------------------
*/
Route::get('/telaCadastro', fn() => view('telaCadastro'))->name('telaCadastro');

/*
|--------------------------------------------------------------------------
| Rota de geração de relatórios em PDF
|--------------------------------------------------------------------------
*/
Route::get('/relatorio-produtos', [RelatorioController::class, 'gerarRelatorio'])->name('relatorio.produtos');
