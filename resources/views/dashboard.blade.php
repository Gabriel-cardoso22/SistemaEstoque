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
        header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            text-align: center;
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.02);
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
        .produtos-container {
            margin: 20px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 18px;
            }
            .card p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Dashboard - Sistema de Estoque</h1>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button class="logout">Sair</button>
        </form>
    </header>

    <!-- Dashboard Cards -->
    <div class="dashboard">
        <div class="card" data-section="produtos">
            <h3>Produtos</h3>
            <p>Gerencie os produtos do estoque.</p>
            <button id="abrirModal">Cadastrar Produto</button>
        </div>
        <div class="card" data-section="usuarios">
            <h3>Usuários</h3>
            <p>Controle os usuários do sistema.</p>
        </div>
        <div class="card" data-section="relatorios">
            <h3>Relatórios</h3>
            <p>Visualize relatórios básicos.</p>
        </div>
    </div>

    <div class="produtos-container">
        @include('components.tabelaProdutos')
    </div>
</body>
</html>
