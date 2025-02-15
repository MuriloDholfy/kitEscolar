<?php 
require_once(__DIR__.'/../model/conexao.php');

class PagamentoDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::conexaoBanco_de_Dados();
        if (!$this->conexao) {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    public static function createPagamento($pagamento) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "INSERT INTO tbpagamento (valorPagamento, idTipoPagamento, emailDuePay, telefoneDuePay, senhaDuePay) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $pagamento->getValorPagamento());
        $stmt->bindValue(2, $pagamento->getIdTipoPagamento());
        $stmt->bindValue(3, $pagamento->getEmailDuePay());
        $stmt->bindValue(4, $pagamento->getTelefoneDuePay());
        $stmt->bindValue(5, $pagamento->getSenhaDuePay());
        if ($stmt->execute()) {
            return $conexao->lastInsertId();
        } else {
            throw new Exception("Erro ao criar pagamento: " . implode(", ", $stmt->errorInfo()));
        }
    }

    public function getPagamentoById($id) {
        $query = "SELECT * FROM tbpagamento WHERE idPagamento = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllPagamentos() {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT * FROM tbpagamento";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePagamento($id, $pagamento) {
        $query = "UPDATE tbpagamento SET valorPagamento = ?, idTipoPagamento = ?, emailDuePay = ?, telefoneDuePay = ?, senhaDuePay = ? WHERE idPagamento = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $pagamento->getValorPagamento());
        $stmt->bindValue(2, $pagamento->getIdTipoPagamento());
        $stmt->bindValue(3, $pagamento->getEmailDuePay());
        $stmt->bindValue(4, $pagamento->getTelefoneDuePay());
        $stmt->bindValue(5, $pagamento->getSenhaDuePay());
        $stmt->bindValue(6, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao atualizar pagamento: " . implode(", ", $stmt->errorInfo()));
        }
    }

    public function deletePagamento($id) {
        $query = "DELETE FROM tbpagamento WHERE idPagamento = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao excluir pagamento: " . implode(", ", $stmt->errorInfo()));
        }
    }
}
?>