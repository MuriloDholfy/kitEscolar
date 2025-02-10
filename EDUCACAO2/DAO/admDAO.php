<?php
require_once (__DIR__ . '/../model/Conexao.php');
    
    class AdmDAO{

        private $conexao;
        
        public function __construct() {
            $this->conexao = Conexao::conexaoBanco_de_Dados();
            if (!$this->conexao) {
                throw new Exception("Erro ao conectar ao banco de dados.");
            }
        }
    
        public static function insert($user){
            $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "INSERT INTO tbAdm (nomeAdm, emailAdm, senhaAdm, imgAdm,tokenAdm) VALUES (?,?,?,?,?)";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(1, $user->getNome());
            $stmt->bindValue(2, $user->getEmail());
            $stmt->bindValue(3, $user->getPassword());
            $stmt->bindValue(4, $user->getImagem());
            $stmt->bindValue(5, $user->getToken());
            $stmt->execute();
        }
        public static function selectAll(){
                     $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "SELECT * FROM tbAdm";
            $stmt = $conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public static function selectById($id){
                     $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "SELECT * FROM tbAdm WHERE idAdm = ?";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public static function delete($id){
                     $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "DELETE FROM tbAdm WHERE idAdm = ?";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(1, $id);
            return  $stmt->execute();
        }
        public static function update($id, $user){
                     $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "UPDATE tbAdm SET 
            nomeAdm = ?, 
            emailAdm = ?, 
            senhaAdm = ?, 
            imgAdm = ?, 
            tokenAdm = ? 
            WHERE idAdm = ?";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(1, $user->getNome());
            $stmt->bindValue(2, $user->getEmail());
            $stmt->bindValue(3, $user->getPassword());
            $stmt->bindValue(4, $user->getImagem());
            $stmt->bindValue(5, $user->getToken());
            $stmt->bindValue(6, $id); 
            return $stmt->execute();
        }
        public static function checkCredentials($email, $senha){
                     $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "SELECT * FROM tbAdm WHERE emailAdm = ? and senhaAdm = ?";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $senha);
            $stmt->execute();
         
                return $stmt->fetch(PDO::FETCH_ASSOC);
          
        }

    }
?>