<?php
       if(!isset($_SESSION)) {
        session_start();
        $authUsuario = $_SESSION["authUsuario"];
        
    }
    if(!isset($authUsuario['id'])) {
        header("location: ../Login/index.php");
    }
require_once(__DIR__.'/../../DAO/comandaDAO.php');
require_once(__DIR__.'/../../DAO/produtoDAO.php');
$usuarioId = $_SESSION['authUsuario']['id']; 
$comandasPendentes = ComandaDAO::showByIdUser($usuarioId);
$produtosPendentes = ProdutoDAO::showAllProdutos($usuarioId);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Loja online de materiais escolares com uma ampla variedade de produtos">
    <meta name="author" content="Sua Loja">
    <title>Acompanhamento de Pedidos</title>

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

    <section class="order-tracking py-5">
        <div class="container">
            <h2 class="text-center mb-4">Acompanhamento de Pedidos</h2>

            <!-- Guia de Status -->
            <ul class="nav nav-tabs mb-4" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="preparing-tab" data-bs-toggle="tab" data-bs-target="#preparing" type="button" role="tab" aria-controls="preparing" aria-selected="true">
                        Preparando
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="on-the-way-tab" data-bs-toggle="tab" data-bs-target="#on-the-way" type="button" role="tab" aria-controls="on-the-way" aria-selected="false">
                        A Caminho
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">
                        Finalizados
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">
                        Cancelados
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="refund-tab" data-bs-toggle="tab" data-bs-target="#refund" type="button" role="tab" aria-controls="refund" aria-selected="false">
                        Reembolso
                    </button>
                </li>
            </ul>

            <!-- Conteúdo das Guias -->
            <div class="tab-content" id="orderTabsContent">
                <!-- Pedidos em Preparação -->
                <div class="tab-pane fade show active" id="preparing" role="tabpanel" aria-labelledby="preparing-tab">
                    <div class="card">
                        <div class="card-body">
                        <?php 
                        foreach($comandasPendentes as $comanda){
                            if($comanda["statusComanda"] == "Em andamento"){?>
                                <h5 class="card-title">Pedido #<?= $comanda["idComanda"] ?></h5>
                            <ul class="list-group list-group-flush">
                            <?php  foreach($produtosPendentes as $produtoComanda){ 
                                if ($produtoComanda["idComanda"] == $comanda["idComanda"]) { ?>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <span><?=$produtoComanda["nomeProduto"]?></span>
                                            <span><?=$produtoComanda["quantidade"]?>x R$<?=$produtoComanda["preco"]?>,00</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item fw-bold">
                                    <div class="d-flex justify-content-between">
                                        <span>Total</span>
                                        <span>R$ <?=$produtoComanda["precoTotal"]?>,00</span>
                                    </div>
                                </li>
                                </ul>
                                <div class="mt-3 mb-3">
                                    <button class="btn btn-danger btn-sm">Cancelar Pedido</button>
                                </div>
                                <?php } } } } ?>
                        </div>
                    </div>
                </div>

                <!-- Pedidos a Caminho -->
                <div class="tab-pane fade" id="on-the-way" role="tabpanel" aria-labelledby="on-the-way-tab">
                    <div class="card">
                        <div class="card-body">
                        <?php 
                        foreach($comandasPendentes as $comanda){
                            if($comanda["statusComanda"] == "A caminho"){?>
                                <h5 class="card-title">Pedido #<?= $comanda["idComanda"] ?></h5>
                            <ul class="list-group list-group-flush">
                            <?php  foreach($produtosPendentes as $produtoComanda){ 
                                if ($produtoComanda["idComanda"] == $comanda["idComanda"]) { ?>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <span><?=$produtoComanda["nomeProduto"]?></span>
                                            <span><?=$produtoComanda["quantidade"]?>x R$<?=$produtoComanda["preco"]?>,00</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item fw-bold">
                                    <div class="d-flex justify-content-between">
                                        <span>Total</span>
                                        <span>R$ <?=$produtoComanda["precoTotal"]?>,00</span>
                                    </div>
                                </li>
                                </ul>
                                <div class="mt-3 mb-3">
                                    <button class="btn btn-danger btn-sm">Cancelar Pedido</button>
                                </div>
                                <?php } } } } ?>
                        </div>
                    </div>
                </div>

                <!-- Pedidos Finalizados -->
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <div class="card">
                        <div class="card-body">
                        <?php 
                        foreach($comandasPendentes as $comanda){
                            if($comanda["statusComanda"] == "Concluido"){?>
                                <h5 class="card-title">Pedido #<?= $comanda["idComanda"] ?></h5>
                            <ul class="list-group list-group-flush">
                            <?php  foreach($produtosPendentes as $produtoComanda){ 
                                if ($produtoComanda["idComanda"] == $comanda["idComanda"]) { ?>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <span><?=$produtoComanda["nomeProduto"]?></span>
                                            <span><?=$produtoComanda["quantidade"]?>x R$<?=$produtoComanda["preco"]?>,00</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item fw-bold">
                                    <div class="d-flex justify-content-between">
                                        <span>Total</span>
                                        <span>R$ <?=$produtoComanda["precoTotal"]?>,00</span>
                                    </div>
                                </li>
                                </ul>
                                <div class="mt-3 mb-3">
                                    <button class="btn btn-danger btn-sm">Cancelar Pedido</button>
                                </div>
                                <?php } } } } ?>
                        </div>
                    </div>
                </div>

                <!-- Pedidos Cancelados -->
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <div class="card">
                        <div class="card-body">
                        <?php 
                            foreach ($comandasPendentes as $comanda) {
                                if ($comanda["statusComanda"] == "Cancelado") { ?>
                                    <h5 class="card-title">Pedido #<?= $comanda["idComanda"] ?></h5>
                                    <ul class="list-group list-group-flush">
                                    <?php  
                                    $temProduto = false; 
                                    foreach ($produtosPendentes as $produtoComanda) { 
                                        if ($produtoComanda["idComanda"] == $comanda["idComanda"]) { 
                                            $temProduto = true; ?>
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between">
                                                    <span><?= $produtoComanda["nomeProduto"] ?></span>
                                                    <span><?= $produtoComanda["quantidade"] ?>x R$<?= number_format($produtoComanda["preco"], 2, ',', '.') ?></span>
                                                </div>
                                            </li>
                                        <?php 
                                        } 
                                    }
                                    ?>
                                    </ul> 
                                    <?php if (!$temProduto) { ?>
                                        <p class="text-muted">Nenhum produto encontrado para esta comanda.</p>
                                    <?php } ?>
                                    <div class="mt-3 mb-3">
                                        <button class="btn btn-secondary btn-sm" disabled>Pedido Cancelado</button>
                                    </div>
                            <?php 
                                } 
                            } 
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Pedidos em Reembolso -->
                <div class="tab-pane fade" id="refund" role="tabpanel" aria-labelledby="refund-tab">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pedido #12342</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <span>Caderno Espiral</span>
                                        <span>3x R$ 10,00</span>
                                    </div>
                                </li>
                                <li class="list-group-item fw-bold">
                                    <div class="d-flex justify-content-between">
                                        <span>Total</span>
                                        <span>R$ 30,00</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-3">
                                <span class="badge bg-warning text-dark">Em Processo de Reembolso</span>
                                <button class="btn btn-info btn-sm mt-2">Detalhes do Reembolso</button>
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
</body>
</html>