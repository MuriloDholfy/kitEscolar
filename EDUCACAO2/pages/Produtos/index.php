<?php
      if (!isset($_SESSION)) {
        session_start();
    }
    
    $authUsuario = $_SESSION["authUsuario"] ?? null;
    require_once (__DIR__.'../../../DAO/ProdutoDAO.php'); 
    $produtos = ProdutoDAO::showAll();
   ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Loja online de materiais escolares com uma ampla variedade de produtos">
    <meta name="author" content="Sua Loja">
    <title>Loja de Material Escolar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../../img/Cabeçalho.svg">
</head>
<body>
    <!-- Site NavBar -->
    <?php 
           if(isset($_SESSION["authUsuario"])){
            $authUsuario = $_SESSION["authUsuario"];
            include('../../components/navBarLogado.php');//aqui é a verificação para ver se o usuario esta online
          }else{
            include('../../components/navBar.php');//aqui é a verificação para ver se o usuario esta off
          } ?>

    <!-- Seção de Produtos -->
    <section id="produtos" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Nossos Produtos</h2>
        <div class="products">
            <?php if (!empty($produtos)) { ?>
                <?php foreach ($produtos as $produto) { ?>
                    <div class="product-card">
                        <img src="../../img/Produto/<?= !empty($produto["imagemProduto"]) ? $produto["imagemProduto"] : 'padrao.png'; ?>" 
                             alt="<?= htmlspecialchars($produto['nomeProduto'], ENT_QUOTES, 'UTF-8') ?>" 
                             class="img-fluid mb-3"  style="height:300px;object-fit: cover; border:4px solid #ccc;width:300px ">
                        <h5><?= htmlspecialchars($produto['nomeProduto'], ENT_QUOTES, 'UTF-8') ?></h5>
                        <p class="text-muted">A partir de R$ <?= number_format($produto['valorProduto'], 2, ',', '.') ?></p>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra"
                            data-id="<?= htmlspecialchars($produto['idProduto'], ENT_QUOTES, 'UTF-8') ?>"   
                            data-nome="<?= htmlspecialchars($produto['nomeProduto'], ENT_QUOTES, 'UTF-8') ?>"
                            data-descricao="<?= htmlspecialchars($produto['descricaoProduto'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                            data-preco="<?= number_format($produto['valorProduto'], 2, '.', '') ?>"
                            data-imagem="../../img/Produto/<?= !empty($produto['imagemProduto']) ? $produto['imagemProduto'] : 'padrao.png'; ?>">

                             Comprar
                         </button>

                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="text-center text-muted">Nenhum produto disponível no momento.</p>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Modal de Compra -->
<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="comprarProcess.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCompraLabel">Detalhes do Produto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex">
          <!-- Imagem do Produto -->
          <div class="me-3">
            <img id="imagemProduto" class="img-fluid mb-3" style="height:300px; object-fit:cover; border:4px solid #ccc; width:300px;">
          </div>
          <!-- Informações do Produto -->
          <div>
            <h4 id="nomeProduto"></h4>
            <p id="descricaoProduto"></p>
            <p id="precoProduto"></p>
            <!-- Campos ocultos para envio -->
            <input type="hidden" name="idProduto" id="produtoId">
            <input type="hidden" name="nomeProduto" id="produtoNome">
            <input type="hidden" name="precoProduto" id="produtoPreco">
            <input type="hidden" name="idUsuario" value="<?= $authUsuario['id'] ?>">
            <div class="mb-3">
              <label for="quantidadeProduto" class="form-label">Quantidade</label>
              <input type="number" class="form-control" id="quantidadeProduto" name="quantidadeProduto" value="1" min="1">
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-shopping-cart me-2"></i>Adicionar ao Carrinho
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


   <!-- Footer -->
   <?php include('../../components/footer.php'); ?>



   <script>
    
    document.addEventListener('DOMContentLoaded', function () {
    const modalCompra = document.getElementById('modalCompra');

    modalCompra.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botão que acionou o modal

        // Pega os dados do botão
        const nome = button.getAttribute('data-nome') || 'Produto sem nome';
        const descricao = button.getAttribute('data-descricao') || 'Descrição não disponível.';
        const preco = button.getAttribute('data-preco') || '0.00';
        const imagem = button.getAttribute('data-imagem') || '../../img/Produto/padrao.png';

        // Atualiza os elementos do modal
        document.getElementById('nomeProduto').innerText = nome;
        document.getElementById('descricaoProduto').innerText = descricao;
        document.getElementById('precoProduto').innerText = `Preço: R$ ${parseFloat(preco).toFixed(2).replace('.', ',')}`;
        document.getElementById('imagemProduto').src = imagem;

        // Atualiza os campos ocultos
        document.getElementById('produtoId').value = button.getAttribute('data-id') || '';
        document.getElementById('produtoNome').value = nome;
        document.getElementById('produtoPreco').value = preco;
    });
});

</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
