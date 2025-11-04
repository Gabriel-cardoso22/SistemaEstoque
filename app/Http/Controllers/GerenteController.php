<?php

namespace App\Http\Controllers;

use App\Models\Gerente;
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
            'email' => 'required|email|unique:gerentes,email',
            'telefone' => 'nullable|string|max:20',
        ]);

        $senhaTemporaria = Str::random(10);

        return redirect()->route('gerentes.list')
                         ->with('success', 'Gerente cadastrado com sucesso!');
    }


    /**
     * Exibe formulário de edição (rota: gerentes.edit)
     */
    public function edit(Gerente $gerente)
    {
        return view('Gerencia.edit', compact('gerente'));
    }

    /**
     * Atualiza gerente (rota: gerentes.update)
     */
    public function update(Request $request, Gerente $gerente)
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
    public function destroy(Gerente $gerente)
    {
        $gerente->delete();

        return redirect()->route('gerentes.index')
                         ->with('success', 'Gerente excluído com sucesso!');
    }
}
