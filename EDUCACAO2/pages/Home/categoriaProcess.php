<?php
  require_once (__DIR__.'/../../dao/ProdutoDAO.php');
  require_once (__DIR__.'/../../model/produtoModel.php');

  $produto = new ProdutoModel();

  
    try {

        $nomeProduto = ProdutoDAO::showByName($_POST['produto']);
        session_start();
        if(!empty($nomeProduto)){
            $_SESSION['produtos'] = $nomeProduto;
            header("Location: ../Produtos/totalProdutos.php");
        }
        else{
        
            $_SESSION['produtos'] = [];
            header("Location: ../Produtos/totalProdutos.php");
        }

        
    } catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    } 
?>