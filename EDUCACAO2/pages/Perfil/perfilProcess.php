<?php
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
require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/emailDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'lib/vendor/autoload.php';


header('Content-Type: application/json');

$usuario = new UsuarioModel();
$mail = new PHPMailer(true);

switch ($_POST["acao"]) {
    case 'ATUALIZAR':
        session_start();
        $idUsuario = $_POST['idUsuario'];
        $usuarioDAO = UsuarioDAO::showById($idUsuario);
        $usuarioDados = $usuarioDAO[0]; 
        
        // Mantém os dados antigos caso os campos estejam vazios
        $novoNome = !empty($_POST['nomeUsuario']) ? $_POST['nomeUsuario'] : $usuarioDados['nomeUsuario'];
        $novoEmail = !empty($_POST['emailUsuario']) ? $_POST['emailUsuario'] : $usuarioDados['emailUsuario'];
        $novaDataNasc = !empty($_POST['dataNascUsuario']) ? $_POST['dataNascUsuario'] : $usuarioDados['nascimentoUsuario'];

        // Verifica se o usuário quer alterar a senha
        if (!empty($_POST['novaSenhaUsuario']) && !empty($_POST['cNovaSenhaUsuario'])) {
            if ($_POST['novaSenhaUsuario'] === $_POST['cNovaSenhaUsuario']) {
                if ($usuarioDados['senhaUsuario'] === $_POST['senhaAtual']) { // Verifica senha atual
                    $novaSenha = password_hash($_POST['novaSenhaUsuario'], PASSWORD_DEFAULT); // Hash da nova senha
                } else {
                    $_SESSION['erro'] = "Senha atual inválida";
                    header("Location: index.php");
                    exit;
                }
            } else {
                $_SESSION['erro'] = "Senhas não coincidem";
                header("Location: index.php");
                exit;
            }
        } else {
            // Se o usuário não alterou a senha, mantém a senha antiga
            $novaSenha = $usuarioDados['senhaUsuario'];
        }

        // Atualiza os valores no objeto do usuário
        $usuario->setNomeUsuario($novoNome);
        $usuario->setEmailUsuario($novoEmail);
        $usuario->setDataNascimento($novaDataNasc);
        $usuario->setSenhaUsuario($novaSenha);
        $usuario->setImagemUsuario($usuario->salvarImagemUsuario($_POST['nomeFoto']));

        UsuarioDao::putUser($idUsuario, $usuario);
        
        header("Location: ../Perfil/index.php");          
        exit;
}
    
