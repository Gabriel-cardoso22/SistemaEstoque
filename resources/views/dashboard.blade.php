<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Estoque</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }
        section {
            color:black;
            padding: 15px;
            text-align: center;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            text-align: center;
        }
        .card h3 {
            margin-bottom: 10px;
        }
        .logout {
            position: absolute;
            top: 15px;
            right: 20px;
            background: red;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .logout:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    @extends ('layouts.appII')

    @section('content')
    <section>
        <h2>Dashboard - Sistema de Estoque</h2>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button class="logout">Sair</button>
        </form>
    </section>

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
    @endsection
</body>
</html>