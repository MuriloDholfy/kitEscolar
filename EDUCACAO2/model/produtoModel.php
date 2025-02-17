<?php
class ProdutoModel {
    private $idProduto, $nomeProduto, $descricaoProduto, $precoProduto, $estoqueProduto,$imagemProduto;

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
    public function getImagemProduto() {
        return $this->imagemProduto;
    }

    public function setImagemProduto($imagemProduto) {
        $this->imagemProduto = $imagemProduto;
    }

    public function salvarImagemProduto($novo_nome){
        var_dump($_FILES);
    
        if($_FILES['fotoProduto']['size'] > 0){
    
            // Gerar um nome único caso $novo_nome esteja vazio
            if($novo_nome == ""){
                $extensao = pathinfo($_FILES['fotoProduto']['name'], PATHINFO_EXTENSION);
                if (empty($extensao)) {
                    $extensao = 'jpg'; // Defina um valor padrão caso a extensão não seja detectada
                }
                $novo_nome = md5(time()).".".$extensao;
            }
    
            $diretorio = "../../img/Produto/";
            $nomeCompleto = $diretorio.$novo_nome;
    
            // Mover o arquivo para o diretório desejado
            move_uploaded_file($_FILES['fotoProduto']['tmp_name'], $nomeCompleto);
            return $novo_nome;
    
        } else {
            return $novo_nome;
        }
    }
}
?>
