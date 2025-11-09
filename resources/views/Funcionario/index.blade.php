@extends('layouts.app')

@section('title', 'Gestão de Funcionários')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestão de Funcionários</h1>
        <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Funcionário
        </a>
    </div>

    {{-- Mensagens de Feedback --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card da Tabela --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-users me-2"></i>Lista de Funcionários
                <span class="badge bg-secondary ms-2">{{ $funcionarios->count() }} funcionário(s)</span>
            </h6>
        </div>
        <div class="card-body">
            @if($funcionarios->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Data de Cadastro</th>
                                <th scope="col" class="text-center" style="min-width: 180px;">
                                    <i class="fas fa-cogs me-1"></i>Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($funcionarios as $index => $funcionario)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                {{ strtoupper(substr($funcionario->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <strong>{{ $funcionario->name }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <i class="fas fa-envelope text-muted me-1"></i>
                                    {{ $funcionario->email }}
                                </td>
                                <td>
                                    <i class="fas fa-calendar text-muted me-1"></i>
                                    {{ $funcionario->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('funcionarios.edit', $funcionario) }}" 
                                           class="btn btn-sm btn-primary d-flex align-items-center" 
                                           title="Editar funcionário">
                                            <i class="fas fa-edit me-1"></i>
                                            <span>Editar</span>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-danger d-flex align-items-center" 
                                                title="Excluir funcionário"
                                                onclick="confirmDelete({{ $funcionario->id }}, '{{ $funcionario->name }}')">
                                            <i class="fas fa-trash me-1"></i>
                                            <span>Excluir</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Nenhum funcionário cadastrado</h4>
                    <p class="text-muted">Clique no botão "Novo Funcionário" para adicionar o primeiro funcionário.</p>
                    <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Cadastrar Primeiro Funcionário
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal de Confirmação de Exclusão --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o funcionário <strong id="funcionarioName"></strong>?</p>
                <p class="text-muted small">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(funcionarioId, funcionarioName) {
    document.getElementById('funcionarioName').textContent = funcionarioName;
    document.getElementById('deleteForm').action = `/funcionario/${funcionarioId}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endpush

@push('styles')
<style>
.table th {
    border-top: none;
    font-weight: 600;
    color: #5a5c69;
}

.avatar {
    font-size: 14px;
    font-weight: 600;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.badge {
    font-size: 0.7rem;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    min-width: 80px;
}

.btn-sm span {
    font-weight: 500;
}

.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}

.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2653d4;
    transform: translateY(-1px);
}

.btn-danger {
    background-color: #e74a3b;
    border-color: #e74a3b;
}

.btn-danger:hover {
    background-color: #c0392b;
    border-color: #a93226;
    transform: translateY(-1px);
}

.btn {
    transition: all 0.2s ease-in-out;
}

.gap-2 {
    gap: 0.5rem !important;
}
</style>
@endpush