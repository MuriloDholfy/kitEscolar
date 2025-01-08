<?php
    class Conexao{

        public static function conexaoBanco_de_Dados(){
            $servidor = "localhost";
            $dbnome = "kit_escolar";
            $usuario = "root";
            $dbsenha = "";

        // public static function conexaoBanco_de_Dados(){
        //     $servidor = "127.0.0.1:3306";
        //     $dbnome = "u730047416_bdkitescolar";
        //     $usuario = "u730047416_Murilo";
        //     $dbsenha = "T8fHX?U?Q7l^";

            
           
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