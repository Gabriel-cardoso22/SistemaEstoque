<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Estoque</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .alert {
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    @extends('layouts.app')
    <div class="login-container">
        <h2>Login</h2>
        
        <form id="loginForm">
            @csrf
            <input type="email" id="email" name="email" placeholder="E-mail" required>
            <input type="password" id="password" name="password" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        
        <!-- Area para mensagens -->
        <div id="message" style="display: none;"></div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Coleta dados do formulario
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const token = document.querySelector('input[name="_token"]').value;
            
            // Limpa mensagens anteriores
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
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    // Sucesso
                    messageDiv.className = 'alert alert-success';
                    messageDiv.textContent = data.message;
                    messageDiv.style.display = 'block';
                    
                    // Redireciona apos 1 segundo
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                    
                } else {
                    // Erro
                    messageDiv.className = 'alert alert-error';
                    messageDiv.textContent = data.message || 'Erro no login';
                    messageDiv.style.display = 'block';
                }
                
            } catch (error) {
                // Erro de rede
                messageDiv.className = 'alert alert-error';
                messageDiv.textContent = 'Erro de conexão. Tente novamente.';
                messageDiv.style.display = 'block';
            }
        });
    </script>
</body>
</html>
