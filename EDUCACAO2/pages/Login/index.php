<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Loja online de materiais escolares com uma ampla variedade de produtos">
    <meta name="author" content="Sua Loja">
    <title>Loja de Material Escolar</title>

    <!-- Link para o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="../../img/Cabeçalho.svg">
    <link href="../../css/loginStyle.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Estilo para a seta dentro de um círculo */
        .circle-back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background-color: transparent; /* Fundo branco */
            border: 2px solid #000; /* Borda preta */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            z-index: 10;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .circle-back-button i {
            color: #000; /* Ícone preto */
            font-size: 24px;
        }

        .circle-back-button:hover {
            background-color: #eda225; /* Fundo cinza claro no hover */
            border: 2px solid #eda225; /* Borda preta */
        }
        .circle-back-button i:hover{
            color: #fff; /* Ícone preto */
            font-size: 24px;
        }
    </style>
</head>
<body>
    <!-- Seta de Voltar -->
    <a href="../Home/" class="circle-back-button" aria-label="Voltar para a página anterior">
        <i class="bi bi-arrow-left"></i> <!-- Bootstrap Icon -->
    </a>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="">
                <h1>Criar Conta</h1>
                <span>ou use seu e-mail para se registrar</span>
                <input type="text" placeholder="Nome" required/>
                <input type="email" placeholder="E-mail" required/>
                <input type="password" placeholder="Senha" required/>
                <a href="#" data-bs-toggle="modal" data-bs-target="#verificationModal">
                    <button class="btn-2" type="button">Cadastrar</button>
                </a>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="../Perfil/">
                <h1>Entrar</h1>
                <span>ou use sua conta</span>
                <input type="email" placeholder="E-mail" required/>
                <input type="password" placeholder="Senha" required/>
                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Esqueceu sua senha?</a>
                <button class="btn-1">Entrar</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bem-vindo de Volta!</h1>
                    <p>Para continuar conectado conosco, faça login com suas informações pessoais</p>
                    <button class="ghost" id="signIn">Entrar</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Olá, Amigo!</h1>
                    <p>Insira seus dados pessoais e comece sua jornada conosco</p>
                    <button class="ghost" id="signUp">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    // Função para abrir o modal de verificação (corrigido)
    document.querySelector('.btn-2').addEventListener('click', function() {
        // Abrir o modal de verificação após o clique
        var verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
        verificationModal.show();
    });

    // Função para verificar o código de verificação
    document.getElementById('verifyButton').addEventListener('click', function() {
        const verificationCode = document.getElementById('verificationCode').value;
        if (verificationCode === '123456') {  // Código simulado
            alert("Código verificado com sucesso!");
            $('#verificationModal').modal('hide');
        } else {
            alert("Código inválido!");
        }
    });
    // Função para fechar o modal quando clicar fora
    var verificationModalElement = document.getElementById('verificationModal');
    var modal = new bootstrap.Modal(verificationModalElement);

    // Verificar se o clique foi fora do modal
    verificationModalElement.addEventListener('click', function (event) {
        // Verifica se o clique foi fora do conteúdo do modal
        if (!event.target.closest('.modal-content')) {
            modal.hide();  // Fecha o modal
        }
    });

</script>

</body>
</html>

<!-- Modal Esqueceu a Senha -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form>
                    <p class="text-start">Por favor, insira o seu e-mail abaixo para receber as instruções de recuperação de senha.</p>

                    <div class="mb-3 text-start">
                        <label for="emailInput" class="form-label">E-mail</label>
                        <input type="email" class="form-control w-100" id="emailInput" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="mb-3 text-start">
                        <button class="btn-1 w-100">Enviar Instruções</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Código de Verificação -->
<div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalLabel">Código de Verificação Enviado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p class="text-start">Enviamos um código de verificação para o seu e-mail. Por favor, insira o código abaixo:</p>

                <div class="mb-3 text-start">
                    <label for="verificationCode" class="form-label">Código de Verificação</label>
                    <input type="text" class="form-control w-100" id="verificationCode" placeholder="Digite o código" required>
                </div>

                <div class="mb-3 text-start">
                    <a href="../Home/index.php" data-bs-toggle="modal" data-bs-target="#verificationModal">
                        <button class="btn-1 w-100" id="verifyButton">Verificar Código</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script do Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
