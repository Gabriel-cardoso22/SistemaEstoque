<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;

// ROTA PRINCIPAL → Redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // 🔹 Acesso HardCoded para desenvolvimento
    if ($request->email === 'admin@email.com' && $request->password === '123') {
        Auth::loginUsingId(1);
        $request->session()->regenerate();
        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso! [DEV]',
            'redirect' => route('dashboardGerente')
        ]);
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso!',
            'redirect' => route('dashboardGerente')
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Credenciais inválidas. Verifique seu email e senha.'
    ], 401);
})->name('login.post');

// LOGOUT
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
})->name('logout');

// ROTAS PROTEGIDAS (APÓS LOGIN)
Route::middleware(['auth'])->group(function () {

    // Dashboard principal
    Route::get('/dashboardGerente', [DashboardController::class, 'index'])
        ->name('dashboardGerente');

    // Gerentes
    Route::resource('gerentes', GerenteController::class);

    // 🔹 CRUD de Produtos (API completa)
    Route::resource('produtos', ProdutoController::class);
});

// ROTA DE TESTE DE TELAS (opcional)
Route::get('/telaCadastro', function () {
    return view('telaCadastro');
})->name('telaCadastro');
