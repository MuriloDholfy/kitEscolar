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
                <input class="input" type="search" placeholder="Pesquise materiais e outros" />
            </div>
        </div>
    </section>
    <!-- Seção de Produtos -->
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
                    <img src="https://via.placeholder.com/200" alt="Mochila" class="img-fluid mb-3" aria-label="Mochila Escolar">
                    <h5>Mochila Escolar</h5>
                    <p class="text-muted">A partir de R$ 120,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Canetas" class="img-fluid mb-3" aria-label="Kit de Canetas">
                    <h5>Kit de Canetas</h5>
                    <p class="text-muted">A partir de R$ 25,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Estojo" class="img-fluid mb-3" aria-label="Estojo Escolar">
                    <h5>Estojo Escolar</h5>
                    <p class="text-muted">A partir de R$ 30,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                            
                </div>            
            </div>  
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
                    <img src="https://via.placeholder.com/200" alt="Mochila" class="img-fluid mb-3" aria-label="Mochila Escolar">
                    <h5>Mochila Escolar</h5>
                    <p class="text-muted">A partir de R$ 120,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Canetas" class="img-fluid mb-3" aria-label="Kit de Canetas">
                    <h5>Kit de Canetas</h5>
                    <p class="text-muted">A partir de R$ 25,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Estojo" class="img-fluid mb-3" aria-label="Estojo Escolar">
                    <h5>Estojo Escolar</h5>
                    <p class="text-muted">A partir de R$ 30,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                            
                </div>            
            </div>  
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
                    <img src="https://via.placeholder.com/200" alt="Mochila" class="img-fluid mb-3" aria-label="Mochila Escolar">
                    <h5>Mochila Escolar</h5>
                    <p class="text-muted">A partir de R$ 120,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Canetas" class="img-fluid mb-3" aria-label="Kit de Canetas">
                    <h5>Kit de Canetas</h5>
                    <p class="text-muted">A partir de R$ 25,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Estojo" class="img-fluid mb-3" aria-label="Estojo Escolar">
                    <h5>Estojo Escolar</h5>
                    <p class="text-muted">A partir de R$ 30,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                            
                </div>            
            </div>  
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
                    <img src="https://via.placeholder.com/200" alt="Mochila" class="img-fluid mb-3" aria-label="Mochila Escolar">
                    <h5>Mochila Escolar</h5>
                    <p class="text-muted">A partir de R$ 120,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Canetas" class="img-fluid mb-3" aria-label="Kit de Canetas">
                    <h5>Kit de Canetas</h5>
                    <p class="text-muted">A partir de R$ 25,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Estojo" class="img-fluid mb-3" aria-label="Estojo Escolar">
                    <h5>Estojo Escolar</h5>
                    <p class="text-muted">A partir de R$ 30,00</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCompra" 
                        data-nome="Caderno Espiral" data-descricao="Caderno espiral com 200 folhas." data-preco="15.00">
                        Comprar
                    </button>
                            
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


   <!-- Footer -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
