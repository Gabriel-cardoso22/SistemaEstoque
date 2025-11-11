<?php



namespace App\Http\Controllers;


use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with(['fornecedor', 'user'])->paginate(10);
        return view('produto.index', compact('produtos'));
    }

    public function create()
    {
        Log::info("Produto criado por");
        $fornecedores = Fornecedor::all();
        return view('produto.create', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria' => 'required',
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ]);

        $produto = new Produto($request->all());
        $produto->user_id = Auth::id();
        $produto->save();

        return redirect()->route('produto.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function show(Produto $produtos)
    {
        return view('produto.show', compact('produtos'));
    }

    public function edit(Produto $produtos)
    {
        Log::info("Produto editado por ");
        $fornecedores = Fornecedor::all();
        return view('produto.edit', compact('produtos', 'fornecedores'));
    }

    public function update(Request $request, Produto $produtos)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria' => 'required',
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ]);

        $produtos->update($request->all());

        return redirect()->route('produto.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produtos)
    {
        Log::info("Produto deletado por");
        $produtos->delete();

        return redirect()->route('produto.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}
