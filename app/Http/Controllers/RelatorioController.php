<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function gerarRelatorio()
    {
        // Carrega os produtos com fornecedor
        $produtos = Produto::with('fornecedor')->get();

        // Gera o PDF
        $pdf = Pdf::loadView('relatorios.produtos', compact('produtos'))
                  ->setPaper('a4', 'portrait');

        // Força o download
        return $pdf->download('relatorio_produtos.pdf');
    }
}
