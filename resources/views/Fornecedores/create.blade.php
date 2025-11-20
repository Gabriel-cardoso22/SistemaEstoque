@extends('layouts.app')

@section('title', 'Novo Fornecedor')

@section('content')
<h4 class="mb-4">Cadastrar Fornecedor</h4>

<form action="{{ route('fornecedores.store') }}" 
      method="POST" 
      class="card p-4 shadow-sm" 
      style="max-width: 600px;">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">CNPJ</label>
        <input type="text" name="cnpj" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Endereço</label>
        <textarea name="endereco" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
