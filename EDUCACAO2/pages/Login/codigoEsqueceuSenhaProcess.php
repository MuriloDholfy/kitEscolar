<?php
  
    require_once(__DIR__.'/../../model/conexao.php');
    require_once(__DIR__ . '/../../model/usuarioModel.php');
    require_once(__DIR__ . '/../../dao/usuarioDao.php');
    require_once(__DIR__ . '/../../model/esqueceuSenhaModel.php');
    require_once(__DIR__ . '/../../dao/esqueceuSenhaDAO.php');
         
    
    session_start();
    
    $idUsuario = $_SESSION['idUsuario']; 


    $usuarioModel = new UsuarioModel();
    $esqueceuSenha = new EsqueceuSenhaModel();
    $esqueceuSenhaDAO = new EsqueceuSenhaDAO();
    
    $getCodigoCorreto = $esqueceuSenhaDAO->getByCodigo($idUsuario);

    $codigoUsuarioPost = (int) $_POST['codigoVerificacaoUsuario'];
    $codigoCorreto = (int) $getCodigoCorreto['codigoSenhaReset'];



    var_dump($codigoUsuarioPost);
    
    var_dump($getCodigoCorreto);
    if($codigoUsuarioPost == $codigoCorreto) {

        try {
            header("Location: redefinirSenha.php");

         } catch (Exception $e) {
            echo "Código de verificação inválido!";
            //header("Location: index.php");
            unset($_SESSION['idUsuario']);
            session_destroy();
             echo "Erro: " . $e->getMessage();
         }
    
        // Limpa a sessão
    } else {
        echo "Código de verificação inválido!";
        header("Location: index.php");
        unset($_SESSION['idUsuario']);
        session_destroy();
    }

    
?>