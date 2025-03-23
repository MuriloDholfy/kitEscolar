<?php
 
  
    require_once(__DIR__.'/../../model/conexao.php');
    require_once(__DIR__ . '/../../model/usuarioModel.php');
    require_once(__DIR__ . '/../../dao/usuarioDao.php');
    require_once(__DIR__ . '/../../model/esqueceuSenhaModel.php');
    require_once(__DIR__ . '/../../dao/esqueceuSenhaDAO.php');
         
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/conexao.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/usuarioModel.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/esqueceuSenhaModel.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/usuarioDao.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/esqueceuSenhaDAO.php';


    var_dump($_POST);
    session_start();
    $idUsuario = $_SESSION['idUsuario'] ;
    var_dump($_SESSION);
    var_dump($idUsuario);


    $usuarioModel = new UsuarioModel();
    $esqueceuSenha = new EsqueceuSenhaModel();
    $esqueceuSenhaDAO = new EsqueceuSenhaDAO();
    
    $getCodigoCorreto = $esqueceuSenhaDAO->getByCodigo($idUsuario);
        try {
            
        if($_POST['senhaUsuario'] === $_POST['cSenhaUsuario']){
            $novaSenha = $_POST['senhaUsuario'];
            if (UsuarioDAO::putSenha( $novaSenha, $idUsuario)) {
                echo "Email verificado com sucesso!";
                header("Location: index.php");
            } else {
                echo "Senha não são iguais";
            }
        }

         } catch (Exception $e) {
            // echo "Código de verificação inválido!";
            header("Location: index.php");
            unset($_SESSION['idUsuario']);
            session_destroy();
             echo "Erro: " . $e->getMessage();
         }
?>