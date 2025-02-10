<?php
require_once(__DIR__ . '/../../dao/logradoroDAO.php');
require_once(__DIR__ . '/../../dao/usuarioDAO.php');
require_once(__DIR__ . '/../../model/logradoroModel.php');

try {
var_dump($_POST);
if (!empty($_POST)) {
    // Criando objeto do logradouro
    $logradouro = new LogradouroModel();
    $logradouro->setCepLogrado($_POST["cep"]);
    $logradouro->setNumeroLogrado($_POST["numero"]);
    $logradouro->setBairroLogrado($_POST["bairro"]);
    $logradouro->setCidadeLogrado($_POST["cidade"]);
    $logradouro->setEstadoLogrado($_POST["estado"]);
    $logradouro->setRuaLogrado($_POST["RUA"]); // ou $_POST["rua"], dependendo do nome correto

    // Criando logradouro no banco e pegando ID gerado
    $idLogradouro = LogradoroDAO::createLogradoro($logradouro);
    var_dump($idLogradouro);
    // Atualizando usuário com o novo logradouro
    UsuarioDAO::putUserLogradoro($_POST["idUsuario"], $idLogradouro);
    header("Location: ../Pagamento/index.php");
}
           
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Erro: ' . $e->getMessage()
    ];
    echo json_encode($response);
    header("Location: ../Pagamento/index.php");
    exit;
}