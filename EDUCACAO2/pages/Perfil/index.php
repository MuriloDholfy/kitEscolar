<?php
    if(!isset($_SESSION)) {
        session_start();
        $authUsuario = $_SESSION["authUsuario"];
        
    }
    if(!isset($authUsuario['id'])) {
        header("location: ../Login/index.php");
    }
    
require_once(__DIR__ . '/../../dao/usuarioDao.php');
$authUsuario = $_SESSION["authUsuario"];
// var_dump($authUsuario);

$usuarioDAO = UsuarioDAO::showById($authUsuario["id"]);
if (isset($usuarioDAO[0])) {
    $usuarioDados = $usuarioDAO[0]; 
    $imagem_Usuario = $usuarioDados['imagemUsuario'];
}else{
    $imagem_Usuario = "";
}
var_dump($_SESSION);
if (isset($_SESSION['erro'])) {
    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['erro'] . "</p>";
    unset($_SESSION['erro']); // Remove o erro para não exibir novamente
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
    <?php   if(isset($_SESSION["authUsuario"])){
            $authUsuario = $_SESSION["authUsuario"];
            include('../../components/navBarLogado.php');//aqui é a verificação para ver se o usuario esta online
          }else{
            include('../../components/navBar.php');//aqui é a verificação para ver se o usuario esta off
          } ?> 

    <!-- Section de Perfil -->
    <section id="perfil" class="container my-5">
        <div class="row">
            <div class="col-md-4 text-center">
            <!-- Formulário de Edição -->
            <form method="POST" action="perfilProcess.php" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="idJogador" id="idJogador" placeholder="id" value="<?= $authUsuario["id"] ?>">
            <input type="hidden" name="nomeFoto" id="nomeFoto" placeholder="nome foto" value="<?=$imagem_Usuario?>">
            <input type="hidden" value="<?=$authUsuario["id"]?'ATUALIZAR':'SALVAR'?>" name="acao">
            <img id="imagemUsuario" src="../../img/Usuario/<?=$imagem_Usuario != "" ? $imagem_Usuario : 'padrao.jpg';?>"style="height:300px; object-fit:cover; border:4px solid #ccc; width:300px;" class="img-fluid rounded-circle mb-3">
            <input type="file" id="foto" name="fotoUsuario" accept="image/*" class="custom-file-input">
                
                
                <h2><?=$authUsuario['nome'] ?></h2>
                <p>Email: <?=$authUsuario['email'] ?></p>
                <p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">Editar Perfil</button>
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
                        <!-- <tr>
                            <td><strong>Endereço</strong></td>
                            <td>Rua Exemplo, 123, Cidade, Estado</td>
                        </tr> -->
                        <!-- <tr>
                            <td><strong>Telefone</strong></td>
                            <td>(99) 99999-9999</td>
                        </tr> -->
                        <tr>
                            <td><strong>Data de Nascimento</strong></td>
                            <td><?=$usuarioDados['nascimentoUsuario']?></td>
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
                 
                    <input type="hidden" name="idUsuario" placeholder="id" value="<?=$authUsuario['id']?>">
                    <input type="hidden" value="<?=$authUsuario?'ATUALIZAR':'SALVAR'?>" name="acao" >
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nomeUsuario" class="form-control" id="nome" value="<?=$authUsuario['nome'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="emailUsuario" class="form-control" id="email" value="<?=$authUsuario['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Data de Nascimento</label>
                            <input type="date" name="dataNascUsuario" class="form-control" id="email" value="<?=$authUsuario['email'] ?>">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" name="telefoneUsuario" class="form-control" id="telefone" value="<?=$authUsuario['telefone'] ?>">
                        </div> -->
                        <!-- <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text"  name="telefoneUsuario" class="form-control" id="endereco" value="<?=$authUsuario['nome'] ?>">
                        </div> -->
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha Atual</label>
                            <input type="password"  name="senhaAtual" class="form-control" id="senha" placeholder="Necessaria para atualizar os dados" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha"  class="form-label">Nova Senha</label>
                            <input type="password" name="novaSenhaUsuario" class="form-control" id="senha" placeholder="Nova senha (opcional)">
                        </div>
                        <div class="mb-3">
                            <label for="senha" name="telefoneUsuario" class="form-label">Nova Senha</label>
                            <input type="password" name="cNovaSenhaUsuario"class="form-control" id="senha" placeholder="Confirme sua nova senha ">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../../components/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
    // Selecione o input de arquivo, a tag img e o campo nomeFoto
    const inputFoto = document.getElementById('foto');
    const imgUsuario = document.getElementById('imagemUsuario');
    const nomeFoto = document.getElementById('nomeFoto'); // Campo de nome da imagem

    // Adicione um evento de mudança ao input de arquivo
    inputFoto.addEventListener('change', function(event) {
        const file = event.target.files[0]; // Obtenha o arquivo selecionado

        if (file) {
            const reader = new FileReader();

            // Quando a leitura do arquivo for concluída
            reader.onload = function(e) {
                imgUsuario.src = e.target.result; // Altere o src da imagem para o caminho local do arquivo
            };

            // Leia o arquivo como URL de dados
            reader.readAsDataURL(file);

            // Atualize o campo nomeFoto com o nome do arquivo
            nomeFoto.value = file.name; // Defina o valor do campo nomeFoto com o nome do arquivo
        }
    });
</script>



</body>
</html>
