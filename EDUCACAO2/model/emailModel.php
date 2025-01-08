<?php
class VerificacaoEmailModel {
    private $idVerificacaoEmail;
    private $idUsuario;
    private $codigoverificacaoEmail;
    private $criado_em;
    private $expirado_em;

    public function getIdVerificacaoEmail() {
        return $this->idVerificacaoEmail;
    }

    public function setIdVerificacaoEmail($idVerificacaoEmail) {
        $this->idVerificacaoEmail = $idVerificacaoEmail;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getCodigoVerificacaoEmail() {
        return $this->codigoverificacaoEmail;
    }

    public function setCodigoVerificacaoEmail($codigoverificacaoEmail) {
        $this->codigoverificacaoEmail = $codigoverificacaoEmail;
    }

    public function getCriadoEm() {
        return $this->criado_em;
    }

    public function setCriadoEm($criado_em) {
        $this->criado_em = $criado_em;
    }

    public function getExpiradoEm() {
        return $this->expirado_em;
    }

    public function setExpiradoEm($expirado_em) {
        $this->expirado_em = $expirado_em;
    }
}
?>
