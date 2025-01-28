<?php 
class UsuarioModel {
    private $id, $nomeUsuario, $emailUsuario, $senhaUsuario, $dataNascimento, $cpfUsuario,$imagemUsuario, $idLogradouro;

    // Métodos para id
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    // Métodos para nomeUsuario
    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }
    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    // Métodos para emailUsuario
    public function getEmailUsuario() {
        return $this->emailUsuario;
    }
    public function setEmailUsuario($emailUsuario) {
        $this->emailUsuario = $emailUsuario;
    }

    // Métodos para senhaUsuario
    public function getSenhaUsuario() {
        return $this->senhaUsuario;
    }
    public function setSenhaUsuario($senhaUsuario) {
        $this->senhaUsuario = $senhaUsuario;
    }

    // Métodos para dataNascimento
    public function getDataNascimento() {
        return $this->dataNascimento;
    }
    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    // Métodos para cpfUsuario
    public function getCpfUsuario() {
        return $this->cpfUsuario;
    }
    public function setCpfUsuario($cpfUsuario) {
        $this->cpfUsuario = $cpfUsuario;
    }

    // Métodos para idLogradouro
    public function getIdLogradouro() {
        return $this->idLogradouro;
    }
    public function setIdLogradouro($idLogradouro) {
        $this->idLogradouro = $idLogradouro;
    }
    public function getImagemUsuario() {
        return $this->imagemUsuario;
    }

    public function setImagemUsuario($imagemUsuario) {
        $this->imagemUsuario = $imagemUsuario;
    }
    public function salvarImagemUsuario($novo_nome){
        var_dump($_FILES);
    
        if($_FILES['fotoUsuario']['size'] > 0){
    
            // Gerar um nome único caso $novo_nome esteja vazio
            if($novo_nome == ""){
                $extensao = pathinfo($_FILES['fotoUsuario']['name'], PATHINFO_EXTENSION);
                if (empty($extensao)) {
                    $extensao = 'jpg'; // Defina um valor padrão caso a extensão não seja detectada
                }
                $novo_nome = md5(time()).".".$extensao;
            }
    
            $diretorio = "../../img/Usuario/";
            $nomeCompleto = $diretorio.$novo_nome;
    
            // Mover o arquivo para o diretório desejado
            move_uploaded_file($_FILES['fotoUsuario']['tmp_name'], $nomeCompleto);
            return $novo_nome;
    
        } else {
            return $novo_nome;
        }
    }
    
}
?>
