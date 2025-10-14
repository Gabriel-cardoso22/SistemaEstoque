document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const btnAbrir = document.getElementById("abrirModal");
    const btnFechar = document.querySelector(".fechar");
    const form = document.getElementById("formProduto");
    const mensagem = document.getElementById("mensagemErro"); // feedback
    const dashboard = document.querySelector(".dashboard");

    // Abrir modal
    btnAbrir.onclick = () => {
        modal.style.display = "block";
        mensagem.textContent = "";
        mensagem.className = "";
    };

    // Fechar modal
    btnFechar.onclick = () => modal.style.display = "none";

    window.onclick = (e) => {
        if (e.target === modal) modal.style.display = "none";
    };

    // Envio do formulário
    form.onsubmit = async (e) => {
        e.preventDefault();

        const nome = form.nome.value.trim();
        const categoria = form.categoria.value.trim();
        const preco = form.preco.value;
        const quantidade = form.quantidade.value;

        if (!nome || !categoria || !preco || !quantidade) {
            mensagem.textContent = "⚠️ Todos os campos são obrigatórios!";
            mensagem.className = "erro";
            return;
        }

        mensagem.textContent = "";
        mensagem.className = "";

        const dados = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: dados
            });

            if (!response.ok) throw new Error("Erro ao salvar produto");

            const produto = await response.json();

            // Adiciona produto ao dashboard
            const cardProduto = document.createElement("div");
            cardProduto.classList.add("card");
            cardProduto.innerHTML = `
                <h3>${produto.nome}</h3>
                <p>Categoria: ${produto.categoria}</p>
                <p>Preço: R$ ${produto.preco}</p>
                <p>Quantidade: ${produto.quantidade}</p>
            `;
            dashboard.appendChild(cardProduto);

            // Feedback de sucesso
            mensagem.textContent = "✅ Produto cadastrado com sucesso!";
            mensagem.className = "sucesso";

            form.reset();

        } catch (err) {
            mensagem.textContent = "❌ Não foi possível salvar o produto.";
            mensagem.className = "erro";
            console.error(err);
        }
    };
});