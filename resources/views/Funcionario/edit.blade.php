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
                    <label for="name" class="form-label">Nome Completo</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $funcionario->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
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

                <hr>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="change_password" name="change_password" onclick="document.getElementById('password_fields').classList.toggle('d-none', !this.checked);">
                    <label class="form-check-label" for="change_password">
                        Alterar senha do funcionário
                    </label>
                </div>

                <div id="password_fields" class="d-none">
                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
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
