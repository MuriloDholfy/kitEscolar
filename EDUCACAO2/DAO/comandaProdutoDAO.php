<?php 
require_once(__DIR__.'/../model/conexao.php');

class ComandaProdutoDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::conexaoBanco_de_Dados();
        if (!$this->conexao) {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    public static function createComandaProduto($comandaProduto) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "INSERT INTO tbComandaProduto (idComanda, idProduto, quantidade, preco, precoTotal) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $comandaProduto->getIdComanda());
        $stmt->bindValue(2, $comandaProduto->getIdProduto());
        $stmt->bindValue(3, $comandaProduto->getQuantidade());
        $stmt->bindValue(4, $comandaProduto->getPreco());
        $stmt->bindValue(5, $comandaProduto->getTotal());
        
        if ($stmt->execute()) {
            return $conexao->lastInsertId();
        } else {
            throw new Exception("Erro ao criar a comandaProduto: " . implode(", ", $stmt->errorInfo()));
        }
    }

    public static function showById($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT 
            cp.idComanda_Produtos, 
            cp.idComanda, 
            cp.idProduto, 
            p.nomeProduto, 
            cp.quantidade, 
            cp.preco, 
            cp.precoTotal
        FROM tbcomandaproduto cp
        JOIN tbproduto p ON cp.idProduto = p.idProduto
        WHERE cp.idComanda = ?";  
        
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT); 
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function getIdProduto($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT 
           idProduto
        FROM tbcomandaproduto
        WHERE idComanda = ?";  
        
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT); 
        $stmt->execute();
        
        return $stmt->fetchColumn(); 
    }
    public static function getQtdProduto($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT 
           quantidade
        FROM tbcomandaproduto
        WHERE idComanda = ?";  
        
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT); 
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    

    public static function showAllByComanda($idComanda) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT * FROM tbComandaProduto WHERE idComanda = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $idComanda);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function showAll() {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT 
    cp.idComanda_Produtos, 
    cp.idComanda, 
    cp.idProduto, 
    p.nomeProduto, 
    cp.quantidade, 
    cp.preco, 
    cp.precoTotal
FROM tbcomandaproduto cp
JOIN tbproduto p ON cp.idProduto = p.idProduto;
";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateComandaProduto($id, $comandaProduto) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "UPDATE tbComandaProduto SET 
                    idComanda = ?, 
                    idProduto = ?, 
                    quantidade = ?, 
                    preco = ?, 
                    total = ? 
                  WHERE idComanda_Produtos = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $comandaProduto->getIdComanda());
        $stmt->bindValue(2, $comandaProduto->getIdProduto());
        $stmt->bindValue(3, $comandaProduto->getQuantidade());
        $stmt->bindValue(4, $comandaProduto->getPreco());
        $stmt->bindValue(5, $comandaProduto->getTotal());
        $stmt->bindValue(6, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao atualizar a comandaProduto: " . implode(", ", $stmt->errorInfo()));
        }
    }

    public static function deleteComandaProduto($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "DELETE FROM tbComandaProduto WHERE idComanda_Produtos = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao deletar a comandaProduto: " . implode(", ", $stmt->errorInfo()));
        }
    }
    
}

?>