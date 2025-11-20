@extends('layouts.app')

@section('title', 'Fornecedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-2">
        {{-- 🔙 Botão de Voltar para Dashboard --}}
        <a href="{{ route('dashboard.gerente') }}" class="btn btn-outline-secondary">
            ← Voltar para Dashboard
        </a>
        <h4 class="mb-0">Fornecedores</h4>
    </div>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">+ Novo Fornecedor</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<table class="table table-striped table-bordered align-middle">
    <thead class="table-primary text-center">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Produtos Vinculados</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($fornecedores as $fornecedor)
            <tr>
                <td class="text-center">{{ $fornecedor->id }}</td>
                <td>{{ $fornecedor->nome }}</td>
                <td>{{ $fornecedor->cnpj ?? '-' }}</td>
                <td>{{ $fornecedor->email ?? '-' }}</td>
                <td>{{ $fornecedor->telefone ?? '-' }}</td>
                <td class="text-center">
                    <span class="badge bg-info text-dark">
                        {{ $fornecedor->produtos_count }}
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-sm btn-warning">Editar</a>

                    <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" 
                          method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Deseja realmente excluir este fornecedor?')" 
                                class="btn btn-sm btn-danger">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Nenhum fornecedor encontrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $fornecedores->links() }}
</div>

@endsection
