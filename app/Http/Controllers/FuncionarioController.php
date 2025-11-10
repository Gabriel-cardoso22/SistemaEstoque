<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


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
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'telefone' => 'nullable|string|max:20',
        ]);

        $funcionario = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'telefone' => $request->telefone,
            'password' => Hash::make($request->password),
            'role'     => 'funcionario',
        ]);

        Log::info("Usuário funcionário de nome: " . $request->name . " e email: " . $request->email);

        /** Envia o e-mail com instrução para redefinir senha (legado)
        * Mail::raw("Olá {$funcionario->name}, sua conta foi criada. Acesse o sistema e redefina sua senha.", function ($message) use ($funcionario) {
        *    $message->to($funcionario->email)
        *            ->subject('Criação de conta - Defina sua senha');
        *});

        *return redirect()->route('funcionarios.index')
        *                 ->with('success', 'Funcionário cadastrado com sucesso! Um e-mail foi enviado para redefinir a senha.');
        */

        return redirect()->route('funcionarios.index')
                         ->with('success', "Funcionário {$funcionario->name} cadastrado com sucesso!");
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
        // Validações base
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $funcionario->id,
            'telefone' => 'nullable|string|max:20',
        ];

        // Se marcou para alterar senha, adicionar validações de senha
        if ($request->has('change_password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $request->validate($rules);

        // Dados para atualizar
        $dataToUpdate = $request->only(['name', 'email', 'telefone']);

        // Se marcou para alterar senha, incluir a nova senha
        if ($request->has('change_password') && $request->password) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $funcionario->update($dataToUpdate);

        $message = 'Funcionário atualizado com sucesso!';
        if ($request->has('change_password')) {
            $message = 'Funcionário atualizado com sucesso! A senha foi alterada.';
        }

        return redirect()->route('funcionarios.index')
                         ->with('success', $message);
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
