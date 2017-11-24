<?php
    class User{
        private $email, $tipo, $link;

        public function __construct($e, $t, $l){
            $this->email = $e;
            $this->tipo = $t;
            $this->link = $l;
        }
        public function getDados(){
            if($this->tipo == 'cliente'){
                $query = "SELECT email, nome, cpf, pontuacao FROM cliente WHERE `email` = '".$this->email."'";

                $query2 = "SELECT numero FROM telefone, cliente_has_telefone
                WHERE Cliente_email = '".$this->email."' and Telefone_id = id";

                $query3 = "SELECT rua, numero, bairro, cidade, estado,
                pais, complemento FROM endereco, cliente_has_endereco WHERE
                Cliente_email = '".$this->email."' and `Endereco_id` = `id`";

                $query4 = "SELECT mesVencimento, anoVencimento, numeroCartao
                FROM cartao WHERE Cliente_email = '".$this->email."'";

                $result = (mysqli_query($this->link, $query));
                $result2 = (mysqli_query($this->link, $query2));
                $result3 = (mysqli_query($this->link, $query3));
                $result4 = (mysqli_query($this->link, $query4));

                $obj = $result->fetch_object();
                if($result->num_rows > 0){
                    echo "Email: " . $obj->email . "<br>";
                    echo "Nome: " . $obj->nome . "<br>";
                    echo "CPF/CNPJ: " . $obj->cpf . "<br>";
                    echo "Pontuação: " . $obj->pontuacao . "<br>";
                }

                for($i = $result2->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result2->fetch_object();
                    echo "Telefone " . $k . ": " . $j->numero . "<br>";
                }

                for($i = $result3->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result3->fetch_object();
                    echo "Endereço " . $k . ": " . $j->rua . ", " . $j->numero
                    . ", " . $j->bairro . ", " . $j->complemento . ", " .
                    $j->cidade . ", " . $j->estado . ", " . $j->pais . "<br>";

                }

                for($i = $result4->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result4->fetch_object();
                    echo "Cartão " . $k . ": " . $j->numeroCartao . " ".
                    $j->mesVencimento . "/" . $j->anoVencimento;
                }
            }
            else{
                $query = "SELECT email, nome, cpf, pontuacao, agencia, nconta
                FROM prestador WHERE `email` = '".$this->email."'";

                $query2 = "SELECT numero FROM telefone, prestador_has_telefone
                WHERE Prestador_email = '".$this->email."' and Telefone_id = id";

                $query3 = "SELECT rua, numero, bairro, cidade, estado,
                pais, complemento FROM endereco, prestador_has_endereco WHERE
                Prestador_email = '".$this->email."' and `Endereco_id` = `id`";

                $result = (mysqli_query($this->link, $query));
                $result2 = (mysqli_query($this->link, $query2));
                $result3 = (mysqli_query($this->link, $query3));

                $obj = $result->fetch_object();

                if($result->num_rows > 0){
                    echo "Email: " . $obj->email . "<br>" . "Nome: " .
                    $obj->nome . "<br>" . "CPF/CNPJ: " . $obj->cpf . "<br>" .
                    "Pontuação: " . $obj->pontuacao . "<br>" . "Agencia: " .
                    $obj->agencia . "<br>" . "Conta: " . $obj->nconta . "<br>";
                }

                for($i = $result2->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result2->fetch_object();
                    echo "Telefone " . $k . ": " . $j->numero . "<br>";
                }

                for($i = $result3->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result3->fetch_object();
                    echo "Endereço " . $k . ": " . $j->rua . ", " . $j->numero
                    . ", " . $j->bairro . ", " . $j->complemento . ", " .
                    $j->cidade . ", " . $j->estado . ", " . $j->pais . "<br>";

                }
            }
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
            if($this->tipo == 'cliente') $query = "SELECT numero FROM telefone,
            cliente_has_telefone WHERE Cliente_email = '".$this->email."' and
            Telefone_id = id and numero = '".$tele."'";
            else $query = "SELECT numero FROM telefone,
            prestador_has_telefone WHERE Prestador_email = '".$this->email."' and
            Telefone_id = id and numero = '".$tele."'";

            $result = mysqli_query($this->link, $query);
            if($result->num_rows > 0){
                return;
            }

            $query = "INSERT INTO telefone (numero) VALUES ('".$tele."')";
            mysqli_query($this->link, $query);
            $id = mysqli_insert_id($this->link);
            if($this->tipo == 'cliente') $query = "INSERT INTO
            cliente_has_telefone (Cliente_email, Telefone_id) VALUES
            ('".$this->email."', '".$id."')";

            else $query = "INSERT INTO prestador_has_telefone
            (Prestador_email, Telefone_id) VALUES ('".$this->email."', '".$id."'
            )";
            mysqli_query($this->link, $query);
        }

        public function setEndereco($rua, $numero, $bairro, $cidade, $estado,
        $pais, $complemento){
            if($this->tipo == 'cliente') $query = "SELECT * FROM endereco,
            cliente_has_endereco WHERE Cliente_email = '".$this->email."' and
            Endereco_id = id and rua = '".$rua."' and numero = '".$numero."' and
            bairro = '".$bairro."'  and cidade = '".$cidade."'  and
            estado = '".$estado."' and pais = '".$pais."'  and
            complemento = '".$complemento."'";

            else $query = "SELECT * FROM endereco,
            prestador_has_endereco WHERE Prestador_email = '".$this->email."' and
            Endereco_id = id and rua = '".$rua."' and numero = '".$numero."' and
            bairro = '".$bairro."'  and cidade = '".$cidade."'  and
            estado = '".$estado."' and pais = '".$pais."'  and
            complemento = '".$complemento."'";

            $result = mysqli_query($this->link, $query);
            if($result->num_rows > 0){
                return;
            }

            $query = "INSERT INTO endereco (rua, numero, bairro, cidade, estado,
            pais, complemento) VALUES ('".$rua."', '".$numero."', '".$bairro."',
            '".$cidade."', '".$estado."', '".$pais."', '".$complemento."')";

            mysqli_query($this->link, $query);
            $id = mysqli_insert_id($this->link);

            if($this->tipo == 'cliente') $query = "INSERT INTO
            cliente_has_endereco (Cliente_email, Endereco_id) VALUES
            ('".$this->email."', '".$id."')";

            else $query = "INSERT INTO prestador_has_endereco
            (Prestador_email, Endereco_id) VALUES ('".$this->email."', '".$id."'
            )";
            mysqli_query($this->link, $query);
        }
    }
?>
