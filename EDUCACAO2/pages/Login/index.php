<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login para acessar sua conta">
    <title>Login - Loja de Material Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6c63ff, #ab47bc);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
    <div class="card">
        <h2 class="text-center mb-4">Login</h2>
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
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
                            <button type="button" class="btn btn-primary w-100">Enviar Instruções</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
