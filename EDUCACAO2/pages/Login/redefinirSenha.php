
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
            max-width: 550px;
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
            <h2 class="text-center mb-4">Redefinir Senha</h2>
            <form method="POST" action="loginProcess.php">
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="senhaUsuario" placeholder="Digite sua senha" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="password" name="senhaUsuario" placeholder="Digite sua senha" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirmar Nova Senha</label>
                    <input type="password" class="form-control" id="password" name="senhaUsuario" placeholder="Digite sua nova senha" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            
            </form>
            <hr>
            <p class="text-center">Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
