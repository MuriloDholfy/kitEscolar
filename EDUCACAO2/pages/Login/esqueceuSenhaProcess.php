<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(__DIR__ . '/../../lib/vendor/autoload.php');
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
require_once $_SERVER['DOCUMENT_ROOT'] . 'lib/vendor/autoload.php';


    $usuarioModel = new UsuarioModel();
    $esqueceuSenha = new EsqueceuSenhaModel();
    $esqueceuSenhaDAO = new EsqueceuSenhaDAO();
    $mail = new PHPMailer(true);
    $email = $_POST['emailUsuario'];
    $user = UsuarioDAO::getUserByEmail($email);
    $idUsuario = $user[0]['idUsuario'];

    if(isset($idUsuario)){
        $esqueceuSenha->setIdUsuario($idUsuario);
        $novoCodigo = rand(1000, 9999);
        $criadoEm = date('Y-m-d H:i:s');
        $novaExpiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $esqueceuSenha->setCodigoSenhaReset($novoCodigo);
        $esqueceuSenha->setCriadoEm($criadoEm);
        $esqueceuSenha->setExpiradoEm($novaExpiracao);
        $conexao = Conexao::conexaoBanco_de_Dados();
        $esqueceuSenhaDAO->createEsqueceuSenha($esqueceuSenha);

        // Envio do e-mail
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'darkp331@gmail.com';
        $mail->Password = 'h i o c y p w t e q v o j a n f';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('darkp331@gmail.com', 'Kit Escolar');
        $mail->addAddress($user[0]['emailUsuario'], $user[0]['nomeUsuario']);
        $mail->isHTML(true);
        $mail->Subject = 'Confirme seu email';
        $mail->Body ='Prezado <b>' . $user[0]['nomeUsuario'] . '</b>, use o código <b>' . $novoCodigo . '</b> para verificar sua conta. 
                       Clique aqui: <a href="http://localhost/kitEscolar/EDUCACAO2/pages/Login/modalCodigo.php">Verificar</a>';
        $mail->AltBody = 'Código: ' . $novoCodigo;

        $mail->send();

        $response = [
            'success' => true,
            'message' => 'Cadastro realizado com sucesso! Verifique seu e-mail.'
        ];
        session_start();
        $_SESSION['idUsuario'] = $idUsuario;
        session_write_close(); // Garante que a sessão seja escrita antes da redireção
        header("Location: modalCodigoEsqueceuSenha.php");
        exit;
    } else {
        throw new Exception('Erro ao salvar o usuário.');
    }
        
    
  








    // $codigoUsuarioPost = (int) $_POST['codigoVerificacaoUsuario'];
    // //$codigoCorreto = (int) $getCodigoCorreto['codigoverificacaoEmail'];



    // var_dump($codigoUsuarioPost);
    // // var_dump($getCodigoCorreto);

    // // if($codigoUsuarioPost == $codigoCorreto) {
    
    // //     echo "Entrei no if";
    // //     // try {
    // //     //     // Atualiza o status de verificação do e-mail
    // //     //     if (UsuarioDAO::putCheckEmail($idUsuario)) {
    // //     //         echo "Email verificado com sucesso!";
    // //     //     } else {
    // //     //         echo "Erro ao atualizar o status de verificação.";
    // //     //     }
    // //     // } catch (Exception $e) {
    // //     //     echo "Erro: " . $e->getMessage();
    // //     // }
    
    // //     // Limpa a sessão
    // //     // unset($_SESSION['idUsuario']);
    // //     // session_destroy();
    // //     // header("Location: index.php");
    // // } else {
    // //     echo "Código de verificação inválido!";
    // // }





  



    
?>