<?php 
    class LogradouroModel {
        private $idLogradouro,$ruaLogrado,$numeroLogrado,$bairroLogrado,$cidadeLogrado,$estadoLogrado,$cepLogrado;


        public function getIdLogradouro(){
         return $this->idLogradouro;
        }
        public function setIdLogradouro($idLogradouro){
            $this->idLogradouro = $idLogradouro;
        }
        public function getRuaLogrado(){
         return $this->ruaLogrado;
        }
        public function setRuaLogrado($ruaLogrado){
            $this->ruaLogrado = $ruaLogrado;
        }
        public function getNumeroLogrado(){
            return $this->numeroLogrado;
        }
        public function setNumeroLogrado($numeroLogrado){
            $this->numeroLogrado = $numeroLogrado;
        }
        public function getBairroLogrado(){
            return $this->bairroLogrado;
        }
        public function setBairroLogrado($bairroLogrado){
            $this->bairroLogrado = $bairroLogrado;
        }
        public function getCidadeLogrado() {
            return $this->cidadeLogrado;
        }
        
        public function setCidadeLogrado($cidadeLogrado) {
            $this->cidadeLogrado = $cidadeLogrado;
        }
        
        public function getEstadoLogrado() {
            return $this->estadoLogrado;
        }
        
        public function setEstadoLogrado($estadoLogrado) {
            $this->estadoLogrado = $estadoLogrado;
        }
        
        public function getCepLogrado() {
            return $this->cepLogrado;
        }
        
        public function setCepLogrado($cepLogrado) {
            $this->cepLogrado = $cepLogrado;
        }
    
        
    }

?>