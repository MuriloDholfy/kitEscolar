<?php
class VerificacaoEmailDAO {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function create($verificacaoEmail) {
        $query = "INSERT INTO 
        tbverificacaoemail (idUsuario, codigoverificacaoEmail, criado_em,expirado_em) 
         VALUES (?, ?, ?,?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $verificacaoEmail->getIdUsuario());
        $stmt->bindValue(2, $verificacaoEmail->getCodigoVerificacaoEmail());
        $stmt->bindValue(3, $verificacaoEmail->getCriadoEm());
        $stmt->bindValue(4, $verificacaoEmail->getExpiradoEm());
        return $stmt->execute();
    }

    public function getByCodeUserId($idUsuario) {
        $query = "SELECT codigoverificacaoEmail FROM tbverificacaoemail WHERE idUsuario = ? AND expirado_em > NOW()";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idUsuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($verificacaoEmail) {
        $query = "UPDATE tbverificacaoemail SET codigoverificacaoEmail = ?, expirado_em = ? WHERE idUsuario = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $verificacaoEmail->getCodigoVerificacaoEmail());
        $stmt->bindValue(2, $verificacaoEmail->getExpiradoEm());
        $stmt->bindValue(3, $verificacaoEmail->getIdUsuario());
         $stmt->execute();
         if($stmt->rowCount()>0){

         }
    }

    public function delete($idVerificacaoEmail) {
        $query = "DELETE FROM tbverificacaoemail WHERE idVerificacaoEmail = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idVerificacaoEmail);
        return $stmt->execute();
    }
}
?>
