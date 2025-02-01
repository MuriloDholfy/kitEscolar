<?php
   require_once (__DIR__.'../../../DAO/ProdutoDAO.php'); 
    //    if(isset($_SESSION["authUsuario"])){
    //      $authUsuario = $_SESSION["authUsuario"];
    //      include(__DIR__.'');//aqui é a verificação para ver se o usuario esta online
    //    }else{
    //      include(__DIR__.'');//aqui é a verificação para ver se o usuario esta off
    //    }
    //    if(!isset($_SESSION)) {
    //     session_start();
    //     $authUsuario = $_SESSION["authUsuario"];
    //     $produtosViaFooter = $_SESSION['produtos'];
        
    // }
    

    
    // if(!isset($authUsuario['id'])) {
    //     header("location: ../Login/login.php");
    // }
 
    $produtos = ProdutoDAO::showAll();  
    $idProduto = "";
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
    <style>
        .group {
        display: flex;
        line-height: 28px;
        align-items: center;
        position: relative;
        max-width: auto;
        }

        .input {
        width: 100%;
        height: 40px;
        line-height: 28px;
        padding: 0 1rem;
        padding-left: 2.5rem;
        border: 2px solid transparent;
        border-radius: 8px;
        outline: none;
        background-color: #f3f3f4;
        color: #0d0c22;
        transition: 0.3s ease;
        }

        .input::placeholder {
        color: #9e9ea7;
        }

        .input:focus,
        input:hover {
        outline: none;
        border-color:rgb(75, 120, 221);
        background-color: #fff;
        }

        .icon {
        position: absolute;
        left: 1rem;
        fill: rgb(75, 120, 221);
        width: 1rem;
        height: 1rem;
        }
    </style>
</head>
<body>
    <!-- Site NavBar -->
    <?php include('../../components/navBar.php'); ?>
    <section class="py-5">
        <div class="container">
            <div class="group w-100 ">
                <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                    <g>
                    <path
                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                    ></path>
                    </g>
                </svg>
                <input class="input" id="search_live" type="text" autocomplete="off" placeholder="Pesquise materiais e outros" />
            </div>
        </div>
    </section> 
    <div id="resultadoSearch"></div>
    <!-- Seção de Produtos -->
    <section id="produtos" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Nossos Produtos</h2>
        <div class="products">
            <?php if (!empty($produtos)) { ?>
                <?php foreach ($produtosViaFooter as $produto) { ?>
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
            <input type="text" name="idProduto" id="produtoId">
            <input type="text" name="nomeProduto" id="produtoNome">
            <input type="text" name="precoProduto" id="produtoPreco">
            <input type="text" name="idUsuario" value="<?= $authUsuario['id'] ?>">
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


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   
   <script>
    
      //ajax
      $(document).ready(function(){
        console.log("cheguei aqui");
          $("#search_live").keyup(function(){

            var input = $(this).val().trim();
              if (input === "") {
              $("#resultadoSearch").html(""); // Limpa os resultados ou exibe todos os produtos
              return; // Para a execução do AJAX
          }
            if(input != ""){
              console.log("cheguei no if");
                $.ajax({
                  url:"processSearch.php",
                  method:"POST",
                  data:{input : input},
                  
                    success: function(data){
                    $("#resultadoSearch").html(data);
                  }
              });
            }else{
              $("#resultadoSearch").css("display","none");
            }
          });
      });
    </script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
