<?php
      if(!isset($_SESSION)) {
        session_start();
        $authADM = $_SESSION["authADM"];
        
    }
    
    
    
    if(!isset($authADM['id'])) {
        header("location:../../area-admin/login/login.php");
    }
    require_once (__DIR__.'../../../DAO/comandaDAO.php'); 
    $comandas = ComandaDAO::showAll();
    
  ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KitEscolar - Adm</title>
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
        <div class="row align-items-center mb-4">
          <div class="col fs-3 fw-semibold">
            Lista de Usuário
          </div>
        </div>
        <div class=" row">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="col-md-1 text-center">idComanda</th>
                <th class="col-md-1 text-center">Nome Usuario</th>
                <th class="col-md-1 text-center">idPagamento </th>
                <th class="col-md-2 text-center">criado_em</th>
                <th class="col-md-3 text-center">statusComanda</th>
                <th class="text-center col-md-1">Alterar</th>
              </tr>
              <?php foreach($comandas as $comanda) { ?>
              <tr>
                <td class="text-center"><?=$comanda["idComanda"]?></td>
                <td class="text-center"1><?= $comanda['idUsuario']  ?></td>
                <td class="text-center"><?=$comanda['idPagamento']?></td>
                <td class="text-center"><?=$comanda['criado_em']?></td>
                <td class="text-center"><?=$comanda['statusComanda']?></td>
                <td class="text-center">
                  <form action="process.php" method="POST">
                    <input type="hidden" class="form-control" id="acao" name="acao" value="SELECTID">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?=$comanda["idComanda"]?>">
                    <button type="submit" class="dropdown-item" ><i
                        class="fas fa-edit fa-lg text-secondary"></i>
                    </button>
                  </form>
                </td>
              <tr>
                <?php } ?>
            </thead>
            <tbody>
            </tbody>
          </table>
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
  <script type="text/javascript" src="./../../js/modal.js"></script>
  <script src="./../../js/personalizar.js"></script>
</body>

</html>