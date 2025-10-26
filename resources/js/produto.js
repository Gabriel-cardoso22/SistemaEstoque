// resources/js/produtos.js
document.addEventListener('DOMContentLoaded', () => {
  const mensagemEl = document.getElementById('mensagemErro'); // elemento para exibir mensagens
  const tabelaProdutosContainer = document.getElementById('tabela-produtos');
  const corpoTabela = document.getElementById('corpo-tabela-produtos'); // id que vamos usar no blade
  const form = document.getElementById('formProduto');

  function mostrarMensagem(texto, tipo = 'info') {
    if (!mensagemEl) return;
    mensagemEl.textContent = texto;
    mensagemEl.className = ''; // reseta
    mensagemEl.classList.add(tipo); // 'sucesso', 'erro', 'info'
  }

  function formatarData(iso) {
    try {
      const d = new Date(iso);
      return d.toLocaleString();
    } catch (e) {
      return iso;
    }
  }

  async function listarProdutos() {
    if (!corpoTabela) return;
    corpoTabela.innerHTML = '<tr><td colspan="10">Carregando...</td></tr>';

    try {
      const res = await axios.get('/api/produtos');
      const dados = res.data;

      if (!Array.isArray(dados) || dados.length === 0) {
        corpoTabela.innerHTML = '<tr><td colspan="10" align="center">Nenhum produto encontrado</td></tr>';
        return;
      }

      corpoTabela.innerHTML = '';
      dados.forEach(p => {
        corpoTabela.innerHTML += `
          <tr>
            <td>${p.id}</td>
            <td>${p.nome}</td>
            <td>${p.descricao || '-'}</td>
            <td>${Number(p.preco).toFixed(2)}</td>
            <td>${p.quantidade}</td>
            <td>${p.categoria || '-'}</td>
            <td>${p.user_id ?? '-'}</td>
            <td>${p.fornecedor_id ?? '-'}</td>
            <td>${p.created_at ? formatarData(p.created_at) : '-'}</td>
            <td>${p.updated_at ? formatarData(p.updated_at) : '-'}</td>
          </tr>
        `;
      });

    } catch (err) {
      if (err.code === 'ECONNABORTED') {
        corpoTabela.innerHTML = '<tr><td colspan="10" align="center" style="color:orange;">Timeout: o servidor demorou muito para responder.</td></tr>';
      } else if (err.response && err.response.status >= 500) {
        corpoTabela.innerHTML = '<tr><td colspan="10" align="center" style="color:red;">Erro interno do servidor ao carregar produtos (500).</td></tr>';
      } else {
        corpoTabela.innerHTML = '<tr><td colspan="10" align="center" style="color:red;">Erro ao carregar produtos.</td></tr>';
      }
      console.error(err);
    }
  }

  async function cadastrarProduto(event) {
    event.preventDefault();
    if (!form) return;

    const formData = new FormData(form);
    const payload = {};
    formData.forEach((v,k) => payload[k] = v);

    mostrarMensagem('Enviando produto...', 'info');

    try {
      const res = await axios.post('/api/produtos', payload);
      if (res.status === 201 || res.status === 200) {
        mostrarMensagem('✅ Produto cadastrado com sucesso!', 'sucesso');
        form.reset();
        await listarProdutos(); // atualiza a tabela para refletir o DB
      } else {
        mostrarMensagem('❌ Não foi possível cadastrar o produto. Código: '+res.status, 'erro');
      }
    } catch (err) {
      if (err.code === 'ECONNABORTED') {
        mostrarMensagem('⏱️ Tempo de conexão esgotado. Tente novamente.', 'erro');
      } else if (err.response && err.response.status >= 500) {
        mostrarMensagem('⚠️ Erro no servidor (500). Tente novamente mais tarde.', 'erro');
      } else if (err.response && err.response.status === 422) {
        // validação do backend
        const errors = err.response.data.errors || err.response.data;
        const first = (typeof errors === 'object') ? Object.values(errors)[0] : JSON.stringify(errors);
        mostrarMensagem('Validação: ' + (Array.isArray(first) ? first[0] : first), 'erro');
      } else {
        mostrarMensagem('❌ Erro ao enviar produto. Veja console.', 'erro');
      }
      console.error(err);
    }
  }

  // Se houver botão de abrir tabela, chamar listarProdutos
  const btnVerProdutos = document.getElementById('verProdutosBtn');
  if (btnVerProdutos) {
    btnVerProdutos.addEventListener('click', () => {
      listarProdutos();
      // mostrar/hide da UI: implementado na blade
    });
  }

  if (form) {
    form.addEventListener('submit', cadastrarProduto);
  }

  // opcional: listar no carregamento da página
  if (tabelaProdutosContainer && tabelaProdutosContainer.dataset.autoload === 'true') {
    listarProdutos();
  }
});