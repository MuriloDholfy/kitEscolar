<?php

class AdmModel{
    private $id,$nome,$email,$senha,$imagem,$token;

    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getnome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }


    public  function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->senha;
    }

    public function setPassword($senha) {
        $this->senha = $senha;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }
    public function generateToken() {
        return bin2hex(random_bytes(16));   
    }
    public function salvarImagem($novo_nome){

        if(empty($_FILES['foto']['size']) != 1){

            if($novo_nome == ""){
                $novo_nome = md5(time()).".jpg";
            }

            $diretorio = "../../img/user/";

            $nomeCompleto = $diretorio.$novo_nome;

            move_uploaded_file($_FILES['foto']['tmp_name'],$nomeCompleto);
            return $novo_nome;
        }
        else{
            return $novo_nome;
        }
    }
    
  
    
}

?>