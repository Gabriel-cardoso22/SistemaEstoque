@extends('layouts.app')

@section('title', 'Editar Gerente')

@section('content')
<h4 class="mb-4">Editar Gerente</h4>

<form action="{{ route('gerentes.update', $gerente->id) }}" method="POST" class="card p-4 shadow-sm" style="max-width: 500px;">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ $gerente->nome }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $gerente->email }}" required>
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $gerente->telefone }}">
    </div>

    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('gerentes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
