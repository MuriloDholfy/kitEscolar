<?php 
class ComandaProdutoModel {
    private $idComandaProduto;
    private $idComanda;
    private $idProduto;
    private $quantidade;
    private $preco;
    private $total;

    // Getters e Setters
    public function getIdComandaProduto() {
        return $this->idComandaProduto;
    }

    public function setIdComandaProduto($idComandaProduto) {
        $this->idComandaProduto = $idComandaProduto;
    }

    public function getIdComanda() {
        return $this->idComanda;
    }

    public function setIdComanda($idComanda) {
        $this->idComanda = $idComanda;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    // Método para calcular o total (preço * quantidade)
    public function calcularTotal() {
        $preco = (float) $this->preco;
        $quantidade = (int) $this->quantidade; 
        
        return $this->total = $preco * $quantidade;
        
    }
}



?>