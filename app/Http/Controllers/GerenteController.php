<?php

namespace App\Http\Controllers;

use App\Models\Gerente;
use Illuminate\Http\Request;

class GerenteController extends Controller
{
    /**
     * Exibe o dashboard do gerente.
     */
    public function index()
    {
        // Aqui você pode futuramente adicionar estatísticas ou dados do dashboard
        return view('Gerencia.dashboard');
    }

    /**
     * Lista todos os gerentes registrados.
     */
    public function list()
    {
        $gerentes = Gerente::all();
        return view('Gerencia.index', compact('gerentes'));
    }

    /**
     * Exibe o formulário de cadastro de gerente.
     */
    public function create()
    {
        return view('Gerencia.create');
    }

    /**
     * Salva um novo gerente no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:gerentes,email',
            'telefone' => 'nullable|string|max:20',
        ]);

        Gerente::create($request->all());

        return redirect()->route('gerentes.list')
                         ->with('success', 'Gerente cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário de edição de um gerente.
     */
    public function edit(Gerente $gerente)
    {
        return view('Gerencia.edit', compact('gerente'));
    }

    /**
     * Atualiza os dados de um gerente.
     */
    public function update(Request $request, Gerente $gerente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:gerentes,email,' . $gerente->id,
            'telefone' => 'nullable|string|max:20',
        ]);

        $gerente->update($request->all());

        return redirect()->route('gerentes.list')
                         ->with('success', 'Gerente atualizado com sucesso!');
    }

    /**
     * Exclui um gerente.
     */
    public function destroy(Gerente $gerente)
    {
        $gerente->delete();

        return redirect()->route('gerentes.list')
                         ->with('success', 'Gerente excluído com sucesso!');
    }
}
