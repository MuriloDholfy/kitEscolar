<?php
require_once(__DIR__.'/../../model/conexao.php');
require_once(__DIR__ . '/../../model/comandaModel.php');
require_once(__DIR__ . '/../../model/comandaProdutoModel.php');
require_once(__DIR__ . '/../../dao/comandaDAO.php');
require_once(__DIR__ . '/../../dao/comandaProdutoDAO.php');



$comanda = new ComandaModel();
$comandaProduto = new ComandaProdutoModel();

try {
    
    $comanda->setIdUsuario($_POST['idUsuario']);
    $comanda->setStatusComanda("Em andamento");
    $comanda->setCriadoEm(date('Y-m-d H:i:s'));
    $idComanda = ComandaDAO::createComanda($comanda);

    if($idComanda){
        $comandaProduto->setIdComanda($idComanda);
        $comandaProduto->setIdProduto($_POST['idProduto']);
        $comandaProduto->setQuantidade($_POST['quantidadeProduto']);
        $comandaProduto->setPreco($_POST['precoProduto']);
        $comandaProduto->setTotal($comandaProduto->calcularTotal());
        
         ComandaProdutoDAO::createComandaProduto($comandaProduto);
    }
        $response = [
            'success' => true,
            'message' => 'Comanda realizada com sucesso! Verifique seu e-mail.'
        ];
            header("Location: ../Pagamento/index.php");
            exit;

           
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Erro: ' . $e->getMessage()
    ];
    echo json_encode($response);
    exit;
}