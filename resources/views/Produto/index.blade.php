@extends('layouts.app')

@section('title', 'Produtos - Listagem')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-primary mb-4">Lista de Produtos</h3>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Botão para gerar relatório --}}
    <div class="mb-3 text-end">
        <a href="{{ route('relatorio.produtos') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-box-seam"></i> Gerar Relatório
        </a>
    </div>

    {{-- Botão para cadastrar novo produto --}}
    <div class="mb-3 text-end">
        <a href="{{ route('produto.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-box-seam"></i> Novo Produto
        </a>
    </div>

    {{-- Tabela de produtos --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Fornecedor</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->categoria }}</td>
                            <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                            <td>{{ $produto->quantidade }}</td>
                            <td>{{ $produto->fornecedor->nome ?? '—' }}</td>

                            <td class="text-end">
                                <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>

                                <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Deseja realmente excluir este produto?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                Nenhum produto cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
