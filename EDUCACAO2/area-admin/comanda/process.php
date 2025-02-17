<?php
  require_once (__DIR__.'/../../dao/comandaDAO.php');
  require_once (__DIR__.'/../../dao/comandaProdutoDAO.php');
  require_once (__DIR__.'/../../dao/produtoDAO.php');
  require_once (__DIR__.'/../../model/comandaModel.php');
  require_once (__DIR__.'/../../model/produtoModel.php');

  $comandaDAO = new ComandaDAO();
 
 switch ($_POST["acao"]) {

  case 'ATUALIZAR':
    var_dump($_POST);
        try {
          $comanda = new ComandaModel();
          $produto = new ProdutoModel();
          $idPagamento = $_POST['idPagamento'];
          $comanda->setIdPagamento($idPagamento);
          $comanda->setStatusComanda($_POST["statusComanda"]);
          $comanda->setIdPagamento($_POST["idPagamento"]);
          $idProduto = ComandaProdutoDAO::getIdProduto($_POST["idUser"]);
          $qtdProduto = ComandaProdutoDAO::getQtdProduto($_POST["idUser"]);
          $qtdAtual = ProdutoDAO::showByIdQuantidade($idProduto);
          $novaQtd = $qtdAtual-$qtdProduto[0]['quantidade'];
          
          ProdutoDAO::updateqtdProduto($novaQtd,$idProduto);
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