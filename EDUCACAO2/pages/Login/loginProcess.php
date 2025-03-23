<?php
require_once (__DIR__.'/../../dao/usuarioDao.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/usuarioDao.php';

$usuario = usuarioDao::checkCredentials($_POST['emailUsuario'], $_POST['senhaUsuario']);



if($usuario){
    $authUsuario = [
        'id' => $usuario['idUsuario'],
        'nome' => $usuario['nomeUsuario'],
        'email' => $usuario['emailUsuario'],
        'senha' => $usuario['senhaUsuario'],

    ];
        session_start();
        $_SESSION["authUsuario"] = $authUsuario;
        header("Location: ../Home/index.php");

}else{
        header("Location: index.php");  

}



?>