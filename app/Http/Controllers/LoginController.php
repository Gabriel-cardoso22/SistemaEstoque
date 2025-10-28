<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function index()
    {
        return view('auth.login');
    }

    // Processa o login
    public function autenticar(Request $request)
    {
        $usuario = $request->input('usuario');
        $senha = $request->input('senha');

        // Exemplo simples de autenticação
        if ($usuario === 'admin' && $senha === '123456') {
            return redirect('/dashboardGerente');
        }

        // Se falhar, volta com mensagem de erro
        return back()->with('error', 'Credenciais inválidas. Tente novamente.');
    }
}
