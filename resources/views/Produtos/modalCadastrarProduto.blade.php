<div id="modalCadastrar" class="modal">
  <div class="modal-content">
    <span class="fechar" data-fechar="cadastrar">&times;</span>
    <h2>Cadastrar Produto</h2>

    <form id="formCadastrar">
      @csrf
      <label>Nome*</label>
      <input type="text" name="nome" required>

      <label>Categoria*</label>
      <input type="text" name="categoria" required>

      <label>Preço (R$)*</label>
      <input type="number" name="preco" step="0.01" required>

      <label>Quantidade*</label>
      <input type="number" name="quantidade" required>

      <label>Descrição</label>
      <input type="text" name="descricao">

      <button type="submit" class="btn-salvar">Salvar</button>
      <p id="msgCadastrar" class="feedback"></p>
    </form>
  </div>
</div>
