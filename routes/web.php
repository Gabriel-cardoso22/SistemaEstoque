<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Redireciona a rota raiz "/" para a tela de login
Route::get('/', function () {
    return redirect()->route('login');
});

// Tela de login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Rota POST para login
Route::post('/login', function (Request $request) {

    // Validação
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email','password');

    if (Auth::attempt($credentials)) {
        // Login bem-sucedido
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'user' => $request->user() 
        ], 200);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Credenciais inválidas.'
    ], 401);
})->name('login.post');


// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Logout
Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');
