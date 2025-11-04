<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Exibe o formulário de login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Tenta autenticar o usuário
     */
    public function loginAttempt(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirecionamento baseado no tipo de usuário
            if ($user->role === 'gerente') {
                return redirect()->route('dashboard.gerente'); // rota para gerente
            }

            if ($user->role === 'funcionario') {
                return redirect()->route('dashboard.funcionario'); // rota para funcionário
            }

            // Caso não tenha role definida, redireciona para uma rota padrão
            return redirect()->route('home');
        }

        return back()->withInput()->withErrors([
            'error' => 'Credenciais inválidas. Tente novamente.',
        ]);
    }

    /**
     * Efetua o logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
