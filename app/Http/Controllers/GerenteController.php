<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GerenteController extends Controller
{
    /**
     * Dashboard do gerente (rota: dashboard.gerente)
     */
    public function index()
    {
        return view('Gerencia.dashboard');
    }

    /**
     * Lista todos os gerentes (rota: gerentes.index)
     */
    public function list()
    {
        $gerentes = User::where('role', 'gerente')->get();
        return view('Gerencia.index', compact('gerentes'));
    }

    /**
     * Exibe formulário de criação (rota: gerentes.create)
     */
    public function create()
    {
        return view('Gerencia.create');
    }

    /**
     * Salva um novo gerente (rota: gerentes.store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefone' => 'nullable|string|max:20',
        ]);

        $senhaTemporaria = Str::random(10);

        $gerente = User::create([
            'name'      => $request->nome,
            'email'     => $request->email,
            'telefone'  => $request->telefone, // precisa existir no banco
            'password'  => Hash::make($senhaTemporaria),
            'role'      => 'gerente',
        ]);

        // Mail::raw("Olá {$gerente->name}, sua conta foi criada. Acesse o sistema e redefina sua senha.", function ($message) use ($gerente) {
        //     $message->to($gerente->email)
        //             ->subject('Criação de conta - Defina sua senha');
        // });

        return redirect()->route('gerentes.index')
                        ->with('success', 'Gerente cadastrado com sucesso! Um e-mail foi enviado para redefinir a senha.');
    }


    /**
     * Exibe formulário de edição (rota: gerentes.edit)
     */
    public function edit(User $gerente)
    {
        return view('Gerencia.edit', compact('gerente'));
    }

    /**
     * Atualiza gerente (rota: gerentes.update)
     */
    public function update(Request $request, User $gerente)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $gerente->id,
        ]);

        $gerente->update($request->only(['name', 'email']));

        return redirect()->route('gerentes.index')
                         ->with('success', 'Gerente atualizado com sucesso!');
    }

    /**
     * Exclui gerente (rota: gerentes.destroy)
     */
    public function destroy(User $gerente)
    {
        $gerente->delete();

        return redirect()->route('gerentes.index')
                         ->with('success', 'Gerente excluído com sucesso!');
    }
}
