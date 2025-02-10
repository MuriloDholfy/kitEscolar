<?php
require_once (__DIR__.'/../../dao/admDAO.php');

var_dump($_POST);
$usuario = admDAO::checkCredentials($_POST['emailUsuario'], $_POST['senhaUsuario']);
var_dump($usuario);

if($usuario){
    $authADM = [
        'id' => $usuario['idAdm'],
        'nome' => $usuario['nomeAdm'],
        'email' => $usuario['emailAdm'],
        'senha' => $usuario['senhaAdm'],
        'img' => $usuario['imgAdm']

    ];
        session_start();
        $_SESSION["authADM"] = $authADM;
        header("Location: ../home/index.php");

}else{
        header("Location: login.php=error");  

}



?>