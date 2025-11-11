@extends('layouts.app')

@section('title', 'Editar Funcionário')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-primary mb-4">Editar Funcionário</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $funcionario->nome) }}" required>
                    @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $funcionario->email) }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone', $funcionario->telefone) }}">
                    @error('telefone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
