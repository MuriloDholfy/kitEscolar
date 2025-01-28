<?php
    require_once(__DIR__.'/../model/conexao.php');

    class UsuarioDAO{
        private $conexao;
        
            public function __construct() {
                $this->conexao = Conexao::conexaoBanco_de_Dados();
                if (!$this->conexao) {
                    throw new Exception("Erro ao conectar ao banco de dados.");
                }
            }
        
        


        public static function createUser($usuario){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "INSERT INTO tbUsuario(nomeUsuario,emailUsuario,senhaUsuario) values(?,?,?)";
            $stmt = $conexao->prepare($query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$usuario->getNomeUsuario());
            $stmt ->bindValue(2,$usuario->getEmailUsuario());
            $stmt ->bindValue(3,$usuario->getSenhaUsuario());
            if ($stmt->execute()) {
                return $conexao->lastInsertId();
            }else{
                return throw new Exception("Erro ao inserir usuário: " . implode(", ", $stmt->errorInfo()));
            }
             
        }

        public static function showById($id){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "SELECT * FROM tbUsuario WHERE idUsuario = ? ";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$id);
            $stmt -> execute();
            return $stmt->fetchAll();
        }   
        public static function getUserByEmail($emailUsuario){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "SELECT * FROM tbUsuario WHERE emailUsuario = ? ";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$emailUsuario);
            $stmt -> execute();
            return $stmt->fetchAll();
        }   

        public static function showAll(){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "SELECT * FROM tbUsuario";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt -> execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function putUser($id,$usuario){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "UPDATE tbUsuario SET
             nomeUsuario = ?,
             emailUsuario = ?,
             senhaUsuario = ?,
             nascimentoUsuario = ?,
             imgUsuario = ?

             WHERE idUsuario = ?";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$usuario->getNomeUsuario());
            $stmt ->bindValue(2,$usuario->getEmailUsuario());
            $stmt ->bindValue(3,$usuario->getSenhaUsuario());
            $stmt ->bindValue(4,$usuario->getDataNascimento());
            $stmt ->bindValue(5,$usuario->getImagemUsuario());
            $stmt ->bindValue(6 ,$id);
            return $stmt -> execute();
        }

        public static function deleteUser($id){
                 //realiza a conexão com banco de dados 
                 $conexao = Conexao::conexaoBanco_de_Dados();
                 //QUErty do banco de dados sendo preparads para ser executado no banco
                 $query = "DELETE FROM tbUsuario WHERE id = ? ";
                 $stmt = $conexao->prepare(query: $query);
                 //valores sendo vinculados aos parametros nas cosnsultas 
                 $stmt ->bindValue(1,$id);
                 return $stmt -> execute();
        }

        public static function checkCredentials($email, $senha){
            $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "SELECT * FROM tbUsuario WHERE emailUsuario = ? and senhaUsuario = ? AND emailVerificadoUsuario    =1";
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

        public static function putCheckEmail($idUsuario){
           try{
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "UPDATE tbUsuario SET
             emailVerificadoUsuario = ?
             WHERE idUsuario = ?";
            $stmt = $conexao->prepare($query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,1);
            $stmt ->bindValue(2,$idUsuario);
            if ($stmt->execute()) {
                return true; // Sucesso ao atualizar o registro
            } else {
                // Lança uma exceção caso ocorra algum erro na execução
                throw new Exception("Erro ao atualizar o usuário: " . implode(", ", $stmt->errorInfo()));
            }
        } catch (Exception $e) {
            // Trata e relança a exceção para ser manipulada fora do método
            throw new Exception("Erro no método putCheckEmail: " . $e->getMessage());
        }
        }

    }

?>