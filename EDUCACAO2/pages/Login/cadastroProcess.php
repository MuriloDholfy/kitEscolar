<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../../dao/usuarioDao.php');
require_once(__DIR__ . '/../../model/usuarioModel.php');
require_once(__DIR__ . '/../../model/emailModel.php');
require_once(__DIR__ . '/../../dao/emailDao.php');
require(__DIR__ . '/../../lib/vendor/autoload.php');
require_once(__DIR__.'/../../model/conexao.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/usuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/emailModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/usuarioDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/emailDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'lib/vendor/autoload.php';

header('Content-Type: application/json');

$usuario = new UsuarioModel();
$mail = new PHPMailer(true);
$verificacaoEmailModel = new VerificacaoEmailModel();

    switch ($_POST["acao"]) {
        case 'ATUALIZAR':
           try{
            $usuario->setNomeUsuario($_POST['nomeUsuario']);
            $usuario->setEmailUsuario($_POST['emailUsuario']);
            $usuario->setSenhaUsuario($_POST['senhaUsuario']);

            usuarioDao::putUser($_POST["idUsuario"], $usuario);

            exit;
           }catch(PDOException $e){
            $_SESSION['erro'] = "Erro ao tentar atualizar o usuario";
            header("Location: Perfil/index.php");
              exit;
           }

        case 'SALVAR':
         if(!empty($_POST['senhaUsuario']) && $_POST['senhaUsuario'] === $_POST['csenhaUsuario']) {
           
            $usuario->setNomeUsuario($_POST['nomeUsuario']);
            $usuario->setEmailUsuario($_POST['emailUsuario']);
            $usuario->setSenhaUsuario($_POST['senhaUsuario']);

            $idUsuario = usuarioDao::createUser($usuario);

            if ($idUsuario) {
                $verificacaoEmailModel->setIdUsuario($idUsuario);
                $novoCodigo = rand(1000, 9999);
                $criadoEm = date('Y-m-d H:i:s');
                $novaExpiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $verificacaoEmailModel->setCodigoVerificacaoEmail($novoCodigo);
                $verificacaoEmailModel->setCriadoEm($criadoEm);
                $verificacaoEmailModel->setExpiradoEm($novaExpiracao);
                $conexao = Conexao::conexaoBanco_de_Dados();
                $verificacaoEmailDAO = new VerificacaoEmailDAO($conexao);
                $verificacaoEmailDAO->create($verificacaoEmailModel);

                // Envio do e-mail
                
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'darkp331@gmail.com';
                $mail->Password = 'h i o c y p w t e q v o j a n f';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('darkp331@gmail.com', 'Kit Escolar');
                $mail->addAddress($_POST['emailUsuario'], $_POST['nomeUsuario']);
                $mail->isHTML(true);
                $mail->Subject = 'Confirme seu email';
                $mail->Body ='Prezado <b>' . $_POST['nomeUsuario'] . '</b>, use o código <b>' . $novoCodigo . '</b> para verificar sua conta. 
                               Clique aqui: <a href="http://localhost/kitEscolar/EDUCACAO2/pages/Login/modalCodigo.php">Verificar</a>';
                $mail->AltBody = 'Código: ' . $novoCodigo;
                $mail->send();
                    $_SESSION['idUsuario'] = $idUsuario;
                    header("Location: modalCodigo.php");
                    exit;
            } else {
                $_SESSION['erro'] = "Erro ao tentar cadastrar o usuario";
                header("Location: cadastro.php");
                  exit;
            }
        }
        else{
            $_SESSION['erro'] = "Senhas não coincidem";
            header("Location: cadastro.php");
              exit;
        }
    }

    

  
       
    