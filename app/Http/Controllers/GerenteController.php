<?php

namespace App\Http\Controllers;

use App\Models\Gerente;
use Illuminate\Http\Request;

class GerenteController extends Controller
{
    public function index()
    {
        $gerentes = Gerente::all();
        return view('gerentes.index', compact('gerentes'));
    }

    public function create()
    {
        return view('gerentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:gerentes,email',
            'telefone' => 'nullable|string|max:20',
        ]);

        Gerente::create($request->all());

        return redirect()->route('gerentes.index')
                         ->with('success', 'Gerente cadastrado com sucesso!');
    }

    public function edit(Gerente $gerente)
    {
        return view('gerentes.edit', compact('gerente'));
    }

    public function update(Request $request, Gerente $gerente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:gerentes,email,' . $gerente->id,
            'telefone' => 'nullable|string|max:20',
        ]);

        $gerente->update($request->all());

        return redirect()->route('gerentes.index')
                         ->with('success', 'Gerente atualizado com sucesso!');
    }

    public function destroy(Gerente $gerente)
    {
        $gerente->delete();
        return redirect()->route('gerentes.index')
                         ->with('success', 'Gerente excluído com sucesso!');
    }
}
