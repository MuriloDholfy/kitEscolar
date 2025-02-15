<?php 
session_start();

  require_once (__DIR__.'/../../dao/comandaDAO.php');
  $idComanda = $_GET['id'] ?? $_POST['id'] ?? null;
  $comandaDAO = ComandaDAO::showById($idComanda);


  if(!empty($_POST)){

    $idUsuario = $comandaDAO['idUsuario'];
    $idPagamento =  $comandaDAO['idPagamento'];
    $criado_em = $comandaDAO['criado_em'];
    $statusComanda = $comandaDAO['statusComanda'];

    }else{

      $idPagamento = '';
      $criado_em = '';
      $statusComanda = '';
      $idUsuario = '';

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
        <div class="card r">
          <form method="post" action="process.php" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="card-header">
              <strong>INFORMAÇÕES DO USUÁRIO</strong>
              <input type="hidden" name="idUser" id="idUser" placeholder="id" value="<?=$idComanda?>">
              <input type="hidden" name="idPagamento" id="idPagamento" placeholder="idPagamento" value="<?=$idPagamento?>">
              <input type="hidden" value="<?=$idComanda?'ATUALIZAR':'SALVAR'?>" name="acao" >
            </div>
              <div class=" col-md-12">
                <div class="row">
                  <div class="col-md-6 mb-3 p-4">
                    <label for="nome" class="col-form-label">Horario da criação da comanda:</label>
                    <P><?= $criado_em?>"</P>
                  </div>
                  <div class="col-md-6  mb-3 p-4">
                    <label for="statusComanda" class="col-form-label">Status do Produto:</label>
                    <select class="form-control" name="statusComanda" id="statusComanda" required>
                      <option value="Aberto" <?=$statusComanda == 'Ainda não optou por pagar' ? 'selected' : ''?>>Ainda não optou por pagar</option>
                      <option value="Pendente de pagamento" <?=$statusComanda == 'Em Andamento' ? 'selected' : ''?>>Em Andamento</option>
                      <option value="Pagamento aprovado" <?=$statusComanda == 'Pagamento aprovado' ? 'selected' : ''?>>Pagamento aprovado</option>
                      <option value="Despachado" <?=$statusComanda == 'Despachado' ? 'selected' : ''?>>Despachado</option>
                      <option value="Entregue" <?=$statusComanda == 'Entregue' ? 'selected' : ''?>>Entregue</option>
                    </select>
                    <div class="invalid-feedback">
                      Status do Produto Inválido
                    </div>
                </div>
                <div class="row mt-5 ">
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
</body>

</html>