<?php
    class User{
        private $email, $tipo, $link;

        public function __construct($e, $t, $l){
            $this->email = $e;
            $this->tipo = $t;
            $this->link = $l;
        }

        public function getFoto(){
            if($this->tipo == 'cliente') $query = "SELECT foto FROM cliente WHERE `email` = '".$this->email."'";
            else $query = "SELECT foto FROM prestador WHERE `email` = '".$this->email."'";
            $result = (mysqli_query($this->link, $query));
            return $result->fetch_object()->foto;
        }

        public function setFoto($foto){
            if($this->tipo == 'cliente') $query = "UPDATE cliente SET foto = '".$foto."' WHERE `email` = '".$this->email."'";
            else $query = "UPDATE prestador SET foto = '".$foto."' WHERE `email` = '".$this->email."'";
            mysqli_query($this->link, $query);
        }

        public function setTelefone($tele){
            $query = "INSERT INTO telefone (numero) VALUES ('".$tele."')";
            mysqli_query($this->link, $query);
            $id = mysqli_insert_id($this->link);
            if($this->tipo == 'cliente') $query = "INSERT INTO cliente_has_telefone (Cliente_email, Telefone_id)
            VALUES ('".$this->email."', '".$id."')";
            else $query = "INSERT INTO prestador_has_telefone (Prestador_email, Telefone_id)
            VALUES ('".$this->email."', '".$id."')";
            mysqli_query($this->link, $query);
        }
    }
?>
