<?php
class TipoPagamentoModel {
    private $idTipoPagamento;
    private $tipoPagamento;

    public function getIdTipoPagamento() {
        return $this->idTipoPagamento;
    }

    public function setIdTipoPagamento($idTipoPagamento) {
        $this->idTipoPagamento = $idTipoPagamento;
    }

    public function getTipoPagamento() {
        return $this->tipoPagamento;
    }

    public function setTipoPagamento($tipoPagamento) {
        $this->tipoPagamento = $tipoPagamento;
    }
}