<?php
class Prestador_cadastro{
    public $nome, $email, $telefone, $senha, $senhaconf, $cpf, $pais, $estado, $cidade,
    $rua, $numero, $complemento, $bairro, $agencia, $numeroconta, $foto;

    function __construct($nome, $email, $telefone, $senha, $senhaconf, $cpf, $pais,
    $estado, $cidade, $rua, $numero, $complemento, $bairro, $agencia, $numeroconta,
    $foto = 'https://goo.gl/1ZQr7W'){
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->senha = $senha;
        $this->senhaconf = $senhaconf;
        $this->cpf = $cpf;
        $this->pais = $pais;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->agencia = $agencia;
        $this->numeroconta = $numeroconta;
        $this->foto = $foto;
    }

    function notNULL($var){
        if($var != '')
            return true;
        return false;
    }

    public function validEntry(){
        if($this->notNull($this->nome) && $this->notNull($this->email) && $this->notNull($this->senha) &&
        $this->notNull($this->senhaconf) && $this->notNull($this->cpf) && $this->notNull($this->pais) &&
        $this->notNull($this->estado) && $this->notNull($this->cidade) && $this->notNull($this->rua) &&
        $this->notNull($this->numero) && $this->notNull($this->bairro) && $this->notNull($this->agencia) &&
        $this->notNull($this->numeroconta) && $this->senhaconf == $this->senha && is_numeric($this->numero) &&
        is_numeric($this->numeroconta) && is_numeric($this->telefone) && $this->notNull($this->telefone) &&
        is_numeric($this->agencia) && is_numeric($this->numeroconta))
            return true;
        return false;
    }

    public function prestadorSet($link){
        $query = "INSERT INTO prestador (email, nome, senha, foto, cpf,
        pontuacao, agencia, nconta) VALUES ('".$this->email."', '".$this->nome."',
        '".$this->senha."','".$this->foto."','".$this->cpf."',0,'".$this->agencia."',
        '".$this->numeroconta."')";

        $exists = false;

        $query2 = "SELECT * FROM cliente WHERE `email` = '".$this->email."'";
        $result = mysqli_query($link, $query2);
        if($result->num_rows > 0){
            $exists = true;
        }
        if(!$exists){
            if(mysqli_query($link, $query)){
                $this->telefoneSet($link);
                $this->enderecoSet($link);
                echo '<script type="text/javascript" src="popup.js"></script>';
                echo '<script> alert("Registro feito"); </script>';
            }
        }
        else{
            echo '<script type="text/javascript" src="popup.js"></script>';
            echo '<script> alert("Usuário já cadastrado"); </script>';
        }
    }
    public function telefoneSet($link){
        $query = "INSERT INTO telefone (numero) VALUES ('".$this->telefone."')";
        mysqli_query($link, $query);
        $id = mysqli_insert_id($link);
        $query = "INSERT INTO prestador_has_telefone (Prestador_email, Telefone_id)
        VALUES ('".$this->email."', '".$id."')";
        mysqli_query($link, $query);
    }
    public function enderecoSet($link){
        $query = "INSERT INTO endereco (rua, numero, bairro, cidade, estado, pais, complemento)
        VALUES ('".$this->rua."', '".$this->numero."', '".$this->bairro."', '".$this->cidade."',
        '".$this->estado."', '".$this->pais."', '".$this->complemento."')";
        mysqli_query($link, $query);
        $id = mysqli_insert_id($link);
        $query = "INSERT INTO prestador_has_endereco (Prestador_email, Endereco_id)
        VALUES ('".$this->email."', '".$id."')";
        mysqli_query($link, $query);
    }

}
?>
