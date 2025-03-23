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
        
        


      
            public static function createUser($usuario) {
                try {
                    // Realiza a conexão com o banco de dados
                    $conexao = Conexao::conexaoBanco_de_Dados();
                    
                    // Query do banco de dados sendo preparada para ser executada
                    $query = "INSERT INTO tbUsuario (nomeUsuario, emailUsuario, senhaUsuario) VALUES (?, ?, ?)";
                    $stmt = $conexao->prepare($query);
                    
                    // Vincula os valores aos parâmetros na consulta
                    $stmt->bindValue(1, $usuario->getNomeUsuario());
                    $stmt->bindValue(2, $usuario->getEmailUsuario());
                    $stmt->bindValue(3, $usuario->getSenhaUsuario());
                    
                    // Executa a query e verifica se foi bem-sucedida
                    if ($stmt->execute()) {
                        return $conexao->lastInsertId(); // Retorna o ID do novo usuário
                    } else {
                        throw new Exception("Erro ao executar a consulta no banco de dados.");
                    }
                } catch (PDOException $e) {
                    // Captura o erro de chave duplicada (violação de restrição UNIQUE)
                    session_start();
                    if ($e->getCode() == 23000) { // Código de erro de chave duplicada
                        
                       $_SESSION['erro'] = "O e-mail informado já está em uso. Tente outro.";
                       header("Location: cadastro.php");
                         exit;
                    } else {
                        // Caso seja outro erro, exibe a mensagem específica
                        $_SESSION['erro'] = "Erro ao tentar cadastrar o usuario";
                       header("Location: cadastro.php");
                         exit;
                    }
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
             idLogradouro = ?,
             nomeUsuario = ?,
             emailUsuario = ?,
             senhaUsuario = ?,
             nascimentoUsuario = ?,
             imagemUsuario = ?  
             WHERE idUsuario = ?";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$usuario->getIdLogradouro());
            $stmt ->bindValue(2,$usuario->getNomeUsuario());
            $stmt ->bindValue(3,$usuario->getEmailUsuario());
            $stmt ->bindValue(4,$usuario->getSenhaUsuario());
            $stmt ->bindValue(5,$usuario->getDataNascimento());
            $stmt ->bindValue(6,$usuario->getImagemUsuario());
            $stmt ->bindValue(7 ,$id);
            return $stmt -> execute();
        }
        public static function putUserLogradoro($id,$idLogradouro){
            //realiza a conexão com banco de dados 
            $conexao = Conexao::conexaoBanco_de_Dados();
            //QUErty do banco de dados sendo preparads para ser executado no banco
            $query = "UPDATE tbUsuario SET
             idLogradouro = ?
             WHERE idUsuario = ?";
            $stmt = $conexao->prepare(query: $query);
            //valores sendo vinculados aos parametros nas cosnsultas 
            $stmt ->bindValue(1,$idLogradouro);
            $stmt ->bindValue(2,$id);
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
        public static function putSenha($novaSenha,$idUsuario){
            try{
             //realiza a conexão com banco de dados 
             $conexao = Conexao::conexaoBanco_de_Dados();
             //QUErty do banco de dados sendo preparads para ser executado no banco
             $query = "UPDATE tbUsuario SET
              senhaUsuario = ?
              WHERE idUsuario = ?";
             $stmt = $conexao->prepare($query);
             //valores sendo vinculados aos parametros nas cosnsultas 
             $stmt ->bindValue(1,$novaSenha);
             $stmt ->bindValue(2,$idUsuario);
             if ($stmt->execute()) {
                 return true; // Sucesso ao atualizar o registro
             } else {
                 // Lança uma exceção caso ocorra algum erro na execução
                 throw new Exception("Erro ao atualizar a senha usuário: " . implode(", ", $stmt->errorInfo()));
             }
         } catch (Exception $e) {
             // Trata e relança a exceção para ser manipulada fora do método
             throw new Exception("Erro no método putSenha: " . $e->getMessage());
         }
         }
        public static function showByIdEndereco($id){
            // Realiza a conexão com o banco de dados
            $conexao = Conexao::conexaoBanco_de_Dados();
        
            // Query do banco de dados com JOIN entre as tabelas tbUsuario e enderecos
            $query = "
                SELECT tbUsuario.idUsuario,tbUsuario.idLogradouro, tbLogradouro.cep,tbLogradouro.numero,tbLogradouro.bairro,tbLogradouro.cidade,tbLogradouro.rua,tbLogradouro.estado
                FROM tbUsuario
                JOIN tbLogradouro ON tbUsuario.idLogradouro = tbLogradouro.idLogradouro
                WHERE tbUsuario.idUsuario = ?
            ";
            // Preparar a consulta para execução
            $stmt = $conexao->prepare($query);
        
            // Vincular o valor ao parâmetro na consulta
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
        
            // Executar a consulta
            $stmt->execute();
        
            // Retornar os resultados da consulta como array associativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>