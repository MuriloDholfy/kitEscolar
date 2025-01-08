<?php
     session_start();
       if(isset($_SESSION["authUsuario"])){
         $authUsuario = $_SESSION["authUsuario"];
         include(__DIR__.'');//aqui é a verificação para ver se o usuario esta online
       }else{
         include(__DIR__.'');//aqui é a verificação para ver se o usuario esta off
       }
   
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
    <?php include('../../components/navBar.php'); ?>

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
            <div class="product-card">
                <img src="https://via.placeholder.com/200" alt="Caderno" class="img-fluid mb-3" aria-label="Caderno Espiral">
                <h5>Caderno Espiral</h5>
                <p class="text-muted">A partir de R$ 15,00</p>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                    Comprar
                </button>
            </div>

            <div class="product-card">
                <img src="https://via.placeholder.com/200" alt="Caderno" class="img-fluid mb-3" aria-label="Caderno Espiral">
                <h5>Caderno Espiral</h5>
                <p class="text-muted">A partir de R$ 15,00</p>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                    Comprar
                </button>
            </div>

            <div class="product-card">
                <img src="https://via.placeholder.com/200" alt="Caderno" class="img-fluid mb-3" aria-label="Caderno Espiral">
                <h5>Caderno Espiral</h5>
                <p class="text-muted">A partir de R$ 15,00</p>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                    Comprar
                </button>
            </div>

            <div class="product-card">
                <img src="https://via.placeholder.com/200" alt="Caderno" class="img-fluid mb-3" aria-label="Caderno Espiral">
                <h5>Caderno Espiral</h5>
                <p class="text-muted">A partir de R$ 15,00</p>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                    Comprar
                </button>
            </div>

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
      <div class="modal-header">
        <h5 class="modal-title" id="modalCompraLabel">Detalhes do Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex">
        <!-- Imagem do Produto -->
        <div class="me-3">
          <img id="imagemProduto" src="https://via.placeholder.com/200" alt="Imagem do Produto" class="img-fluid" style="width: 200px; height: 200px;">
        </div>
        <!-- Informações do Produto -->
        <div>
          <h4 id="nomeProduto">Nome do Produto</h4>
          <p id="descricaoProduto">Descrição do produto vai aqui.</p>
          <p id="precoProduto">Preço: R$ 0,00</p>
          <div class="mb-3">
            <label for="quantidadeProduto" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidadeProduto" value="1" min="1">
          </div>
          <button type="button" class="btn btn-primary" id="comprarProduto"><i class="fas fa-shopping-cart me-2"></i>Adicionar ao Carrinho</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Site footer -->
<?php include('../../components/footer.php'); ?>




<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Captura os botões de "Comprar"
    const botoesCompra = document.querySelectorAll('.btn.btn-primary.btn-sm');

    botoesCompra.forEach(function (botao) {
      botao.addEventListener('click', function () {
        // Pega as informações do produto
        const nome = botao.getAttribute('data-nome');
        const descricao = botao.getAttribute('data-descricao');
        const preco = botao.getAttribute('data-preco');
        const imagem = botao.getAttribute('data-imagem');

        // Preenche o modal com as informações do produto
        document.getElementById('nomeProduto').innerText = nome;
        document.getElementById('descricaoProduto').innerText = descricao;
        document.getElementById('precoProduto').innerText = 'Preço: R$ ' + preco;
        document.getElementById('imagemProduto').src = imagem;
      });
    });

    // Quando o botão de comprar for pressionado
    document.getElementById('comprarProduto').addEventListener('click', function () {
      const quantidade = document.getElementById('quantidadeProduto').value;
      const nome = document.getElementById('nomeProduto').innerText;
      const preco = document.getElementById('precoProduto').innerText.replace('Preço: R$ ', '');

      alert(`Você comprou ${quantidade} unidade(s) de ${nome} por R$ ${preco * quantidade}`);
      // Aqui você pode adicionar lógica para adicionar ao carrinho ou finalizar a compra
    });
  });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
