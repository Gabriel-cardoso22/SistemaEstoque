<div id="tabela-produtos" style="display:none;">
    <h2>Lista de Produtos</h2>
    <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody id="produtos-body">
            <tr><td colspan="4" align="center">Carregando...</td></tr>
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabela = document.getElementById('tabela-produtos');
    const corpo = document.getElementById('produtos-body');
    const cardProdutos = document.querySelector('.card[data-section="produtos"]');

    // mostra tabela ao clicar no card
    cardProdutos.addEventListener('click', () => {
        document.querySelector('.dashboard').style.display = 'none';
        tabela.style.display = 'block';

        // requisita dados da API
        fetch('/api/produtos')
            .then(r => r.json())
            .then(dados => {
                corpo.innerHTML = '';
                dados.forEach(p => {
                    corpo.innerHTML += `
                        <tr>
                            <td>${p.id}</td>
                            <td>${p.nome}</td>
                            <td>${p.preco}</td>
                            <td>${p.quantidade}</td>
                        </tr>
                    `;
                });
            })
            .catch(() => {
                corpo.innerHTML = '<tr><td colspan="4" align="center">Erro ao carregar produtos</td></tr>';
            });
    });
});
</script>
