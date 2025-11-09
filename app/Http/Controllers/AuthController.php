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

            // Determinar URL de redirecionamento baseado no tipo de usuário
            $redirectUrl = null;
            if ($user->role === 'gerente') {
                $redirectUrl = route('dashboard.gerente');
            } elseif ($user->role === 'funcionario') {
                $redirectUrl = route('dashboard.funcionario');
            } else {
                // Caso não tenha role definida ou role inválida
                Auth::logout();
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Usuário sem permissões adequadas. Entre em contato com o administrador.'
                    ], 403);
                }
                
                return redirect()->route('login')->withErrors([
                    'error' => 'Usuário sem permissões adequadas.',
                ]);
            }

            // Responder com JSON se requisição espera JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login realizado com sucesso!',
                    'redirect' => $redirectUrl
                ]);
            }

            // Redirecionamento tradicional
            return redirect($redirectUrl);
        }

        // Falha na autenticação
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas. Tente novamente.'
            ], 401);
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
