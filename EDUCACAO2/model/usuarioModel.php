<?php 
    class UsuarioModel{
        private $id,$nomeUsuario,$emailUsuario,$senhaUsuario;


        public function getId(){
         return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }

         public function getNomeUsuario(){
         return $this->nomeUsuario;
        }
        public function setNomeUsuario($nomeUsuario){
            $this->nomeUsuario = $nomeUsuario;
        }

         public function getEmailUsuario(){
         return $this->emailUsuario;
        }
        public function setEmailUsuario($emailUsuario){
            $this->emailUsuario = $emailUsuario;
        }

         public function getSenhaUsuario(){
         return $this->senhaUsuario;
        }
        public function setSenhaUsuario($senhaUsuario){
            $this->senhaUsuario = $senhaUsuario;
        }   
    }

?>