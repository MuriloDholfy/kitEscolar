<div class="modal fade" id="meuModal" role="dialog">
  <div class=" modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body  ">
        <form action="process.php" method="post">
          <input class="form-control" id="id" name="id" type="text">
          <p>Tem certeza que deseja excluir o item?
          <div class=" text-end">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
            <button type="submit" class="btn btn-warning ms-3" value="Deletar" name="acao">Sim </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>