<?php
    class Conexao{

        public static function conexaoBanco_de_Dados(){
            $servidor = "localhost";
            $dbnome = "kitEscolar";
            $usuario = "root";
            $dbsenha = "";

            
           
            try {
                $conexao = new PDO("mysql:host=$servidor;dbname=$dbnome",$usuario,$dbsenha);  
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
               
                return $conexao;
            } catch (Exception $e) {
                error_log($e->getMessage()); 
            
                return null;
            }
            
        }

    }


?>