<?php
require_once 'Conexao.php';

$conexao = Conexao::conexaoBanco_de_Dados();

if ($conexao) {
    echo "Conexão estabelecida com sucesso.";
} else {
    echo "Falha ao conectar ao banco de dados.";
}
?>
