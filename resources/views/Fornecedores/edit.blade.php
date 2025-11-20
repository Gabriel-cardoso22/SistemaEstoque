@extends('layouts.app')

@section('title', 'Editar Fornecedor')

@section('content')
<h4 class="mb-4">Editar Fornecedor</h4>

<form action="{{ route('fornecedores.update', $fornecedor->id) }}" 
      method="POST" 
      class="card p-4 shadow-sm" 
      style="max-width: 600px;">
    @csrf
    @method('PUT')

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
        <input type="text" name="nome" class="form-control" value="{{ $fornecedor->nome }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">CNPJ</label>
        <input type="text" name="cnpj" class="form-control" value="{{ $fornecedor->cnpj }}">
    </div>

    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" value="{{ $fornecedor->email }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="{{ $fornecedor->telefone }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Endereço</label>
        <textarea name="endereco" class="form-control">{{ $fornecedor->endereco }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
