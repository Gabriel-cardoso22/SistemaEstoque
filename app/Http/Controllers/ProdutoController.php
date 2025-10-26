<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    // Lista produtos (GET /api/produtos)
    public function index()
    {
        try {
            // Ajuste: carregue relacionamentos se precisar (user, fornecedor)
            $produtos = Produto::orderBy('id','desc')->get();
            return response()->json($produtos, 200);
        } catch (Exception $e) {
            Log::error('Erro ao listar produtos: '.$e->getMessage());
            return response()->json(['message' => 'Erro interno ao listar produtos'], 500);
        }
    }

    // Cadastra produto (POST /api/produtos)
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        try {
            // Se tiver user autenticado, associe user_id. Exemplo:
            if ($request->user()) {
                $request->merge(['user_id' => $request->user()->id]);
            }

            // Use transaction para segurança
            DB::beginTransaction();
            $produto = Produto::create($request->only([
                'nome','descricao','categoria','preco','quantidade','user_id','fornecedor_id'
            ]));
            DB::commit();

            return response()->json($produto, 201);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao cadastrar produto: '.$e->getMessage());
            return response()->json(['message' => 'Erro interno ao cadastrar produto'], 500);
        }
    }
}
