<?php
     if (!isset($_SESSION)) {
        session_start();
    }
    
    $authUsuario = $_SESSION["authUsuario"] ?? null;
    if($authUsuario == null){
        header("Location: ../Login/index.php");
    }
require_once(__DIR__.'/../../DAO/produtoDAO.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/ProdutoDAO.php';
$usuarioId = $_SESSION['authUsuario']['id']; 
$produtosPendentes = ProdutoDAO::showProdutosPendentes($usuarioId);
$totalItens = 0;
$totalPreco = 0;

foreach ($produtosPendentes as $produto) {
    $totalItens += $produto['quantidade'];
    $totalPreco += $produto['precoTotal'] * $produto['quantidade'];
}
$frete = 0;

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
    <?php 
           if(isset($_SESSION["authUsuario"])){
            $authUsuario = $_SESSION["authUsuario"];
            include('../../components/navBarLogado.php');//aqui é a verificação para ver se o usuario esta online
          }else{
            include('../../components/navBar.php');//aqui é a verificação para ver se o usuario esta off
          } ?>

    <section class="shopping-cart py-5">
    <div class="container">
        <h2 class="text-center mb-4">Carrinho de Compras</h2>
        <div class="row">
            <!-- Lista de Itens no Carrinho -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Preço Unitário</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemplo de Item no Carrinho -->
                                     
                                   <?php if(!empty($produtosPendentes)){
                                   foreach($produtosPendentes as $produto){ ?>
                                   <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                            <img src="../../img/Produto/<?= !empty($produto["imagemProduto"]) ? $produto["imagemProduto"] : 'padrao.png'; ?>" 
                                            alt="<?= htmlspecialchars($produto['nomeProduto'], ENT_QUOTES, 'UTF-8') ?>" 
                                            class="img-fluid mb-3"  style="height:100px;object-fit: cover; border:4px solid #ccc;width:100px ">
                                                <div class="ms-3">
                                                    <h6 class="mb-0"><?= $produto['nomeProduto']?></h6>
                                                    <small class="text-muted"><?= $produto['descricaoProduto']?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                           <p><?= $produto['quantidade']?></p>
                                        </td>
                                        <td><?= $produto['preco']?>,00</td>
                                        <td><?= $produto['precoTotal']?>,00</td>
                                        <td>
                                            <form method="post" action="carrinhoProcess.php">
                                            <input type="hidden" class="form-control" id="id" name="idComanda" value="<?=$produto["idComanda"]?>">
                                            <input type="hidden" class="form-control" id="id" name="idComandaProduto" value="<?=$produto["idComanda_Produtos"]?>">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                    <!-- Fim do Exemplo de Item no Carrinho -->
                                </tbody>
                            </table>
                                    <?php if(empty($produtosPendentes)) { ?>
                                    <tr>
                                     <td>
                                         <p class="text-center text-muted">Nenhum produto disponível no momento.</p>
                                     </td>
                                    </tr>
                                 <?php }
                                 ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumo do Pedido -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Resumo do Pedido</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Subtotal
                                <span>R$ <?=$totalPreco?>,00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Frete
                                <span>R$ <?=$frete?>,00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total
                                <span>R$ <?=$totalPreco +=$frete;?>,00</span>
                            </li>
                        </ul>
                        <div class="d-grid gap-2 mt-3">
                            <!-- <form action=""> -->
                              <a href="../../pages/Pagamento/index.php"> <button class="btn btn-primary btn-lg">Finalizar Compra</button></a> 
                            <!-- </form> -->
                            <button class="btn btn-outline-secondary btn-lg">Continuar Comprando</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  



    

<!-- Site footer -->
<?php include('../../components/footer.php'); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
