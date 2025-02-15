<?php
require_once(__DIR__ . '/../../dao/comandaDAO.php');
require_once(__DIR__ . '/../../dao/comandaProdutoDAO.php');

try {

    if(!empty($_POST) && isset($_POST)){
         ComandaProdutoDAO::deleteComandaProduto($_POST["idComandaProduto"]);
         ComandaDAO::deleteComanda($_POST["idComanda"]);
    }
        $response = [
            'success' => true,
            'message' => 'Comanda deletada com sucesso!'
         ];
            header("Location: ../Carrinho/index.php");
            exit;

           
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Erro: ' . $e->getMessage()
    ];
    echo json_encode($response);
    exit;
}