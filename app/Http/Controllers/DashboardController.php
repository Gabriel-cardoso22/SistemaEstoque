<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Aqui você pode pegar o nome do gerente autenticado
        // Se estiver usando autenticação Laravel padrão:
        $gerente = auth()->user();

        return view('dashboard.index', compact('gerente'));
    }
}
