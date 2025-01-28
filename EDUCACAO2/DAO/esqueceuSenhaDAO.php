<?php
require_once(__DIR__ . '/../model/conexao.php');
require_once(__DIR__ . '/../model/esqueceuSenhaModel.php');

class EsqueceuSenhaDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::conexaoBanco_de_Dados();
        if (!$this->conexao) {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    // Criar solicitação de recuperação de senha
    public static function createEsqueceuSenha($esqueceuSenha) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "INSERT INTO tbSenhaReset (idUsuario, codigoSenhaReset, criado_em, expirado_em) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $esqueceuSenha->getIdUsuario());
        $stmt->bindValue(2, $esqueceuSenha->getCodigoSenhaReset());
        $stmt->bindValue(3, $esqueceuSenha->getCriadoEm());
        $stmt->bindValue(4, $esqueceuSenha->getExpiradoEm());

        if ($stmt->execute()) {
            return $conexao->lastInsertId();
        } else {
            throw new Exception("Erro ao criar a solicitação de recuperação de senha: " . implode(", ", $stmt->errorInfo()));
        }
    }

    // Buscar solicitação por código
    public static function getByCodigo($idUsuario) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT codigoSenhaReset FROM tbSenhaReset WHERE idUsuario = ? AND expirado_em > NOW()";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $idUsuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Código de recuperação inválido ou expirado.");
        }
    }

    // Deletar solicitações expiradas
    public static function deleteExpirados() {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "DELETE FROM tbSenhaReset WHERE expirado_em <= NOW()";
        $stmt = $conexao->prepare($query);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao deletar solicitações expiradas: " . implode(", ", $stmt->errorInfo()));
        }
    }

    // Deletar solicitação por código
    public static function deleteByCodigo($codigo) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "DELETE FROM tbSenhaReset WHERE codigoSenhaReset = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $codigo);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao deletar a solicitação de recuperação de senha: " . implode(", ", $stmt->errorInfo()));
        }
    }
}
?>
