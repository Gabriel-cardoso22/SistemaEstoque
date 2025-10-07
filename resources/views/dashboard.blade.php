<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Estoque</title>
    <link rel="stylesheet" href="{{ asset('CSS/dashboard.css') }}">
</head>
<body>
    <header>
        <h1>Dashboard - Sistema de Estoque</h1>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button class="logout">Sair</button>
        </form>
    </header>

    <div class="dashboard">
        <div class="card">
            <h3>Produtos</h3>
            <p>Gerencie os produtos do estoque.</p>
        </div>
        <div class="card">
            <h3>Usuários</h3>
            <p>Controle os usuários do sistema.</p>
        </div>
        <div class="card">
            <h3>Relatórios</h3>
            <p>Visualize relatórios básicos.</p>
        </div>
    </div>
</body>
</html>