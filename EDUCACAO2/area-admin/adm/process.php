<?php
require_once __DIR__.'/../../dao/admDao.php';

require_once __DIR__.'/../../model/admModel.php';

 //require_once '../../model/Mensagem.php';

 $user = new AdmModel();
 //$msg = new Mensagem();

   


 switch ($_POST["acao"]) {
  case 'DELETE':
   try {
        $admDAO = AdmDAO::delete($_POST['idDeletar']);
        header("Location: index.php");
    } catch (Exception $e) {
      echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
    break;

  case 'SALVAR':
    //pode validar as informações
    $user->setNome($_POST['nome']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['senha']);
    $user->setImagem($user->salvarImagem($_POST['nomeFoto'])); 
    $user->setToken($user->generateToken());
    
    try {
        $admDAO = admDAO::insert($user);
        header("Location: index.php");
      header("Location: index.php");
    } catch (Exception $e) {
     echo 'Exceção capturada: ',  $e->getMessage(), "\n";
      //header("Location: register.php");
    } 
    break;
  case 'ATUALIZAR':
        //pode validar as informações
        $user->setNome($_POST['nome']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['senha']);
        $user->setImagem($user->salvarImagem($_POST['nomeFoto'])); 
        $user->setToken($user->generateToken());
        try {
          $admDAO = admDAO::update($_POST["idUser"], $user);
          //$msg->setMensagem("Usuário Atualizado com sucesso.", "bg-success");
          header("Location: index.php");
          
        } catch (Exception $e) {
         echo 'Exceção capturada: ',  $e->getMessage(), "\n";

        } 
    break;

  case 'SELECTID':

    try {
        $admDAO = admDAO::selectById($_POST['id']);
        // Configura as opções do contexto da solicitação
        include('register.php');
    } catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    } 
    break;

  }
?>