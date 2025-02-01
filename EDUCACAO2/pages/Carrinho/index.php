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
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="../../img/produtos/caderno.jpg" alt="Caderno" class="img-thumbnail" style="width: 60px;">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Caderno Universitário</h6>
                                                    <small class="text-muted">Capa dura, 200 folhas</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" value="2" min="1" style="width: 70px;">
                                        </td>
                                        <td>R$ 15,00</td>
                                        <td>R$ 30,00</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Fim do Exemplo de Item no Carrinho -->
                                </tbody>
                            </table>
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
                                <span>R$ 30,00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Frete
                                <span>R$ 10,00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total
                                <span>R$ 40,00</span>
                            </li>
                        </ul>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary btn-lg">Finalizar Compra</button>
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
