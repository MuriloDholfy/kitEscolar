
<!DOCTYPE html>
<html lang="pt-br">
<head>
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
    <style>
        body {
            background: #f1f1f1;
           
        }
        .login{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 400px;
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
<?php include('../../components/navBar.php'); ?>
    <section class="login">
        <div class="card">
            <h2 class="text-center mb-4">Login</h2>
            <form method="POST" action="loginProcess.php">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="emailUsuario" placeholder="Digite seu e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="senhaUsuario" placeholder="Digite sua senha" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
                <div class="text-center mt-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Esqueceu sua senha?</a>
                </div>
            </form>
            <hr>
            <p class="text-center">Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
    </section>
  
    <!-- Modal Esqueceu a Senha -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="esqueceuSenhaProcess.php">
                        <p class="text-start">Por favor, insira o seu e-mail abaixo para receber as instruções de recuperação de senha.</p>

                        <div class="mb-3 text-start">
                            <label for="emailInput" class="form-label">E-mail</label>
                            <input type="email" class="form-control w-100" id="emailInput" name="emailUsuario" placeholder="Digite seu e-mail" required>
                        </div>

                        <div class="mb-3 text-start">
                            <button type="submit" class="btn btn-primary w-100">Enviar Instruções</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
