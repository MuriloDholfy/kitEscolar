<?php
class ProdutoModel {
    private $idProduto, $nomeProduto, $descricaoProduto, $valorProduto, $qtdProduto, $imagemProduto;

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

    // Métodos para valorProduto
    public function getValorProduto() {
        return $this->valorProduto;
    }
    public function setValorProduto($valorProduto) {
        $this->valorProduto = $valorProduto;
    }

    // Métodos para qtdProduto
    public function getQtdProduto() {
        return $this->qtdProduto;
    }
    public function setQtdProduto($qtdProduto) {
        $this->qtdProduto = $qtdProduto;
    }

    // Métodos para imagemProduto
    public function getImagemProduto() {
        return $this->imagemProduto;
    }

    public function setImagemProduto($imagemProduto) {
        $this->imagemProduto = $imagemProduto;
    }

    // Método para salvar imagem do produto
    public function salvarImagemProduto($novo_nome = "") {
        // Verifica se o arquivo foi enviado
        var_dump($_FILES);
        if ($_FILES['fotoProduto']['size'] > 0) {
            // Se o nome da imagem não for passado, gerar um nome único
            if ($novo_nome == "") {
                $extensao = pathinfo($_FILES['fotoProduto']['name'], PATHINFO_EXTENSION);
                if (empty($extensao)) {
                    $extensao = 'jpg'; // Define uma extensão padrão se não for detectada
                }
                $novo_nome = md5(time()) . "." . $extensao;
            }

            // Define o diretório para salvar a imagem
            $diretorio = "../../img/Produto/";
            $nomeCompleto = $diretorio . $novo_nome;

            // Move o arquivo para o diretório desejado
            move_uploaded_file($_FILES['fotoProduto']['tmp_name'], $nomeCompleto);

            return $novo_nome;
        } else {
            
            return $novo_nome;
        }
    }
}
?>
