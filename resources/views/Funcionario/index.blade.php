@extends('layouts.app')

@section('title', 'Funcionários - Listagem')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-primary mb-4">Lista de Funcionários</h3>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Botão para cadastrar novo funcionário --}}
    <div class="mb-3 text-end">
        <a href="{{ route('funcionarios.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus"></i> Novo Funcionário
        </a>
    </div>

    {{-- Tabela de funcionários --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($funcionarios as $funcionario)
                        <tr>
                            <td>{{ $funcionario->name }}</td>
                            <td>{{ $funcionario->email }}</td>
                            <td>{{ $funcionario->telefone ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja realmente excluir este funcionário?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Nenhum funcionário cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
