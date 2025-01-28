<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../../dao/usuarioDao.php');
require_once(__DIR__ . '/../../model/usuarioModel.php');
require_once(__DIR__ . '/../../model/emailModel.php');
require_once(__DIR__ . '/../../dao/emailDao.php');
require(__DIR__ . '/../../lib/vendor/autoload.php');
require_once(__DIR__.'/../../model/conexao.php');
header('Content-Type: application/json');

$usuario = new UsuarioModel();
$mail = new PHPMailer(true);

  







try {
    switch ($_POST["acao"]) {
        case 'ATUALIZAR':
            $idUsuario = $_POST['idUsuario'];
        
            $usuarioDAO = UsuarioDAO::showById($idUsuario);
            
            if (isset($usuarioDAO[0])) {
                $usuarioDados = $usuarioDAO[0]; 
        
                // Mantém os dados antigos caso os campos estejam vazios
                $novoNome = !empty($_POST['nomeUsuario']) ? $_POST['nomeUsuario'] : $usuarioDados['nomeUsuario'];
                $novoEmail = !empty($_POST['emailUsuario']) ? $_POST['emailUsuario'] : $usuarioDados['emailUsuario'];
                $novaDataNasc = !empty($_POST['dataNascUsuario']) ? $_POST['dataNascUsuario'] : $usuarioDados['nascimentoUsuario'];
                $novaSenha = (!empty($_POST['novaSenhaUsuario']) && $_POST['novaSenhaUsuario'] === $_POST['cNovaSenhaUsuario']) 
                    ? $_POST['novaSenhaUsuario'] 
                    : $usuarioDados['senhaUsuario'];
        
                // Atualiza os valores no objeto do usuário
                $usuario->setNomeUsuario($novoNome);
                $usuario->setEmailUsuario($novoEmail);
                $usuario->setDataNascimento($novaDataNasc);
                $usuario->setSenhaUsuario($novaSenha);
                var_dump($_POST);
                $usuario->setImagemUsuario($usuario->salvarImagemUsuario($_POST['nomeFoto']));
  
        

                UsuarioDao::putUser($idUsuario, $usuario);
                echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
            }

            exit;

        case 'SALVAR':
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
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = 'a856dd4002ce23';
                $mail->Password = '82562668b21009';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 2525;

                $mail->setFrom('mateuss3553@gmail.com', 'Kit Escolar');
                $mail->addAddress($_POST['emailUsuario'], $_POST['nomeUsuario']);
                $mail->isHTML(true);
                $mail->Subject = 'Confirme seu email';
                $mail->Body = 'Prezado <b>' . $_POST['nomeUsuario'] . '</b>, use o código <b>' . $novoCodigo . '</b> para verificar sua conta. 
                               Clique aqui: <a href="http://localhost/kitEscolar/EDUCACAO2/pages/Login/modalCodigo.php">Verificar</a>';
                $mail->AltBody = 'Código: ' . $novoCodigo;

                $mail->send();

                $response = [
                    'success' => true,
                    'message' => 'Cadastro realizado com sucesso! Verifique seu e-mail.'
                ];
                session_start();
                    $_SESSION['idUsuario'] = $idUsuario;
                    header("Location: modalCodigo.php");
                    exit;

               
                exit;
            } else {
                throw new Exception('Erro ao salvar o usuário.');
            }
    }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Erro: ' . $e->getMessage()
    ];
    echo json_encode($response);
    exit;
}