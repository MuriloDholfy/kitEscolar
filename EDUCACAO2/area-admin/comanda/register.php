<?php 
session_start();

  require_once (__DIR__.'/../../dao/ProdutoDAO.php');
  $idProduto = $_GET['id'] ?? $_POST['id'] ?? null;
  $produtoDao = ProdutoDAO::showById($idProduto);
  if(!empty($_POST)){
    $idProduto = $produtoDao['idProduto'];
    $nomeProduto =  $produtoDao['nomeProduto'];
    $descricaoProduto = $produtoDao['descricaoProduto'];
    $valorProduto = $produtoDao['valorProduto'];
    $qtdProduto = $produtoDao['quantidadeProduto'];
    $imagemProduto = $produtoDao['imagemProduto'];
    }else{
      $nomeProduto = '';
      $descricaoProduto = '';
      $valorProduto = '';
      $qtdProduto = '';
      $imagemProduto = '';
      $idProduto = '';
    }


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FilmeOn - Adm</title>
  <link rel="short icon" href="./../../img/site/logo.png" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- icon -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> <!-- CSS Projeto -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body style="justify-content: center; align-items: center; height: 100vh ">
  <?php 
      include('./../../componentes/header-adm.php');
  ?>
  <div class="container-fluid" style="height: 90vh">
    <div class="row h-100">
      <?php 
      include('./../../componentes/menu-adm.php');
      ?>
      <div class="col-md-10  p-4 borber">
        <div class="card">
          <form method="post" action="process.php" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="card-header">
              <strong>INFORMAÇÕES DO USUÁRIO</strong>
              <input type="text" name="idUser" id="idUser" placeholder="id" value="<?=$idProduto?>">
              <input type="text" name="nomeFoto" id="nomeFoto" placeholder="nome foto" value="<?=$imagemProduto?>">
              <input type="text" value="<?=$idProduto?'ATUALIZAR':'SALVAR'?>" name="acao" >

            </div>
            <div class="card-body row" style="align-items: center; justify-content: center;">
              <div class="col-md-2   text-center" >
                <div class="bg-white rounded border" >
                <img id="imagemProduto" src="../../img/Produto/<?=$imagemProduto!="" ? $imagemProduto: 'padrao.png';?>" alt="..."
                    class="rounded  w-100  "  style="height:200px;object-fit: cover; border:4px solid #ccc;width:200px " >
                </div>
              </div>
              <div class=" col-md-10">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="nome" class="col-form-label">Nome Produto:</label>
                    <input type="text" class="form-control" name="nomeProduto" maxlength="50" id="nome" value="<?=$nomeProduto?>"
                      required>
                    <div class="invalid-feedback">
                      Nome Produto Inválido
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="sobrenome" class="col-form-label">Quantidade Produto:</label>
                    <input type="text" class="form-control" name="qtdProduto" maxlength="50" id="sobrenome"
                      value="<?=$qtdProduto?>" required>
                    <div class="invalid-feedback">
                    Quantidade Produto Inválido
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="cpf" class="col-form-label">Valor Produto:</label>
                    <input type="text" class="form-control" name="valorProduto" maxlength="50" id="cpf"
                      data-mask="000.000.000-00" data-mask-selectonfocus="true" value="<?=$valorProduto?>" required>
                    <div class="invalid-feedback">
                    Valor Produto Inválido
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label for="nasc" class="col-form-label">Descrição Produto:</label>
                    <input type="text" class="form-control" name="descProduto" id="nasc" value="<?=$descricaoProduto?>" required>
                    <div class="invalid-feedback">
                    Descrição Produto invalida
                    </div>
                </div>
                <div class="row mt-5 ">
                  <div class="col-md-2">
                    <input type="file" id="foto" name="fotoProduto" accept="image/*" class="custom-file-input">
                  </div>
                  <div class=" text-end  col-md-10">
                  <a class=" btn btn-primary px-3" role="button" aria-disabled="true" href="index.php">Voltar</i></a>
                  <input type="submit" class=" btn btn-success" value="Salvar">
                </div>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer>
  </script>
  <!-- Para usar Mascara  -->
  <script type="text/javascript" src="./../../js/jquery.mask.min.js"></script>
  <script type="text/javascript" src="./../../js/personalizar.js"></script>
  <script type="text/javascript" src="./../../js/modal.js"></script>
  <script>
    // Selecione o input de arquivo, a tag img e o campo nomeFoto
    const inputFoto = document.getElementById('foto');
    const imgUsuario = document.getElementById('imagemProduto');
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