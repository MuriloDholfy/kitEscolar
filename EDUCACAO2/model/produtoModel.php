<?php
class ProdutoModel {
    private $idProduto, $nomeProduto, $descricaoProduto, $precoProduto, $estoqueProduto, $categoriaProduto;

    // Métodos para idProduto
    public function getIdProduto() {
        return $this->idProduto;
    }
    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    // Métodos para nomeProduto
    public function getNomeProduto() {
        return $this->nomeProduto;
    }
    public function setNomeProduto($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    // Métodos para descricaoProduto
    public function getDescricaoProduto() {
        return $this->descricaoProduto;
    }
    public function setDescricaoProduto($descricaoProduto) {
        $this->descricaoProduto = $descricaoProduto;
    }

    // Métodos para precoProduto
    public function getPrecoProduto() {
        return $this->precoProduto;
    }
    public function setPrecoProduto($precoProduto) {
        $this->precoProduto = $precoProduto;
    }

    // Métodos para estoqueProduto
    public function getEstoqueProduto() {
        return $this->estoqueProduto;
    }
    public function setEstoqueProduto($estoqueProduto) {
        $this->estoqueProduto = $estoqueProduto;
    }

    // Métodos para categoriaProduto
    public function getCategoriaProduto() {
        return $this->categoriaProduto;
    }
    public function setCategoriaProduto($categoriaProduto) {
        $this->categoriaProduto = $categoriaProduto;
    }
}
?>
