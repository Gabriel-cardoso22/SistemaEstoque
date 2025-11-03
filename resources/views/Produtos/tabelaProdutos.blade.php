<div id="tabela-produtos" style="display:none; padding: 20px;">
    <h2 style="margin-bottom: 15px;">Lista de Produtos</h2>

    <table border="1" cellspacing="0" cellpadding="8" width="100%" style="border-collapse: collapse;">
        <thead style="background-color: #007bff; color: white;">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço (R$)</th>
                <th>Quantidade</th>
                <th>Categoria</th>
                <th>ID Usuário</th>
                <th>ID Fornecedor</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="produtos-body">
            <tr><td colspan="11" align="center">Carregando...</td></tr>
        </tbody>
    </table>

    <button id="voltar-dashboard" style="margin-top: 20px; background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer;">
        Voltar à Dashboard
    </button>

    {{-- 🔹 Inclui os três modais --}}
    @include('components.modalCadastrarProduto')
    @include('components.modalEditarProduto')
    @include('components.modalExcluirProduto')
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabela = document.getElementById('tabela-produtos');
    const corpo = document.getElementById('produtos-body');
    const botaoVoltar = document.getElementById('voltar-dashboard');
    const cardProdutos = document.querySelector('.card[data-section="produtos"]');

    const formatarData = (dataStr) => {
        const data = new Date(dataStr);
        return data.toLocaleString('pt-BR', { dateStyle: 'short', timeStyle: 'short' });
    };

    // 🔹 Carrega produtos e atualiza tabela
    function carregarProdutos() {
        fetch('/api/produtos')
            .then(r => r.json())
            .then(dados => {
                corpo.innerHTML = '';

                if (!dados.length) {
                    corpo.innerHTML = '<tr><td colspan="11" align="center">Nenhum produto encontrado</td></tr>';
                    return;
                }

                dados.forEach(p => {
                    corpo.innerHTML += `
                        <tr data-id="${p.id}">
                            <td>${p.id}</td>
                            <td>${p.nome}</td>
                            <td>${p.descricao || '-'}</td>
                            <td>${Number(p.preco).toFixed(2)}</td>
                            <td>${p.quantidade}</td>
                            <td>${p.categoria || '-'}</td>
                            <td>${p.user_id}</td>
                            <td>${p.fornecedor_id}</td>
                            <td>${p.created_at ? formatarData(p.created_at) : '-'}</td>
                            <td>${p.updated_at ? formatarData(p.updated_at) : '-'}</td>
                            <td>
                                <button class="editar" data-id="${p.id}" data-nome="${p.nome}" data-descricao="${p.descricao || ''}" data-preco="${p.preco}" data-quantidade="${p.quantidade}" data-categoria="${p.categoria || ''}">✏️ Editar</button>
                                <button class="excluir" data-id="${p.id}">🗑️ Excluir</button>
                            </td>
                        </tr>
                    `;
                });

                // 🔹 Adiciona eventos para os botões
                document.querySelectorAll('.editar').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const dados = e.target.dataset;
                        window.abrirModalEditar(dados);
                    });
                });

                document.querySelectorAll('.excluir').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const id = e.target.dataset.id;
                        window.abrirModalExcluir(id);
                    });
                });
            })
            .catch(() => {
                corpo.innerHTML = '<tr><td colspan="11" align="center" style="color:red;">Erro ao carregar produtos</td></tr>';
            });
    }

    // 🔹 Exibe tabela ao clicar no card "Produtos"
    if (cardProdutos) {
        cardProdutos.addEventListener('click', () => {
            document.querySelectorAll('.dashboard').forEach(d => d.style.display = 'none');
            tabela.style.display = 'block';
            carregarProdutos();
        });
    }

    // 🔹 Voltar à dashboard
    botaoVoltar.addEventListener('click', () => {
        tabela.style.display = 'none';
        document.querySelectorAll('.dashboard').forEach(d => d.style.display = 'grid');
    });

    // 🔹 Torna função global (para uso no dashboard.js)
    window.recarregarTabela = carregarProdutos;
});
</script>
