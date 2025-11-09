@extends('layouts.app')

@section('title', 'Cadastrar Funcionário')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cadastrar Novo Funcionário</h1>
        <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Voltar
        </a>
    </div>

    {{-- Mensagens de Erro Globais --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6><i class="fas fa-exclamation-circle me-2"></i>Corrija os erros abaixo:</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card do Formulário --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-plus me-2"></i>Informações do Funcionário
                    </h6>
                </div>
                <div class="card-body">
                    <form id="funcionarioForm" action="{{ route('funcionarios.store') }}" method="POST" novalidate>
                        @csrf
                        
                        <div class="row">
                            {{-- Nome Completo --}}
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Nome Completo *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Digite o nome completo do funcionário"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Informe o nome completo do funcionário</div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">E-mail *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="funcionario@empresa.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    E-mail que será usado para login no sistema
                                </div>
                            </div>

                            {{-- Senha --}}
                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label">Senha *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Digite uma senha para o funcionário"
                                           required
                                           minlength="6">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Mínimo de 6 caracteres</div>
                            </div>

                            {{-- Confirmar Senha --}}
                            <div class="col-md-12 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Senha *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Digite novamente a senha"
                                           required
                                           minlength="6">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">Confirme a senha digitada acima</div>
                            </div>

                            {{-- Telefone (opcional) --}}
                            <div class="col-md-12 mb-4">
                                <label for="telefone" class="form-label">Telefone</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" 
                                           class="form-control @error('telefone') is-invalid @enderror" 
                                           id="telefone" 
                                           name="telefone" 
                                           value="{{ old('telefone') }}" 
                                           placeholder="(00) 00000-0000">
                                    @error('telefone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Campo opcional</div>
                            </div>
                        </div>

                        {{-- Informações Importantes --}}
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Informações Importantes:</h6>
                            <ul class="mb-0">
                                <li>A senha será definida agora e deve ser informada ao funcionário</li>
                                <li>Use uma senha segura com pelo menos 6 caracteres</li>
                                <li>O funcionário poderá alterar a senha após fazer login</li>
                                <li>O perfil será configurado automaticamente como "Funcionário"</li>
                            </ul>
                        </div>

                        {{-- Botões --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Cadastrar Funcionário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('funcionarioForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const telefoneInput = document.getElementById('telefone');

    // Validação em tempo real do nome
    nameInput.addEventListener('input', function() {
        const value = this.value.trim();
        if (value.length < 3) {
            this.classList.add('is-invalid');
            showFieldError(this, 'Nome deve ter pelo menos 3 caracteres');
        } else {
            this.classList.remove('is-invalid');
            hideFieldError(this);
        }
    });

    // Validação em tempo real do email
    emailInput.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(this.value)) {
            this.classList.add('is-invalid');
            showFieldError(this, 'Digite um e-mail válido');
        } else {
            this.classList.remove('is-invalid');
            hideFieldError(this);
        }
    });

    // Validação em tempo real da senha
    passwordInput.addEventListener('input', function() {
        if (this.value.length < 6) {
            this.classList.add('is-invalid');
            showFieldError(this, 'Senha deve ter pelo menos 6 caracteres');
        } else {
            this.classList.remove('is-invalid');
            hideFieldError(this);
        }
        
        // Validar confirmação se já foi digitada
        if (passwordConfirmInput.value) {
            validatePasswordConfirmation();
        }
    });

    // Validação da confirmação de senha
    passwordConfirmInput.addEventListener('input', validatePasswordConfirmation);

    function validatePasswordConfirmation() {
        if (passwordConfirmInput.value !== passwordInput.value) {
            passwordConfirmInput.classList.add('is-invalid');
            showFieldError(passwordConfirmInput, 'As senhas não coincidem');
        } else {
            passwordConfirmInput.classList.remove('is-invalid');
            hideFieldError(passwordConfirmInput);
        }
    }

    // Toggle senha visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
        const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Máscara para telefone
    telefoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove tudo que não é número
        
        if (value.length <= 11) {
            if (value.length <= 10) {
                // Formato: (00) 0000-0000
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
            } else {
                // Formato: (00) 00000-0000
                value = value.replace(/^(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
            }
        }
        
        this.value = value;
    });

    // Validação do formulário antes do envio
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validar nome
        if (nameInput.value.trim().length < 3) {
            nameInput.classList.add('is-invalid');
            showFieldError(nameInput, 'Nome deve ter pelo menos 3 caracteres');
            isValid = false;
        }
        
        // Validar email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            emailInput.classList.add('is-invalid');
            showFieldError(emailInput, 'Digite um e-mail válido');
            isValid = false;
        }
        
        // Validar senha
        if (passwordInput.value.length < 6) {
            passwordInput.classList.add('is-invalid');
            showFieldError(passwordInput, 'Senha deve ter pelo menos 6 caracteres');
            isValid = false;
        }
        
        // Validar confirmação de senha
        if (passwordConfirmInput.value !== passwordInput.value) {
            passwordConfirmInput.classList.add('is-invalid');
            showFieldError(passwordConfirmInput, 'As senhas não coincidem');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            // Scroll para o primeiro erro
            const firstError = document.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        } else {
            // Mostrar loading no botão
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Cadastrando...';
            submitBtn.disabled = true;
        }
    });

    function showFieldError(field, message) {
        hideFieldError(field);
        const feedback = document.createElement('div');
        feedback.className = 'invalid-feedback';
        feedback.textContent = message;
        field.parentNode.appendChild(feedback);
    }

    function hideFieldError(field) {
        const existingFeedback = field.parentNode.querySelector('.invalid-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }
    }

    // Auto-dismiss alerts
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
.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.input-group-text {
    background-color: #f8f9fc;
    border-right: none;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.input-group .form-control {
    border-left: none;
}

.input-group .form-control:focus {
    border-left: none;
}

.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}

.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2653d4;
}

.alert-info {
    border-left: 4px solid #36b9cc;
}

.form-text {
    font-size: 0.875rem;
}
</style>
@endpush