@extends('layouts.app')

@section('title', 'Gerentes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-2">
        {{-- 🔙 Botão de Voltar para Dashboard --}}
        <a href="{{ route('dashboard.gerente') }}" class="btn btn-outline-secondary">
            ← Voltar para Dashboard
        </a>
        <h4 class="mb-0">Gerentes</h4>
    </div>

    {{-- ➕ Botão de Novo Gerente --}}
    <a href="{{ route('gerentes.create') }}" class="btn btn-primary">+ Novo Gerente</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered align-middle">
    <thead class="table-primary text-center">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($gerentes as $gerente)
            <tr>
                <td class="text-center">{{ $gerente->id }}</td>
                <td>{{ $gerente->nome }}</td>
                <td>{{ $gerente->email }}</td>
                <td>{{ $gerente->telefone ?? '-' }}</td>
                <td class="text-center">
                    <a href="{{ route('gerentes.edit', $gerente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('gerentes.destroy', $gerente->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir?')">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">Nenhum gerente encontrado.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
