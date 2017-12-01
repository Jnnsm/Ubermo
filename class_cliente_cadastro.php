<?php
class Cliente_cadastro{
    public $nome, $email, $telefone, $senha, $senhaconf, $cpf, $pais, $estado, $cidade,
    $rua, $numero, $complemento, $bairro, $cartao, $cartaovm,
    $cartaova, $cartaocs, $foto;

    function __construct($nome, $email, $telefone, $senha, $senhaconf, $cpf, $pais,
    $estado, $cidade, $rua, $numero, $complemento, $bairro, $cartao,
    $cartaova, $cartaovm, $cartaocs, $foto = 'https://goo.gl/1ZQr7W'){
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
        $this->cartao = $cartao;
        $this->cartaova = $cartaova;
        $this->cartaovm = $cartaovm;
        $this->cartaocs = $cartaocs;
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
        $this->notNull($this->numero) && $this->notNull($this->bairro) && $this->notNull($this->cartao) &&
        $this->notNull($this->cartaova) && $this->notNull($this->cartaovm) && $this->notNull($this->cartaocs) &&
        $this->notNull($this->telefone) && $this->senhaconf == $this->senha && is_numeric($this->numero) &&
        is_numeric($this->telefone) && $this->notNull($this->telefone) && is_numeric($this->cartao) &&
        is_numeric($this->cartaova) && is_numeric($this->cartaovm) && is_numeric($this->cartaocs))
            return true;
        return false;
    }

    public function clienteSet($link){
        $query = "INSERT INTO cliente (email, nome, senha, foto, cpf,
        pontuacao) VALUES ('".$this->email."', '".$this->nome."',
        '".$this->senha."','".$this->foto."','".$this->cpf."',0)";

        $exists = false;

        $query2 = "SELECT * FROM prestador WHERE `email` = '".$this->email."'";
        $result = mysqli_query($link, $query2);
        if($result->num_rows > 0){
            $exists = true;
        }
        if(!$exists){
            if(mysqli_query($link, $query)){
                $this->telefoneSet($link);
                $this->enderecoSet($link);
                $this->cartaoSet($link);
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
        $query = "INSERT INTO cliente_has_telefone (Cliente_email, Telefone_id)
        VALUES ('".$this->email."', '".$id."')";
        mysqli_query($link, $query);
    }
    public function enderecoSet($link){
        $query = "INSERT INTO endereco (rua, numero, bairro, cidade, estado, pais, complemento)
        VALUES ('".$this->rua."', '".$this->numero."', '".$this->bairro."', '".$this->cidade."',
        '".$this->estado."', '".$this->pais."', '".$this->complemento."')";
        mysqli_query($link, $query);
        $id = mysqli_insert_id($link);
        $query = "INSERT INTO cliente_has_endereco (Cliente_email, Endereco_id)
        VALUES ('".$this->email."', '".$id."')";
        mysqli_query($link, $query);
    }
    public function cartaoSet($link){
        $query = "INSERT INTO cartao (mesVencimento, anoVencimento,
        codSeguranca, numeroCartao, Cliente_email) VALUES ('".$this->cartaovm."',
        '".$this->cartaova."','".$this->cartaocs."','".$this->cartao."',
        '".$this->email."')";
        mysqli_query($link, $query);
    }

}
?>
