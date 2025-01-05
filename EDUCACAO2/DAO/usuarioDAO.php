<?php
    require_once(__DIR__.'/../model/conexao.php');
    require_once(__DIR__.'/../model/testconexao.php');

    class UsuarioDAO{

        public static function createUser($user){
            //realiza a conexão com banco de dados 
            $conexao = new Conexao;
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "INSERT INTO tbUsuario(nomeUsuario,emailUsuario,senhaUsuario) values(?,?,?)";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$user->getNomeUsuario());
            $stmt ->bindValue(2,$user->getEmailUsuario());
            $stmt ->bindValue(3,$user->getSenhaUsuario());
            return $stmt -> execute();
        }

        public static function showById($id){
            //realiza a conexão com banco de dados 
            $conexao = new Conexao;
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "SELECT * FROM tbUsuario WHERE id = ? ";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$id);
            return $stmt -> execute();
        }   

        public static function showAll(){
            //realiza a conexão com banco de dados 
            $conexao = new Conexao;
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "SELECT * FROM tbUsuario";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt -> execute();
            return $stmt->fetchAll();
        }

        public static function putUser($id,$user){
            //realiza a conexão com banco de dados 
            $conexao = new Conexao;
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

        public static function deleteUser($id){
                 //realiza a conexão com banco de dados 
                 $conexao = new Conexao;
                 //QUErty do banco de dados sendo preparads para ser executado no banco
                 $query = "DELETE FROM tbUsuario WHERE id = ? ";
                 $stmt = $conexao->prepare(query: $query);
                 //valores sendo vinculados aos parametros nas cosnsultas 
                 $stmt ->bindValue(1,$id);
                 return $stmt -> execute();
        }




        public static function checkCredentials($email, $senha){
            $conexao = Conexao::conectar();
            $query = "SELECT * FROM user WHERE emailUser = ? and passwordUser = ?";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $senha);
            $stmt->execute();
                if($stmt->rowCount()>0){
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                } 
                else{
                echo "CREDENCIAIS INVALIDAS";
                }   
          
          
        }

    }

?>