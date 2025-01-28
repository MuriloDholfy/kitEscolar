<?php
  require_once (__DIR__.'/../../dao/ProdutoDAO.php');
  require_once (__DIR__.'/../../model/produtoModel.php');

  $produto = new ProdutoModel();
  var_dump($_POST);

 switch ($_POST["acao"]) {
  case 'DELETE':
   try {
        $produtoDAO = ProdutoDAO::deleteProduto($_POST['idDeletar']);
        header("Location: index.php");
    } catch (Exception $e) {
      echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
    break;

  case 'SALVAR':
    //pode validar as informações
   
    $produto->setNomeProduto($_POST['nomeProduto']);
    $produto->setQtdProduto($_POST['qtdProduto']);
    $produto->setValorProduto($_POST['valorProduto']);
    $produto->setDescricaoProduto($_POST['descProduto']);
    $produto->setImagemProduto($produto->salvarImagemProduto($_POST['nomeFoto'])); 
    try {
        $produtoDAO = ProdutoDAO::createProduto($produto);
      // header("Location: index.php");
    } catch (Exception $e) {
     echo 'Exceção capturada: ',  $e->getMessage(), "\n";
      // header("Location: register.php");
    } 
    break;



  case 'ATUALIZAR':
        //pode validar as informações
        $produto->setNomeProduto($_POST['nome']);
        $produto->setQtdProduto($_POST['sobrenome']);
        $produto->setValorProduto($_POST['cpf']);
        $produto->setDescricaoProduto($_POST['nasc']);
        $produto->setImagemProduto($produto->salvarImagemProduto($_POST['nomeFoto'])); 
        try {
          $userDao = ProdutoDAO::updateProduto($_POST["idUser"], $produto);
          header("Location: index.php");
          var_dump($_POST);
        } catch (Exception $e) {
         echo 'Exceção capturada: ',  $e->getMessage(), "\n";

        } 
    break;

  case 'SELECTID':

    try {
        $userDao = ProdutoDAO::showById($_POST['id']);
        include('register.php');
    } catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    } 

  
    break;


  }




 

?>