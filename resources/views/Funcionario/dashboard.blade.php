@extends('layouts.app')

@section('title', 'Dashboard - Funcionário')

@section('content')
<div class="container py-4">
    {{-- Mensagem de boas-vindas --}}
    <div class="text-center mb-4">
        <h3 class="fw-bold">Bem-vindo{{ auth()->user() ? ', ' . auth()->user()->name : '' }}!</h3>
        <p class="text-muted fs-5 mb-1">ao</p>
        <h4 class="text-primary fw-bold">Sistema de Gestão de Estoque</h4>
        <p class="text-muted">Painel do Funcionário</p>
    </div>

    {{-- Estatísticas Rápidas --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small">Total de Produtos</div>
                            <div class="h5 mb-0">
                                @php
                                    $totalProdutos = App\Models\Produto::count();
                                @endphp
                                {{ $totalProdutos }}
                            </div>
                        </div>
                        <div class="fs-2">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small">Produtos em Estoque</div>
                            <div class="h5 mb-0">
                                @php
                                    $produtosEstoque = App\Models\Produto::where('quantidade', '>', 0)->count();
                                @endphp
                                {{ $produtosEstoque }}
                            </div>
                        </div>
                        <div class="fs-2">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small">Produtos Baixo Estoque</div>
                            <div class="h5 mb-0">
                                @php
                                    $produtosBaixoEstoque = App\Models\Produto::where('quantidade', '<=', 10)->where('quantidade', '>', 0)->count();
                                @endphp
                                {{ $produtosBaixoEstoque }}
                            </div>
                        </div>
                        <div class="fs-2">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu de Ações --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-boxes fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title text-primary">Gerenciar Produtos</h5>
                    <p class="card-text text-muted">Visualize, cadastre, edite e atualize informações dos produtos no estoque.</p>
                    <a href="{{ route('produtos.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-2"></i>Acessar Produtos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-chart-line fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title text-success">Relatórios</h5>
                    <p class="card-text text-muted">Visualize relatórios de movimentação, estoque e outras métricas importantes.</p>
                    <button class="btn btn-outline-success" disabled>
                        <i class="fas fa-chart-bar me-2"></i>Em Breve
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Produtos com Baixo Estoque --}}
    @php
        $produtosAlerta = App\Models\Produto::where('quantidade', '<=', 10)->where('quantidade', '>', 0)->orderBy('quantidade')->limit(5)->get();
    @endphp
    
    @if($produtosAlerta->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Produtos com Baixo Estoque
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Status</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtosAlerta as $produto)
                                <tr>
                                    <td>
                                        <strong>{{ $produto->nome }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge {{ $produto->quantidade <= 5 ? 'bg-danger' : 'bg-warning' }}">
                                            {{ $produto->quantidade }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($produto->quantidade <= 5)
                                            <span class="text-danger">
                                                <i class="fas fa-exclamation-circle me-1"></i>Crítico
                                            </span>
                                        @else
                                            <span class="text-warning">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Baixo
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Atualizar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('produtos.index') }}" class="btn btn-outline-warning">
                            <i class="fas fa-list me-2"></i>Ver Todos os Produtos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.bg-primary {
    background: linear-gradient(45deg, #4e73df, #6f42c1) !important;
}

.bg-success {
    background: linear-gradient(45deg, #1cc88a, #36b9cc) !important;
}

.bg-warning {
    background: linear-gradient(45deg, #f6c23e, #fd7e14) !important;
}

.fs-2 {
    opacity: 0.8;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #5a5c69;
}

.badge {
    font-size: 0.8rem;
}
</style>
@endpush