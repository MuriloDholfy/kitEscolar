<?php
  require_once (__DIR__.'/../../dao/ProdutoDAO.php');
  require_once (__DIR__.'/../../model/produtoModel.php');
  require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/produtoDAO.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/model/produtoModel.php';

  $produto = new ProdutoModel();
   
    try {

        $nomeProduto = ProdutoDAO::showByName($_POST['input']);
        ?><section id="produtos" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Produtos Pesquisados</h2>
            <div class="products">
              <div id="resultadoSearch"></div>
                <?php if (!empty($nomeProduto)) { 
                    foreach ($nomeProduto as $produto) { ?>
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
                        <?php }}else{
                                    echo "<H6 class='text-danger text center mt-3'>Nada encontrado</H6>";
                                    }?>             
                </div>
            </div>
        </section> <?php
                
    } catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    } 
?>
