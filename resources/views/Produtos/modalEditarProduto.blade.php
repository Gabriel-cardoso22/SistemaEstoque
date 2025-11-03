<div id="modalEditar" class="modal">
  <div class="modal-content">
    <span class="fechar" data-fechar="editar">&times;</span>
    <h2>Editar Produto</h2>

    <form id="formEditar">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="editarId">

      <label>Nome*</label>
      <input type="text" name="nome" id="editarNome" required>

      <label>Categoria*</label>
      <input type="text" name="categoria" id="editarCategoria" required>

      <label>Preço (R$)*</label>
      <input type="number" name="preco" id="editarPreco" step="0.01" required>

      <label>Quantidade*</label>
      <input type="number" name="quantidade" id="editarQuantidade" required>

      <label>Descrição</label>
      <input type="text" name="descricao" id="editarDescricao">

      <button type="submit" class="btn-salvar">Atualizar</button>
      <p id="msgEditar" class="feedback"></p>
    </form>
  </div>
</div>
