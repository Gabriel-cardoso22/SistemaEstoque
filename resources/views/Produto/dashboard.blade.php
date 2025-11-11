@extends('layouts.app')

@section('title', 'Dashboard - Produto')

@section('content')
<div class="container py-4">

    {{-- Mensagem de boas-vindas --}}
    <div class="text-center mb-4">
        <h3 class="fw-bold">Bem-vindo{{ isset($produto) ? ', ' . $produto->nome : '' }}!</h3>
        <p class="text-muted fs-5 mb-1">ao</p>
        <h4 class="text-primary fw-bold">Sistema de Gestão de Estoque</h4>
    </div>

    {{-- Barra de navegação secundária --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-primary" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acessar Seções
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('produto.index') }}">Consultar Produtos</a></li>
                            <li><a class="dropdown-item" href="{{ route('funcionarios.index') }}">Listar Funcionários</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Cards de acesso rápido --}}
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Consultar Produtos</h5>
                    <p class="card-text text-muted">
                        Visualize os produtos cadastrados e suas informações detalhadas.
                    </p>
                    <a href="{{ route('produto.index') }}" class="btn btn-outline-primary btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Listar Funcionários</h5>
                    <p class="card-text text-muted">
                        Consulte a lista de funcionários ativos no sistema.
                    </p>
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-primary btn-sm">Acessar</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
