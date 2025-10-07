<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Estoque</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Login do Sistema</h2>

        <form action="{{ route('login.autenticar') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="usuario" required>
            </div>

            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>

            <button type="submit">Entrar</button>
        </form>

        @if(session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif
    </div>
</body>
</html>
