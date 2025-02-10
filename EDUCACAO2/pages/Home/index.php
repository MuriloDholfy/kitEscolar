<?php

    //    if(isset($_SESSION["authUsuario"])){
    //      $authUsuario = $_SESSION["authUsuario"];
    //      include(__DIR__.'../../components/navBar.php');//aqui é a verificação para ver se o usuario esta online
    //    }else{
    //      include(__DIR__.'../../components/navBarLogado.php');//aqui é a verificação para ver se o usuario esta off
    //    }
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

    <!-- Link para o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link para o Font Awesome (para ícones) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Link para fontes do Google (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Link para o arquivo CSS personalizado -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="../../img/Cabeçalho.svg">
</head>
<body>
    <!-- Site NavBar -->
    <?php   if(isset($_SESSION["authUsuario"])){
            $authUsuario = $_SESSION["authUsuario"];
            include('../../components/navBarLogado.php');//aqui é a verificação para ver se o usuario esta online
          }else{
            include('../../components/navBar.php');//aqui é a verificação para ver se o usuario esta off
          } ?> 

    <!-- Conteúdo do Site -->
    <section class="hero">
        <div class="container text-center">
            <div class="col-6">
                <h1>Bem-vindo à Loja de Material Escolar</h1>
                <p>Encontre tudo o que você precisa para a volta às aulas.</p>
                <a href="#produtos" class="btn btn-primary btn-lg">Ver Produtos</a>
            </div>
           
        </div>
     
    </section>
   
    <section class="features py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 feature">
                    <img src="../../img/Whatsapp.png" alt="Logo" class="mb-2" style="height: 40px;">
                    <h5>Atendimento via WhatsApp</h5>
                    <p>Entre em contato com um de nossos atendentes.</p>
                </div>
                <div class="col-md-3 feature">
                    <i class="fas fa-credit-card"></i>
                    <h5>Aceitamos APP Duepay</h5>
                    <p>Pague com o benefício da Prefeitura de SP.</p>
                </div>
                <div class="col-md-3 feature">
                    <i class="fas fa-shipping-fast"></i>
                    <h5>4 Pontos de distribuição</h5>
                    <p>.</p>
                </div>
                <div class="col-md-3 feature">
                    <i class="fas fa-shield-alt"></i>
                    <h5>Loja Credenciada</h5>
                    <p>Somos credenciados pela Prefeitura de São Paulo.</p>
                </div>
            </div>
        </div>
    </section>

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



    <section id="sobre" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Sobre Nós</h2>
            <p class="text-center">Somos apaixonados por oferecer os melhores materiais escolares para garantir o sucesso dos estudos.</p>
        </div>
    </section>

    <section id="duepay" class="py-5 bg-cover text-white d-flex align-items-center">
        <div class="container">
           
            <div class="">
            <h2 class="text-center col-md-4 mb-4 text-black">O que é Duepay?</h2>
                <div class="col-md-4">
                    <div class="card text-white p-3 mb-3">
                        <h5>Baixe o aplicativo Duepay em seu celular</h5>
                        <p>Encontre na loja de aplicativos do seu smartphone e instale.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white p-3 mb-3">
                        <h5>Cadastre-se e adicione suas informações pessoais</h5>
                        <p>Inclua suas informações no app para começar a usá-lo.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white p-3 mb-3">
                        <h5>Efetue o pagamento diretamente pelo aplicativo</h5>
                        <p>Utilize o app para pagar e aproveite seus materiais escolares.</p>
                    </div>
                </div>
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
            <input type="hidden" name="idUsuario" value="<?= $authUsuario['id']?>">
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




<!-- Site footer -->
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
