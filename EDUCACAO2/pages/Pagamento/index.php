<?php
require_once(__DIR__.'/../../DAO/produtoDAO.php');
require_once(__DIR__.'/../../DAO/usuarioDAO.php');
require_once(__DIR__.'/../../DAO/tipoPagamentoDAO.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/produtoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/usuarioDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/tipoPagamentoDAO.php';

if (!isset($_SESSION)) {
    session_start();
}
$usuarioId = $_SESSION['authUsuario']['id']; 
$produtosPendentes = ProdutoDAO::showProdutosPendentes($usuarioId);

$enderecos = UsuarioDAO::showByIdEndereco($usuarioId);
$totalItens = 0;
$totalPreco = 0;

foreach ($produtosPendentes as $produto) {
    $totalItens += $produto['quantidade'];
    $totalPreco += $produto['precoTotal'] * $produto['quantidade'];
}

$tipos = TipoPagamentoDAO::showAll();


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

    <section class="finalizar-pagamento py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Finalizar Pagamento</h2>
            
            <!-- Resumo do Pedido -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Resumo do Pedido</h5>
                    <ul class="list-unstyled">
                        <li><strong>Itens:</strong> <?= $totalItens ?></li>
                        <li><strong>Total:</strong> R$ <?= number_format($totalPreco, 2, ',', '.') ?></li>
                        <li>
                            <strong>Frete:</strong>
                            <button type="button" class="btn btn-link p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                Consultar Frete
                            </button>
                            <!-- Dropdown de Endereços -->
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                        <i class="fas fa-plus me-2"></i>Adicionar Endereço
                                    </a>
                                </li>
                                <?php foreach ($enderecos as $endereco): ?>
                                    <li>
                                        <a class="dropdown-item" href="#" data-endereco="<?= $endereco['rua'] ?>">
                                           CEP : <?= $endereco['cep']?> ,RUA:<?= $endereco['rua']?> Nº<?= $endereco['numero']?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li><strong>Total a Pagar:</strong> R$ <?= number_format($totalPreco + 20, 2, ',', '.') ?></li>
                    </ul>
                </div>

                <!-- Informações de pagamento -->
                <div class="col-md-6 mt-4">
                    <h5>Forma de Pagamento</h5>
                    <form method="post" action="pagamentoProcess.php">
                        <input type="hidden" value="<?=$totalPreco?>" name="valorPagamento" id="">
                        <input type="hidden" value="<?=$usuarioId?>" name="usuarioId" id="">
                        <!-- Selecione o método de pagamento -->
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Selecione o Método de Pagamento</label>
                            <select class="form-select" id="paymentMethod" required>
                                <option value="" disabled selected>Escolha...</option>
                                <?php foreach ($tipos as $tipo): ?>
                                    <option name="tipoPagamento" value="<?= $tipo['tipoPagamento']?>" disabled selected><?= $tipo['tipoPagamento']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="shippingAddress" class="form-label"><strong>Frete</strong></label>
                            <select class="form-select" id="shippingAddress" required>
                                <option value="" disabled selected>Selecione um endereço...</option>
                                <?php foreach ($enderecos as $endereco): ?>
                                    <option value="<?= $endereco['idLogradouro'] ?>">
                                    CEP : <?= $endereco['cep']?> ,RUA:<?= $endereco['rua']?> Nº<?= $endereco['numero']?>
                                    </option>
                                <?php endforeach; ?>
                                <option value="novo">Adicionar novo endereço...</option>
                            </select>
                        </div>

<!-- 
                        Formulário de Cartão de Crédito
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
                        </div> -->

                        <!-- Formulário DuePay -->
                         
                        <div id="duepayForm" class="payment-method-form" class="payment-method-form">
                            <div class="mb-3">
                                <label for="duepayEmail" class="form-label">Número do Cartão DuePay</label>
                                <input type="text" name="email" class="form-control" id="duepayEmail" maxlength="40" placeholder="Seu número do cartao DuePay" required>
                            </div>
                            <div class="mb-3">
                                <label for="duepayTelefone" class="form-label">Telefone(Contato)</label>
                                <input type="text" name="telefone" class="form-control"  id="telefone" placeholder="DDDXXXXXXXX" maxlength="11" >
                                
                            </div>
                            <div class="mb-3">
                                <label for="duepayPassword" class="form-label">Cpf do Titular do beneficio</label>
                                <input type="text" name="senha" class="form-control" id="duepayPassword" maxlength="11" placeholder="Seu cpf do titular DuePay" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary">Voltar</button>
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Finalizar Pagamento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Adicionar Endereço -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressModalLabel">Adicionar Novo Endereço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
            <form id="newAddressForm" method="post" action="enderecoProcess.php">
            <input type="hidden" name="idUsuario" value="<?= $authUsuario['id']?>">
                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                </div>
                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                </div>
                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                </div>
                <div class="mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
                <div class="mb-3">
                    <label for="RUA" class="form-label">RUA</label>
                    <input type="text" class="form-control" id="RUA" name="RUA" required>
                </div>
                <div class="mb-3">
                    <label for="newFreteValue" class="form-label">Valor do Frete (R$)</label>
                </div>
                <p id="totalCompra" data-valor="100.00"><strong>Total: Será calculado após confirmar o pagamento</strong></p>

                <button type="submit" class="btn btn-primary">Salvar Endereço</button>
            </form>

            </div>
        </div>
    </div>
</div>


    <!-- Modal de Confirmação -->
    <!-- <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
    </div> -->

    <!-- Footer -->
    <?php include('../../components/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <!-- Script para controlar o formulário de pagamento e endereços -->
    <script>
        // Alternar entre formulários de pagamento
        document.getElementById('paymentMethod').addEventListener('change', function() {
            const selectedMethod = this.value;
            const creditCardForm = document.getElementById('creditCardForm');
            const duepayForm = document.getElementById('duepayForm');

            if (selectedMethod === 'cartao') {
                creditCardForm.style.display = 'block';
                duepayForm.style.display = 'none';
            } else if (selectedMethod === 'duepay') {
                creditCardForm.style.display = 'none';
                duepayForm.style.display = 'block';
            }
        });

        // Adicionar novo endereço
        document.getElementById('addAddressForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const newAddress = document.getElementById('newAddress').value;

            if (newAddress) {
                // Aqui você pode adicionar o endereço ao banco de dados ou à lista de endereços
                alert(`Endereço "${newAddress}" adicionado com sucesso!`);
                // Fechar o modal
                bootstrap.Modal.getInstance(document.getElementById('addAddressModal')).hide();
            }
        });

        // Confirmar pagamento
        document.getElementById('confirmPayment').addEventListener('click', function() {
            alert('Pagamento concluído com sucesso!');
            bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
        });
    </script>
    <script>
        document.getElementById("cep").addEventListener("blur", function () {
    let cep = this.value.replace(/\D/g, ""); // Remove caracteres não numéricos

    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById("bairro").value = data.bairro;
                    document.getElementById("cidade").value = data.localidade;
                    document.getElementById("estado").value = data.uf;
                } else {
                    alert("CEP não encontrado!");
                }
            })
            .catch(error => console.error("Erro ao buscar CEP:", error));
    } else {
        alert("CEP inválido! Digite um CEP válido.");
    }
});

    </script>
<script>
    document.getElementById('shippingAddress').addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];

        if (this.value === 'novo') {
            // Abre o modal para adicionar um novo endereço
            let addAddressModal = new bootstrap.Modal(document.getElementById('addAddressModal'));
            addAddressModal.show();
            this.value = ''; // Reseta o select para evitar problemas
        } else {
            // Atualiza o valor do frete e o total a pagar
            let valorFrete = parseFloat(selectedOption.getAttribute('data-valor'));
            let totalAtual = parseFloat(document.getElementById('totalCompra').getAttribute('data-valor'));

            let novoTotal = totalAtual + valorFrete;
            document.getElementById('totalCompra').innerText = "Total: R$ " + novoTotal.toFixed(2).replace('.', ',');
        }
    });


</script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-masker@1.1.2/lib/vanilla-masker.min.js"></script>
<script>
  const telefoneInput = document.getElementById('telefone');
  VMasker(telefoneInput).maskPattern('(99) 99999-9999');
</script>
</body>
</html>