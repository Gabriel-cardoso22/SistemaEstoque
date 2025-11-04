<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FuncionarioController extends Controller
{
    /**
     * Dashboard do funcionário (rota: dashboard.funcionario)
     */
    public function index()
    {
        return view('Funcionario.dashboard');
    }

    /**
     * Listagem (rota: funcionarios.index)
     */
    public function list()
    {
        $funcionarios = User::where('role', 'funcionario')->get();
        return view('Funcionario.index', compact('funcionarios'));
    }

    /**
     * Exibe o formulário de criação (rota: funcionarios.create)
     */
    public function create()
    {
        return view('Funcionario.create');
    }

    /**
     * Armazena um novo funcionário (rota: funcionarios.store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Gera uma senha aleatória e salva o hash
        $senhaTemporaria = Str::random(10);

        $funcionario = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($senhaTemporaria),
            'role'     => 'funcionario',
        ]);

        // Envia o e-mail com instrução para redefinir senha
        Mail::raw("Olá {$funcionario->name}, sua conta foi criada. Acesse o sistema e redefina sua senha.", function ($message) use ($funcionario) {
            $message->to($funcionario->email)
                    ->subject('Criação de conta - Defina sua senha');
        });

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário cadastrado com sucesso! Um e-mail foi enviado para redefinir a senha.');
    }

    /**
     * Exibe o formulário de edição (rota: funcionarios.edit)
     */
    public function edit(User $funcionario)
    {
        return view('Funcionario.edit', compact('funcionario'));
    }

    /**
     * Atualiza um funcionário (rota: funcionarios.update)
     */
    public function update(Request $request, User $funcionario)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $funcionario->id,
        ]);

        $funcionario->update($request->only(['name', 'email']));

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário atualizado com sucesso!');
    }

    /**
     * Remove um funcionário (rota: funcionarios.destroy)
     */
    public function destroy(User $funcionario)
    {
        $funcionario->delete();

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário excluído com sucesso!');
    }
}
