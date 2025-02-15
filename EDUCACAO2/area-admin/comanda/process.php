<?php
  require_once (__DIR__.'/../../dao/comandaDAO.php');
  require_once (__DIR__.'/../../model/comandaModel.php');

  $comandaDAO = new ComandaDAO();
 
 switch ($_POST["acao"]) {

  case 'ATUALIZAR':

        try {
          $comanda = new ComandaModel();
          $comanda->setIdPagamento($idPagamento);
          $comanda->setStatusComanda($_POST["statusComanda"]);
          $comanda->setIdPagamento($_POST["idPagamento"]);
          $resultado = ComandaDAO::updateComandaNoId($_POST["idUser"], $comanda);
          header("Location: index.php");
        } catch (Exception $e) {
         echo 'Exceção capturada: ',  $e->getMessage(), "\n";

        } 
    break;

    case 'SELECTID':

      try {
          $comandaDAO = ComandaDAO::showById($_POST['id']);
          include('register.php');
      } catch (Exception $e) {
          echo 'Exceção capturada: ',  $e->getMessage(), "\n";
      } 
  
    
      break;
  


  }




 

?>