@extends('layouts.app')

@section('title', 'Novo Gerente')

@section('content')
<h4 class="mb-4">Cadastrar Novo Gerente</h4>

<form action="{{ route('gerentes.store') }}" method="POST" class="card p-4 shadow-sm" style="max-width: 500px;">
    @csrf

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" name="telefone" id="telefone" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('gerentes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
