<?php 
session_start();
if (!isset($_SESSION['idUsuario'])) {
    echo "ID do usuário não encontrado. Tente novamente.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<style>
    body {
        background: #f1f1f1;
    }
    .cadastro{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        margin: 0;
    }
    .card {
        width: 100%;
        max-width: 600px;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .btn-primary {
        background-color: #6c63ff;
        border-color: #6c63ff;
    }
    .btn-primary:hover {
        background-color: #5a55cc;
        border-color: #5a55cc;
    }
    a {
        text-decoration: none;
        color: #6c63ff;
    }
    a:hover {
        color: #5a55cc;
    }
</style>
</head>
<body>
 <!-- Modal de Verificação de E-mail -->
 <div class="modal fade" id="emailVerificationModal" tabindex="-1" aria-labelledby="emailVerificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailVerificationModalLabel">Verificação Para nova senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Um e-mail de verificação foi enviado para o endereço fornecido. Por favor, verifique sua caixa de entrada e siga as instruções para confirmar sua conta.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="openCodeModal">Inserir Código</button>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="codeVerificationModal" tabindex="-1" aria-labelledby="codeVerificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="codeVerificationModalLabel">Insira o Código de Verificação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="codigoEsqueceuSenhaProcess.php" id="codeForm">
                        <div class="mb-3 col-6">
                            <label for="verificationCode" class="form-label">Código de Verificação</label>
                            <input type="number" class="form-control" name="codigoVerificacaoUsuario" id="verificationCode" placeholder="Digite o código enviado" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Verificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Quando a página carregar, exibe o modal de verificação de e-mail automaticamente
        window.onload = function() {
            var emailVerificationModal = new bootstrap.Modal(document.getElementById('emailVerificationModal'));
            emailVerificationModal.show(); // Exibe o primeiro modal
        };

        document.getElementById("openCodeModal").addEventListener("click", function () {
            var emailVerificationModal = bootstrap.Modal.getInstance(document.getElementById('emailVerificationModal'));
            emailVerificationModal.hide(); // Fecha o primeiro modal

            var codeVerificationModal = new bootstrap.Modal(document.getElementById('codeVerificationModal'));
            codeVerificationModal.show(); // Exibe o segundo modal
        });

        // document.getElementById("codeForm").addEventListener("submit", function (e) {
        //     e.preventDefault(); // Impede o envio do formulário do código
        // });
    </script>
</body>
</html>