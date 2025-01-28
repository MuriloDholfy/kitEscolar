<?php
require_once(__DIR__.'/../model/conexao.php');

class ComandaDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::conexaoBanco_de_Dados();
        if (!$this->conexao) {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    public static function createComanda($comanda) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "INSERT INTO tbComanda (idUsuario, statusComanda, criado_em) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $comanda->getIdUsuario());
        $stmt->bindValue(2, $comanda->getStatusComanda());
        $stmt->bindValue(3, $comanda->getCriadoEm());
        
        if ($stmt->execute()) {
            return $conexao->lastInsertId();
        } else {
            throw new Exception("Erro ao criar a comanda: " . implode(", ", $stmt->errorInfo()));
        }
    }

    public static function showById($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT * FROM tbComanda WHERE idComanda = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function showAll() {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT * FROM tbComanda";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateComanda($id, $comanda) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "UPDATE tbComanda SET 
                    idUsuario = ?, 
                    idPagamento = ?, 
                    statusComanda = ? 
                  WHERE idComanda = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $comanda->getIdUsuario());
        $stmt->bindValue(2, $comanda->getIdPagamento());
        $stmt->bindValue(3, $comanda->getStatusComanda());
        $stmt->bindValue(4, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao atualizar a comanda: " . implode(", ", $stmt->errorInfo()));
        }
    }

    public static function deleteComanda($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "DELETE FROM tbComanda WHERE idComanda = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao deletar a comanda: " . implode(", ", $stmt->errorInfo()));
        }
    }
}
?>
