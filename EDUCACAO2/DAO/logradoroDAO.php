<?php
    require_once(__DIR__.'/../model/conexao.php');



    class LogradoroDAO{

        public static function createLogradoro($logradouroUser){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query =    "INSERT INTO
                        tbLogradouro(cep,numero,bairro,cidade,estado,rua)
                        values(?,?,?,?,?,?)";    
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$logradouroUser->getCepLogrado());
            $stmt ->bindValue(2,$logradouroUser->getNumeroLogrado());
            $stmt ->bindValue(3,$logradouroUser->getBairroLogrado());
            $stmt ->bindValue(4,$logradouroUser->getCidadeLogrado());
            $stmt ->bindValue(5,$logradouroUser->getEstadoLogrado());
            $stmt ->bindValue(6,$logradouroUser->getRuaLogrado());
            if ($stmt->execute()) {
                return $conexao->lastInsertId();
            }else{
                 throw new Exception("Erro ao inserir usuário: " . implode(", ", $stmt->errorInfo()));
            }
        }
        
        
       
    }

?>