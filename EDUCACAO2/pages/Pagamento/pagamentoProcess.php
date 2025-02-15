<?php
require_once(__DIR__ . '/../../dao/pagamentoDAO.php');
require_once(__DIR__ . '/../../dao/comandaDAO.php');
require_once(__DIR__ . '/../../model/pagamentoModel.php');
require_once(__DIR__ . '/../../model/comandaModel.php');


    var_dump($_POST);
    if (!empty($_POST)) {
        // Buscar todas as comandas do usuário antes do loop
        $idsComandas = ComandaDAO::showByIdUseridComanda($_POST['usuarioId']);
        var_dump($idsComandas);

        foreach ($idsComandas as $comandaData) {
        
        
            $pagamento = new PagamentoModel();
            $pagamento->setValorPagamento($_POST["valorPagamento"]);
            $pagamento->setIdTipoPagamento(1);
            $pagamento->setEmailDuePay($_POST["email"]);
            $pagamento->setTelefoneDuePay($_POST["telefone"]);
            $pagamento->setSenhaDuePay($_POST["senha"]);
        
            $idPagamento = PagamentoDAO::createPagamento($pagamento);
        
           
           
        
            $comanda = new ComandaModel();
            $comanda->setIdPagamento($idPagamento);
            $comanda->setStatusComanda("Em andamento");
        
            $resultado = ComandaDAO::updateComandaNoId($comandaData["idComanda"], $comanda);
        
        }
        

        // Redirecionamento opcional
        header("Location: ../Pedidos/index.php");
        exit;
    }

?>
