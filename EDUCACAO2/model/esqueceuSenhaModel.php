<?php
class EsqueceuSenhaModel {
    private $idUsuario;
    private $codigoSenhaReset;
    private $criado_em;
    private $expirado_em;

    // Getters e Setters
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getCodigoSenhaReset() {
        return $this->codigoSenhaReset;
    }

    public function setCodigoSenhaReset($codigoSenhaReset) {
        $this->codigoSenhaReset = $codigoSenhaReset;
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
