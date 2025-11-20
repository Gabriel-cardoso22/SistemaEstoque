<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FornecedorController extends Controller
{
    /**
     * Lista fornecedores com contagem de produtos (rota: fornecedores.index)
     */
    public function index()
    {
        $fornecedores = Fornecedor::withCount('produtos')->paginate(10);
        return view('Fornecedores.index', compact('fornecedores'));
    }

    /**
     * Exibe formulário de criação (rota: fornecedores.create)
     */
    public function create()
    {
        return view('Fornecedores.create');
    }

    /**
     * Salva um novo fornecedor (rota: fornecedores.store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'nullable|string|max:32|unique:fornecedores,cnpj',
            'email'    => 'nullable|email|unique:fornecedores,email',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
        ]);

        $fornecedor = Fornecedor::create($request->only([
            'nome', 'cnpj', 'email', 'telefone', 'endereco'
        ]));

        Log::info("Fornecedor criado: {$fornecedor->nome} ({$fornecedor->email})");

        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Exibe formulário de edição (rota: fornecedores.edit)
     */
    public function edit(Fornecedor $fornecedor)
    {
        return view('Fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Atualiza fornecedor (rota: fornecedores.update)
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'nullable|string|max:32|unique:fornecedores,cnpj,' . $fornecedor->id,
            'email'    => 'nullable|email|unique:fornecedores,email,' . $fornecedor->id,
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
        ]);

        $fornecedor->update($request->only([
            'nome', 'cnpj', 'email', 'telefone', 'endereco'
        ]));

        Log::info("Fornecedor atualizado: {$fornecedor->nome} ({$fornecedor->email})");

        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove fornecedor (rota: fornecedores.destroy)
     */
    public function destroy(Fornecedor $fornecedor)
    {
        // Regra de segurança: impedir remoção se houver produtos vinculados
        if ($fornecedor->produtos()->exists()) {
            return redirect()->route('fornecedores.index')
                             ->withErrors(['error' => 'Não é possível excluir: existem produtos ligados a este fornecedor.']);
        }

        $fornecedor->delete();

        Log::info("Fornecedor excluído: {$fornecedor->nome} ({$fornecedor->email})");

        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor excluído com sucesso!');
    }
}
