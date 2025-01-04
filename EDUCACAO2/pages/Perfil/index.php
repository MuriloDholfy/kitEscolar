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

    <!-- Section de Perfil -->
    <section id="perfil" class="container my-5">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="https://via.placeholder.com/150" alt="Foto de Perfil" class="img-fluid rounded-circle mb-3">
                <h2>Nome do Usuário</h2>
                <p>Email: usuario@dominio.com</p>
                <p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">Editar Perfil</button>
                </p>
            </div>
            <div class="col-md-8">
                <h3>Informações Adicionais</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Saldo DuePlay</strong></td>
                            <td>5000pt</td>
                        </tr>
                        <tr>
                            <td><strong>Endereço</strong></td>
                            <td>Rua Exemplo, 123, Cidade, Estado</td>
                        </tr>
                        <tr>
                            <td><strong>Telefone</strong></td>
                            <td>(99) 99999-9999</td>
                        </tr>
                        <tr>
                            <td><strong>Data de Cadastro</strong></td>
                            <td>01/01/2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal de Edição de Perfil -->
    <div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarPerfilModalLabel">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de Edição -->
                    <form>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" value="Nome do Usuário">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" value="usuario@dominio.com">
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" value="(99) 99999-9999">
                        </div>
                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" value="Rua Exemplo, 123, Cidade, Estado">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="senha" placeholder="Nova senha (opcional)">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../../components/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
