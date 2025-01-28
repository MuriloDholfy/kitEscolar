<?php
class ComandaModel {
    private $idComanda;
    private $idUsuario;
    private $idPagamento;
    private $statusComanda;
    private $criado_em;

    // Getters e Setters
    public function getIdComanda() {
        return $this->idComanda;
    }

    public function setIdComanda($idComanda) {
        $this->idComanda = $idComanda;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getIdPagamento() {
        return $this->idPagamento;
    }

    public function setIdPagamento($idPagamento) {
        $this->idPagamento = $idPagamento;
    }

    public function getStatusComanda() {
        return $this->statusComanda;
    }

    public function setStatusComanda($statusComanda) {
        $this->statusComanda = $statusComanda;
    }

    public function getCriadoEm() {
        return $this->criado_em;
    }

    public function setCriadoEm($criado_em) {
        $this->criado_em = $criado_em;
    }
}
?>
