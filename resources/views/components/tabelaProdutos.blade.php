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
            </tr>
        </thead>
        <tbody id="produtos-body">
            <tr><td colspan="10" align="center">Carregando...</td></tr>
        </tbody>
    </table>

    <button id="voltar-dashboard" style="margin-top: 20px; background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer;">
        Voltar à Dashboard
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabela = document.getElementById('tabela-produtos');
    const corpo = document.getElementById('produtos-body');
    const botaoVoltar = document.getElementById('voltar-dashboard');
    const cardProdutos = document.querySelector('.card[data-section="produtos"]');

    // função para formatar data
    const formatarData = (dataStr) => {
        const data = new Date(dataStr);
        return data.toLocaleString('pt-BR', { dateStyle: 'short', timeStyle: 'short' });
    };

    // ao clicar no card de produtos
    if (cardProdutos) {
        cardProdutos.addEventListener('click', () => {
            document.querySelectorAll('.dashboard').forEach(d => d.style.display = 'none');
            tabela.style.display = 'block';

            fetch('/api/produtos')
                .then(r => r.json())
                .then(dados => {
                    corpo.innerHTML = '';

                    if (!dados.length) {
                        corpo.innerHTML = '<tr><td colspan="10" align="center">Nenhum produto encontrado</td></tr>';
                        return;
                    }

                    dados.forEach(p => {
                        corpo.innerHTML += `
                            <tr>
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
                            </tr>
                        `;
                    });
                })
                .catch(() => {
                    corpo.innerHTML = '<tr><td colspan="10" align="center" style="color:red;">Erro ao carregar produtos</td></tr>';
                });
        });
    }

    // botão voltar à dashboard
    botaoVoltar.addEventListener('click', () => {
        tabela.style.display = 'none';
        document.querySelectorAll('.dashboard').forEach(d => d.style.display = 'grid');
    });
});
</script>
