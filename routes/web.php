<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GerenteController;

// Rota principal → redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Tela de login
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Processa o login
Route::post('/login', function (Request $request) {
    // Validação
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Acesso HardCoded para desenvolvimento
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
            'redirect' => route('dashboardGerente') // 👈 Corrigido
        ]);
    }
    

    // Erro
    return response()->json([
        'success' => false,
        'message' => 'Credenciais inválidas. Verifique seu email e senha.'
    ], 401);
})->name('login.post');

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
})->name('logout');

Route::resource('gerentes', GerenteController::class);

Route::get('/dashboardGerente', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboardGerente');
