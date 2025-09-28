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

// Ação de login (fake para protótipo)
Route::post('/login', function (Request $request) {
    if ($request->email === 'admin@email.com' && $request->password === '123') {
        return redirect()->route('dashboard');
    }
    return back()->with('error', 'Credenciais inválidas!');
})->name('login.post');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Logout
Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');
