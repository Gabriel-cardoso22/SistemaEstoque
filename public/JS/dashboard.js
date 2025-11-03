// ==================== VARIÁVEIS GERAIS ==================== //
const tabelaProdutos = document.getElementById("tabela-produtos");
const corpoTabela = document.getElementById("produtos-body");
const cardProdutos = document.querySelector('.card[data-section="produtos"]');
const btnVoltar = document.getElementById("voltar-dashboard");

// ==================== MODAIS ==================== //
const modalCadastrar = document.getElementById("modalCadastrar");
const modalEditar = document.getElementById("modalEditar");
const modalExcluir = document.getElementById("modalExcluir");

// Fechar modal genérico
function fecharModal(modal) {
    modal.style.display = "none";
}

// Abrir modal genérico
function abrirModal(modal) {
    modal.style.display = "block";
}

// ==================== FUNÇÕES DE FEEDBACK ==================== //
function mostrarMensagem(tipo, texto) {
    const msg = document.createElement('div');
    msg.className = tipo === 'erro' ? 'erro' : 'sucesso';
    msg.textContent = texto;
    document.body.appendChild(msg);

    msg.style.position = 'fixed';
    msg.style.top = '20px';
    msg.style.left = '50%';
    msg.style.transform = 'translateX(-50%)';
    msg.style.background = tipo === 'erro' ? '#f8d7da' : '#d4edda';
    msg.style.color = tipo === 'erro' ? '#721c24' : '#155724';
    msg.style.padding = '12px 20px';
    msg.style.borderRadius = '8px';
    msg.style.boxShadow = '0 2px 6px rgba(0,0,0,0.3)';
    msg.style.zIndex = '9999';
    msg.style.fontWeight = 'bold';

    setTimeout(() => msg.remove(), 3000);
}

// ==================== FUNÇÃO PARA FORMATAR DATA ==================== //
function formatarData(dataStr) {
    const data = new Date(dataStr);
    return data.toLocaleString('pt-BR', { dateStyle: 'short', timeStyle: 'short' });
}

// ==================== FUNÇÃO PARA CARREGAR PRODUTOS ==================== //
async function carregarProdutos() {
    corpoTabela.innerHTML = '<tr><td colspan="10" align="center">Carregando...</td></tr>';
    try {
        const res = await fetch('/api/produtos');
        const dados = await res.json();

        corpoTabela.innerHTML = '';

        if (!dados.length) {
            corpoTabela.innerHTML = '<tr><td colspan="10" align="center">Nenhum produto encontrado</td></tr>';
            return;
        }

        dados.forEach(p => {
            corpoTabela.innerHTML += `
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
                    <td>
                        <button class="btn-editar" data-id="${p.id}">Editar</button>
                        <button class="btn-excluir" data-id="${p.id}">Excluir</button>
                    </td>
                </tr>
            `;
        });

        // Atribui eventos aos botões recém-renderizados
        document.querySelectorAll('.btn-editar').forEach(btn =>
            btn.addEventListener('click', () => abrirModalEdicao(btn.dataset.id))
        );

        document.querySelectorAll('.btn-excluir').forEach(btn =>
            btn.addEventListener('click', () => abrirModalExclusao(btn.dataset.id))
        );

    } catch (e) {
        corpoTabela.innerHTML = '<tr><td colspan="10" align="center" style="color:red;">Erro ao carregar produtos</td></tr>';
    }
}

// ==================== FUNÇÃO PARA CADASTRAR PRODUTO ==================== //
async function cadastrarProduto(dados) {
    try {
        const res = await fetch('/produtos', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        });

        const resultado = await res.json();

        if (res.ok) {
            mostrarMensagem('sucesso', 'Produto cadastrado com sucesso!');
            fecharModal(modalCadastrar);
            carregarProdutos();
        } else {
            mostrarMensagem('erro', resultado.message || 'Erro ao cadastrar produto');
        }
    } catch {
        mostrarMensagem('erro', 'Erro de conexão ao cadastrar');
    }
}

// ==================== FUNÇÃO PARA EDITAR PRODUTO ==================== //
async function editarProduto(id, dados) {
    try {
        const res = await fetch(`/produtos/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        });

        const resultado = await res.json();

        if (res.ok) {
            mostrarMensagem('sucesso', 'Produto atualizado com sucesso!');
            fecharModal(modalEditar);
            carregarProdutos();
        } else {
            mostrarMensagem('erro', resultado.message || 'Erro ao atualizar produto');
        }
    } catch {
        mostrarMensagem('erro', 'Erro de conexão ao editar');
    }
}

// ==================== FUNÇÃO PARA EXCLUIR PRODUTO ==================== //
async function excluirProduto(id) {
    try {
        const res = await fetch(`/produtos/${id}`, {
            method: 'DELETE'
        });

        if (res.ok) {
            mostrarMensagem('sucesso', 'Produto excluído com sucesso!');
            fecharModal(modalExcluir);
            carregarProdutos();
        } else {
            mostrarMensagem('erro', 'Erro ao excluir produto');
        }
    } catch {
        mostrarMensagem('erro', 'Erro de conexão ao excluir');
    }
}

// ==================== ABRIR MODAL DE EDIÇÃO ==================== //
async function abrirModalEdicao(id) {
    try {
        const res = await fetch(`/api/produtos/${id}`);
        const produto = await res.json();

        if (!res.ok) throw new Error();

        document.getElementById('editar-id').value = produto.id;
        document.getElementById('editar-nome').value = produto.nome;
        document.getElementById('editar-descricao').value = produto.descricao;
        document.getElementById('editar-preco').value = produto.preco;
        document.getElementById('editar-quantidade').value = produto.quantidade;
        document.getElementById('editar-categoria').value = produto.categoria;
        abrirModal(modalEditar);
    } catch {
        mostrarMensagem('erro', 'Erro ao carregar produto para edição');
    }
}

// ==================== ABRIR MODAL DE EXCLUSÃO ==================== //
function abrirModalExclusao(id) {
    abrirModal(modalExcluir);
    document.getElementById('confirmar-exclusao').onclick = () => excluirProduto(id);
}

// ==================== EVENTOS GERAIS ==================== //
if (cardProdutos) {
    cardProdutos.addEventListener('click', () => {
        document.querySelectorAll('.dashboard').forEach(d => d.style.display = 'none');
        tabelaProdutos.style.display = 'block';
        carregarProdutos();
    });
}

if (btnVoltar) {
    btnVoltar.addEventListener('click', () => {
        tabelaProdutos.style.display = 'none';
        document.querySelectorAll('.dashboard').forEach(d => d.style.display = 'grid');
    });
}
