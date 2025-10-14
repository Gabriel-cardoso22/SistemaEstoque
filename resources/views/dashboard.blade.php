<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Estoque</title>
    <link rel="stylesheet" href="{{ asset('CSS/dashboard.css') }}">
    <script defer src="{{ asset('JS/dashboard.js') }}"></script>
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
        <div class="card">
            <h3>Produtos</h3>
            <p>Gerencie os produtos do estoque.</p>
            <button id="abrirModal">Cadastrar Produto</button>
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

    <!-- Modal de Cadastro de Produto -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Cadastrar Produto</h2>
            <form id="formProduto" method="POST" action="{{ route('produtos.store') }}">
                @csrf
                <label for="nome">Nome do Produto*</label>
                <input type="text" id="nome" name="nome" required>

                <label for="categoria">Categoria*</label>
                <input type="text" id="categoria" name="categoria" required>

                <label for="preco">Preço (R$)*</label>
                <input type="number" id="preco" name="preco" step="0.01" required>

                <label for="quantidade">Quantidade*</label>
                <input type="number" id="quantidade" name="quantidade" required>

                <button type="submit" class="btn-salvar">Salvar</button>
                <p id="mensagemErro"></p> <!-- feedback de sucesso ou erro -->
            </form>
        </div>
    </div>
</body>
</html>
