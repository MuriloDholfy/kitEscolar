<?php
require_once(__DIR__.'/../model/conexao.php');

class ProdutoDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::conexaoBanco_de_Dados();
        if (!$this->conexao) {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    // Criar um novo produto
    public static function createProduto($produto) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "INSERT INTO tbProduto (nomeProduto, descricaoProduto, valorProduto,quantidadeProduto, imagemProduto) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $produto->getNomeProduto());
        $stmt->bindValue(2, $produto->getDescricaoProduto());
        $stmt->bindValue(3, $produto->getValorProduto());
        $stmt->bindValue(4, $produto->getQtdProduto());
        $stmt->bindValue(5, $produto->getImagemProduto());

        if ($stmt->execute()) {
            return $conexao->lastInsertId();
        } else {
            throw new Exception("Erro ao inserir produto: " . implode(", ", $stmt->errorInfo()));
        }
    }

    // Mostrar produto por ID
    public static function showById($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT * FROM tbProduto WHERE idProduto = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mostrar todos os produtos
    public static function showAll() {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT * FROM tbProduto";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualizar um produto
    public static function updateProduto($id, $produto) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "UPDATE tbProduto SET
                    nomeProduto = ?,
                    descricaoProduto = ?,
                    valorProduto = ?,
                    qtdProduto = ?,
                    imagemProduto = ?
                  WHERE idProduto = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $produto->getNomeProduto());
        $stmt->bindValue(2, $produto->getDescricaoProduto());
        $stmt->bindValue(3, $produto->getValorProduto());
        $stmt->bindValue(4, $produto->getQtdProduto());
        $stmt->bindValue(5, $produto->getImagemProduto());
        $stmt->bindValue(6, $id);

        return $stmt->execute();
    }

    // Excluir produto
    public static function deleteProduto($id) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "DELETE FROM tbProduto WHERE idProduto = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
    public static function showByName($nomeProduto) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT * FROM tbProduto WHERE nomeProduto LIKE ?";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, '%'.$nomeProduto.'%');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function showProdutosPendentes($usuarioId) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT p.idProduto, p.nomeProduto, p.descricaoProduto, cp.quantidade, cp.preco, cp.precoTotal,p.imagemProduto,c.idComanda,cp.idComanda_Produtos
                  FROM tbcomandaproduto cp
                  JOIN tbproduto p ON cp.idProduto = p.idProduto
                  JOIN tbcomanda c ON cp.idComanda = c.idComanda
                  WHERE c.idUsuario = ? 
                  AND c.statusComanda = 'Em andamento'";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function showAllProdutos($usuarioId) {
        $conexao = Conexao::conexaoBanco_de_Dados();
        $query = "SELECT p.idProduto, p.nomeProduto, p.descricaoProduto, cp.quantidade, cp.preco, cp.precoTotal,p.imagemProduto,c.idComanda,cp.idComanda_Produtos
                  FROM tbcomandaproduto cp
                  JOIN tbproduto p ON cp.idProduto = p.idProduto
                  JOIN tbcomanda c ON cp.idComanda = c.idComanda
                  WHERE c.idUsuario = ? ";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(1, $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


?>
