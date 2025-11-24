@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-primary mb-4">Editar Produto</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('produto.update', $produto) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nome --}}
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Produto</label>
                          <input type="text" name="nome" id="nome" class="form-control"
                              value="{{ old('nome', $produto->nome) }}" required>
                    @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Descrição --}}
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="3" class="form-control" required>{{ old('descricao', $produto->descricao) }}</textarea>
                    @error('descricao') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Preço --}}
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço (R$)</label>
                          <input type="number" step="0.01" name="preco" id="preco" class="form-control"
                              value="{{ old('preco', $produto->preco) }}" required>
                    @error('preco') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Quantidade --}}
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                          <input type="number" name="quantidade" id="quantidade" class="form-control"
                              value="{{ old('quantidade', $produto->quantidade) }}" required>
                    @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Categoria --}}
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                          <input type="text" name="categoria" id="categoria" class="form-control"
                              value="{{ old('categoria', $produto->categoria) }}" required>
                    @error('categoria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Fornecedor --}}
                <div class="mb-3">
                    <label for="fornecedor_id" class="form-label">Fornecedor</label>
                    <select name="fornecedor_id" id="fornecedor_id" class="form-control" required>
                        <option value="">Selecione um fornecedor</option>
                        @foreach($fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}"
                                {{ old('fornecedor_id', $produto->fornecedor_id) == $fornecedor->id ? 'selected' : '' }}>
                                {{ $fornecedor->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('fornecedor_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Botões --}}
                <div class="text-end">
                    <a href="{{ route('produto.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
