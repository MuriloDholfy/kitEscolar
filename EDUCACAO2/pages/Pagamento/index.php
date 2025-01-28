<?php
require_once(__DIR__.'/../../DAO/produtoDAO.php');

if (!isset($_SESSION)) {
    session_start();
}
$usuarioId = $_SESSION['authUsuario']['id']; 
$produtosPendentes = ProdutoDAO::showProdutosPendentes($usuarioId);


$totalItens = 0;
$totalPreco = 0;

foreach ($produtosPendentes as $produto) {
    $totalItens += $produto['quantidade'];
    $totalPreco += $produto['precoTotal']*$produto['quantidade'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../../img/Cabeçalho.svg">
</head>
<body>
    <!-- Site NavBar -->
    <?php include('../../components/navBar.php'); ?>

    <section class="finalizar-pagamento py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Finalizar Pagamento</h2>
            
            <!-- Imagem do Produto -->
            <!-- <div class="col-md-6">
                <h5>Imagem do Produto</h5>
                <img src="../../img/produto1.jpg" alt="Imagem do Produto" class="img-fluid">
            </div> -->

            <!-- Detalhes do Pedido -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Resumo do Pedido</h5>
                    <ul class="list-unstyled">
                        <li><strong>Itens:</strong> <?= $totalItens ?></li>
                        <li><strong>Total:</strong> <?= $totalPreco ?></li>
                        <li><strong>Frete:</strong> R$ 20,00</li>
                        <!-- <li><strong>Total a Pagar:</strong> R$ 170,00</li> -->
                    </ul>
                </div>

                <!-- Informações de pagamento -->
                <div class="col-md-6 mt-4">
                    <h5>Forma de Pagamento</h5>
                    <form id="paymentForm">
                        <!-- Selecione o método de pagamento -->
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Selecione o Método de Pagamento</label>
                            <select class="form-select" id="paymentMethod" required>
                                <option value="" disabled selected>Escolha...</option>
                                <option value="cartao">Cartão de Crédito</option>
                                <option value="duepay">DuePay</option>
                            </select>
                        </div>

                        <!-- Formulário de Cartão de Crédito -->
                        <div id="creditCardForm" class="payment-method-form">
                            <div class="mb-3">
                                <label for="cartao" class="form-label">Número do Cartão</label>
                                <input type="text" class="form-control" id="cartao" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                            </div>
                            <div class="mb-3">
                                <label for="validade" class="form-label">Data de Validade</label>
                                <input type="month" class="form-control" id="validade" required>
                            </div>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código de Segurança</label>
                                <input type="text" class="form-control" id="codigo" placeholder="XXX" required>
                            </div>
                            <div class="mb-3">
                                <label for="nome-titular" class="form-label">Nome do Titular</label>
                                <input type="text" class="form-control" id="nome-titular" required>
                            </div>
                        </div>

                        <!-- Formulário DuePay -->
                        <div id="duepayForm" class="payment-method-form" style="display: none;">
                            <div class="mb-3">
                                <label for="duepayEmail" class="form-label">E-mail DuePay</label>
                                <input type="email" class="form-control" id="duepayEmail" placeholder="Seu e-mail DuePay" required>
                            </div>
                            <div class="mb-3">
                                <label for="duepayPassword" class="form-label">Senha DuePay</label>
                                <input type="password" class="form-control" id="duepayPassword" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary">Voltar</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Finalizar Pagamento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar Pagamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja finalizar o pagamento? Esta ação não poderá ser revertida.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmPayment">Confirmar Pagamento</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../../components/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Script para controlar o formulário de pagamento -->
    <script>
        document.getElementById('paymentMethod').addEventListener('change', function() {
            const selectedMethod = this.value;
            const creditCardForm = document.getElementById('creditCardForm');
            const duepayForm = document.getElementById('duepayForm');

            // Exibir o formulário correspondente ao método selecionado
            if (selectedMethod === 'cartao') {
                creditCardForm.style.display = 'block';
                duepayForm.style.display = 'none';
            } else if (selectedMethod === 'duepay') {
                creditCardForm.style.display = 'none';
                duepayForm.style.display = 'block';
            }
        });

        document.getElementById('confirmPayment').addEventListener('click', function() {
            // Aqui você pode adicionar o código para finalizar o pagamento
            alert('Pagamento concluído com sucesso!');
            // Fechar o modal após a confirmação
            var modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
            modal.hide();
        });
    </script>
</body>
</html>
