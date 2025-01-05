<?php
    require_once(__DIR__.'/../model/conexao.php');

    class UsuarioDAO{

        public static function createUser($user){
            $conexao = new Conexao;
            $conexao = Conexao::conexaoBanco_de_Dados();
            $cmdSql = "INSERT INTO tbUsuario(nomeUsuario,emailUsuario,senhaUsuario) values(?,?,?)";
            $stmt = $conexao->prepare($cmdSql);
            $stmt ->bindValue(1,$user->getNomeUsuario());
            $stmt ->bindValue(2,$user->getEmailUsuario());
            $stmt ->bindValue(3,$user->getSenhaUsuario());
            $stmt -> execute();

        }
    }

?>