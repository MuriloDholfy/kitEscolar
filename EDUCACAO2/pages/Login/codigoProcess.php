<?php
    session_start();
    if (!isset($_SESSION['idUsuario'])) {
        echo "ID do usuário não encontrado. Tente novamente.";
        exit;
    }
    require_once(__DIR__.'/../../model/conexao.php');
    require_once(__DIR__ . '/../../model/usuarioModel.php');
    require_once(__DIR__ . '/../../model/emailModel.php');
    require_once(__DIR__ . '/../../dao/usuarioDao.php');
    require_once(__DIR__ . '/../../dao/emailDAO.php');
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/conexao.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/usuarioModel.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/emailModel.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/usuarioDao.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/emailDAO.php';

    
    
    $idUsuario = $_SESSION['idUsuario']; 


    $usuarioModel = new UsuarioModel();
    $emailModel = new VerificacaoEmailModel();
    $conexao = Conexao::conexaoBanco_de_Dados();
    $verificacaoEmailDAO = new VerificacaoEmailDAO($conexao);
    
    $getCodigoCorreto = $verificacaoEmailDAO->getByCodeUserId($idUsuario);

    $codigoUsuarioPost = (int) $_POST['codigoVerificacaoUsuario'];
    $codigoCorreto = (int) $getCodigoCorreto['codigoverificacaoEmail'];

    echo 'estou dps dos int';

    var_dump($codigoUsuarioPost);
    var_dump($getCodigoCorreto);
    if($codigoUsuarioPost == $codigoCorreto) {
        echo 'entrei no if';
        try {
            // Atualiza o status de verificação do e-mail
            if (UsuarioDAO::putCheckEmail($idUsuario)) {
                echo "Email verificado com sucesso!";
            } else {
                echo "Erro ao atualizar o status de verificação.";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    
        // Limpa a sessão
        unset($_SESSION['idUsuario']);
        session_destroy();
        header("Location: index.php");
    } else {
        echo "Código de verificação inválido!";
    }





  



    
?>