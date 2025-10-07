<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Redireciona a rota raiz "/" para a tela de login
Route::get('/', function () {
    return redirect()->route('login');
});

// Tela de login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Processa o login
Route::post('/login', function (Request $request) {
    // Validação
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Acesso HardCoded para desenvolvimento (feito por IA)
    if ($request->email === 'admin@email.com' && $request->password === '123') {
        // Simula autenticação para desenvolvimento
        Auth::loginUsingId(1); // Assume que existe um usuário com ID 1, ou cria sessão fake
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso! [MODO DEV]');
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Sucesso
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso!');
    }

    // Erro
    return back()->with('error', 'Credenciais inválidas. Verifique seu email e senha.');
})->name('login.post');

// Dashboard com autenticação
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
})->name('logout');
