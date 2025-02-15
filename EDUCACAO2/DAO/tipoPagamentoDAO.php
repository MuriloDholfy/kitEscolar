<?php 
    class TipoPagamentoDAO {
        private $conexao;

        public function __construct() {
            $this->conexao = Conexao::conexaoBanco_de_Dados();
            if (!$this->conexao) {
                throw new Exception("Erro ao conectar ao banco de dados.");
            }
        }
        public static function showAll() {
            $conexao = Conexao::conexaoBanco_de_Dados();
            $query = "SELECT * FROM tbtipopagamento";
            $stmt = $conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
?>