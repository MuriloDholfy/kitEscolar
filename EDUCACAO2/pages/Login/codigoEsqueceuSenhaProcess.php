<?php
    session_start();
    if (!isset($_SESSION['idUsuario'])) {
        echo "ID do usuário não encontrado. Tente novamente.";
        exit;
    }
    require_once(__DIR__.'/../../model/conexao.php');
    require_once(__DIR__ . '/../../model/usuarioModel.php');
    require_once(__DIR__ . '/../../dao/usuarioDao.php');
    require_once(__DIR__ . '/../../model/esqueceuSenhaModel.php');
    require_once(__DIR__ . '/../../dao/esqueceuSenhaDAO.php');
         
    
    
    
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

        // try {
        //     // Atualiza o status de verificação do e-mail
        //     if (UsuarioDAO::putCheckEmail($idUsuario)) {
        //         echo "Email verificado com sucesso!";
        //     } else {
        //         echo "Erro ao atualizar o status de verificação.";
        //     }
        echo "entrei no if";
        // } catch (Exception $e) {
        //     echo "Erro: " . $e->getMessage();
        // }
    
        // Limpa a sessão
        unset($_SESSION['idUsuario']);
        session_destroy();
        header("Location: index.php");
    } else {
        echo "Código de verificação inválido!";
    }





  



    
?>