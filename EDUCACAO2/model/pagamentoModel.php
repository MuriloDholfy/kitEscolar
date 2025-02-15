<?php
class PagamentoModel {
    private $idPagamento;
    private $valorPagamento;
    private $idTipoPagamento;
    private $emailDuePay;
    private $telefoneDuePay;
    private $senhaDuePay;

    // Getters e Setters
    public function getIdPagamento() {
        return $this->idPagamento;
    }

    public function setIdPagamento($idPagamento) {
        $this->idPagamento = $idPagamento;
    }

    public function getValorPagamento() {
        return $this->valorPagamento;
    }

    public function setValorPagamento($valorPagamento) {
        $this->valorPagamento = $valorPagamento;
    }

    public function getIdTipoPagamento() {
        return $this->idTipoPagamento;
    }

    public function setIdTipoPagamento($idTipoPagamento) {
        $this->idTipoPagamento = $idTipoPagamento;
    }

    public function getEmailDuePay() {
        return $this->emailDuePay;
    }

    public function setEmailDuePay($emailDuePay) {
        $this->emailDuePay = $emailDuePay;
    }

    public function getTelefoneDuePay() {
        return $this->telefoneDuePay;
    }

    public function setTelefoneDuePay($telefoneDuePay) {
        $this->telefoneDuePay = $telefoneDuePay;
    }

    public function getSenhaDuePay() {
        return $this->senhaDuePay;
    }

    public function setSenhaDuePay($senhaDuePay) {
        $this->senhaDuePay = $senhaDuePay;
    }
}

