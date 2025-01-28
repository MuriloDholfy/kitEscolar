<?php
require_once (__DIR__.'/../../dao/usuarioDao.php');

var_dump($_POST);
$usuario = usuarioDao::checkCredentials($_POST['emailUsuario'], $_POST['senhaUsuario']);


if($usuario){
    $authUsuario = [
        'id' => $usuario['idUsuario'],
        'nome' => $usuario['nomeUsuario'],
        'email' => $usuario['emailUsuario'],
        'senha' => $usuario['senhaUsuario'],
        'img' => $usuario['imgUsuario']

    ];
        session_start();
        $_SESSION["authUsuario"] = $authUsuario;
        header("Location: ../home/index.php");

}else{
        header("Location: login.php=error");  

}



?>