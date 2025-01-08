<?php
    require_once(__DIR__.'/../model/conexao.php');



    class LogradoroDAO{

        public static function createLogradoro($logradouroUser){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query =    "INSERT INTO
                        tbLogradoroUsuario(idUsuario,ruaLogrado,numeroLogrado,bairroLogrado,cidadeLogrado,estadoLogrado,cepLogrado,complementoLogrado)
                        values(?,?,?,?,?,?,?,?)";    
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$logradouroUser->getId());
            $stmt ->bindValue(2,$logradouroUser->getRuaLogrado());
            $stmt ->bindValue(3,$logradouroUser->getNumeroLogrado());
            $stmt ->bindValue(4,$logradouroUser->getBairroLogrado());
            $stmt ->bindValue(5,$logradouroUser->getCidadeLogrado());
            $stmt ->bindValue(6,$logradouroUser->getEstadoLogrado());
            $stmt ->bindValue(7,$logradouroUser->getCepLogrado());
            $stmt ->bindValue(8,$logradouroUser->getComplementoLogrado());
            return $stmt -> execute();
        }
        public static function putUser($id,$user){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "UPDATE tbUsuario SET
             nomeUsuario = ?,
             emailUsuario = ?,
             senhaUsuario = ?
             WHERE id = ?";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$user->getNomeUsuario());
            $stmt ->bindValue(2,$user->getEmailUsuario());
            $stmt ->bindValue(3,$user->getSenhaUsuario());
            $stmt ->bindValue(4 ,$id);
            return $stmt -> execute();
        }
    }

?>