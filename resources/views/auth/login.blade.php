@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 140px);">
    <div class="card shadow-sm p-4" style="max-width: 360px; width: 100%;">
        <h4 class="text-center mb-4">Entrar</h4>

        <form id="loginForm">
            @csrf

            <div class="form-floating mb-3">
                <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="E-mail" required>
                <label for="email">E-mail</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Senha" required>
                <label for="password">Senha</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
        </form>

        <div id="message" class="mt-3" style="display: none;"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const token = document.querySelector('input[name="_token"]').value;

    const messageDiv = document.getElementById('message');
    messageDiv.style.display = 'none';

    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            messageDiv.className = 'alert alert-success';
            messageDiv.textContent = data.message;
            messageDiv.style.display = 'block';
            setTimeout(() => window.location.href = data.redirect, 1000);
        } else {
            messageDiv.className = 'alert alert-danger';
            messageDiv.textContent = data.message || 'Erro no login';
            messageDiv.style.display = 'block';
        }
    } catch (error) {
        messageDiv.className = 'alert alert-danger';
        messageDiv.textContent = 'Erro de conexão. Tente novamente.';
        messageDiv.style.display = 'block';
    }
});
</script>
@endpush
