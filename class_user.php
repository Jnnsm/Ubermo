<?php
    class User{
        private $email, $tipo, $link;

        public function __construct($e, $t, $l){
            $this->email = $e;
            $this->tipo = $t;
            $this->link = $l;
            date_default_timezone_set("America/Sao_Paulo");
        }

        function quantTelefone(){ //Retorna o numero de telefones que o usuario possui
            if($this->tipo == 'cliente'){
                $query = "SELECT numero FROM telefone, cliente_has_telefone
                WHERE Cliente_email = '".$this->email."' and Telefone_id = id";
                $result = (mysqli_query($this->link, $query));
                return $result->num_rows;
            }
            else{
                $query = "SELECT numero FROM telefone, prestador_has_telefone
                WHERE Prestador_email = '".$this->email."' and Telefone_id = id";
                $result = (mysqli_query($this->link, $query));
                return $result->num_rows;
            }
        }

        function quantEndereco(){ //Retorna o numero de endereços que o usuario possui
            if($this->tipo == 'cliente'){
                $query = "SELECT rua, numero, bairro, cidade, estado,
                pais, complemento FROM endereco, cliente_has_endereco WHERE
                Cliente_email = '".$this->email."' and `Endereco_id` = `id`";
                $result = (mysqli_query($this->link, $query));
                return $result->num_rows;
            }
            else{
                $query = "SELECT rua, numero, bairro, cidade, estado,
                pais, complemento FROM endereco, prestador_has_endereco WHERE
                Prestador_email = '".$this->email."' and `Endereco_id` = `id`";
                $result = (mysqli_query($this->link, $query));
                return $result->num_rows;
            }
        }

        public function delTelefone($tel){ //deleta o telefone indicado no banco de dados
            if($this->tipo == 'cliente'){
                $query = "SELECT * FROM cliente_has_telefone, telefone WHERE `Cliente_email` =
                '".$this->email."' and `numero` = '".$tel."' and `id` = `Telefone_id` ";
                $result = mysqli_query($this->link, $query);

                $telefoneID;
                if($result->num_rows > 0){
                    $telefoneID = $result->fetch_object()->Telefone_id;
                }

                $query2 = "DELETE FROM cliente_has_telefone WHERE `Telefone_id` = '".$telefoneID."'";
                $query3 = "DELETE FROM telefone WHERE `id` = '".$telefoneID."'";
                mysqli_query($this->link, $query2);
                mysqli_query($this->link, $query3);
            } else{
                $query = "SELECT * FROM prestador_has_telefone, telefone WHERE `Prestador_email` =
                '".$this->email."' and `numero` = '".$tel."' and `id` = `Telefone_id` ";
                $result = mysqli_query($this->link, $query);

                $telefoneID;
                if($result->num_rows > 0){
                    $telefoneID = $result->fetch_object()->Telefone_id;
                }

                $query2 = "DELETE FROM prestador_has_telefone WHERE `Telefone_id` = '".$telefoneID."'";
                $query3 = "DELETE FROM telefone WHERE `id` = '".$telefoneID."'";
                mysqli_query($this->link, $query2);
                mysqli_query($this->link, $query3);
            }
        }

        //deleta o endereço indicado no banco de dados
        public function delEndereco($rua, $numero, $bairro, $cidade, $estado, $pais, $complemento){
            if($this->tipo == 'cliente'){
                $query = "SELECT * FROM cliente_has_endereco, endereco WHERE `Cliente_email` =
                '".$this->email."' and `rua` = '".$rua."' and `numero` = '".$numero."' and `bairro` = '".$bairro."'
                and `cidade` = '".$cidade."' and `estado` = '".$estado."' and `pais` = '".$pais."'
                and `complemento` = '".$complemento."' and `id` = `Endereco_id` ";
                $result = mysqli_query($this->link, $query);

                $enderecoID;
                if($result->num_rows > 0){
                    $enderecoID = $result->fetch_object()->Endereco_id;
                }

                $query2 = "DELETE FROM cliente_has_endereco WHERE `Endereco_id` = '".$enderecoID."'";
                $query3 = "DELETE FROM endereco WHERE `id` = '".$enderecoID."'";
                mysqli_query($this->link, $query2);
                mysqli_query($this->link, $query3);
            } else{
                $query = "SELECT * FROM prestador_has_endereco, endereco WHERE `Prestador_email` =
                '".$this->email."' and `rua` = '".$rua."' and `numero` = '".$numero."' and `bairro` = '".$bairro."'
                and `cidade` = '".$cidade."' and `estado` = '".$estado."' and `pais` = '".$pais."'
                and `complemento` = '".$complemento."' and `id` = `Endereco_id` ";
                $result = mysqli_query($this->link, $query);

                $enderecoID;
                if($result->num_rows > 0){
                    $enderecoID = $result->fetch_object()->Endereco_id;
                }

                $query2 = "DELETE FROM prestador_has_endereco WHERE `Endereco_id` = '".$enderecoID."'";
                $query3 = "DELETE FROM endereco WHERE `id` = '".$enderecoID."'";
                mysqli_query($this->link, $query2);
                mysqli_query($this->link, $query3);
            }
        }

        public function servDispo(){ //retorna os serviços disponiveis para contrato
            $query = "SELECT * FROM servico WHERE 1";
            return  mysqli_query($this->link, $query);
        }

        public function servFinalizados(){ //retorna os serviços cons status de finalizado
            if($this->tipo == 'cliente'){
                $query = "SELECT P.nome AS nome1,  SC.data, SV.nome AS nome2, SC.id, Prestador_email AS email
                FROM `servico contratado` AS SC, `servico ofertado` AS SO, prestador AS P, servico AS SV
                WHERE Cliente_email = '".$this->email."' and estado = 'finalizado' and
                SO.id = `Servico Ofertado_id` and Prestador_email = email and SV.id = SO.Servico_id
                and ((SELECT COUNT(*) FROM avaliacao
                WHERE SC.id = `Servico Contratado_id` and destinado <> '".$this->email."') = 0) ";
                return  mysqli_query($this->link, $query);
            } else{
                $query = "SELECT C.nome AS nome1,  SC.data, SV.nome AS nome2, SC.id, Cliente_email AS email
                FROM `servico contratado` AS SC, `servico ofertado` AS SO, cliente AS C, servico AS SV
                WHERE Prestador_email = '".$this->email."' and estado = 'finalizado' and
                SO.id = `Servico Ofertado_id` and Cliente_email = email and SV.id = SO.Servico_id
                and ((SELECT COUNT(*) FROM avaliacao
                    WHERE SC.id = `Servico Contratado_id` and destinado <> '".$this->email."') = 0) ";
                 return mysqli_query($this->link, $query);
            }
        }

        //Retorna a tabela com os prestadores que fazem o serviço passado como parâmentro
        public function prestadoresServico($serv){
            $query = "SELECT prestador.foto, prestador.nome, prestador.pontuacao, valor,
            servico.tipo, `servico ofertado`.id, prestador.email
            FROM servico , `servico ofertado` , prestador
            WHERE servico.nome = '".$serv."' and Prestador_email = prestador.email and
            Servico_id = servico.id
            ORDER BY valor DESC";
            return mysqli_query($this->link, $query);
        }

        //Retorna a tabela com os serviços feitos pelo prestador passado como parâmentro
        public function servPrestador($prest){
            $query = "SELECT valor, servico.tipo, servico.nome, `servico ofertado`.id
            FROM servico , `servico ofertado` , prestador
            WHERE prestador.email = '".$prest."' and Prestador_email = prestador.email and
            Servico_id = servico.id
            ORDER BY valor DESC";
            return mysqli_query($this->link, $query);
        }

        //Faz o contrato com o id do serviço como parâmetro
        public function fazerContrato($idCont, $endID, $tempo){
            $query = "SELECT valor
            FROM `servico ofertado`
            WHERE  id = '".$idCont."' ";
            $result = mysqli_query($this->link, $query);
            $valor = $result->fetch_object()->valor;

            $date = date('Y-m-d');
            $time = date('H:i:s');
                echo $tempo;
            $query2 = "INSERT INTO `servico contratado`(`data`, `hora`,`tempo`, `valor`, `estado`,
            `Cliente_has_Endereco_Endereco_id`, `Cliente_email`, `Servico Ofertado_id`)
            VALUES (CAST('". $date ."' AS DATE), CAST('". $time ."' AS TIME), '".$tempo."' ,'".$valor."',
            'requisitado','".$endID."','".$this->email."', '".$idCont."' )";

            mysqli_query($this->link, $query2);
            echo mysqli_error($this->link);
        }

        //Retorna todos os endereços do cliente
        public function getEndereco($email = "default", $tipo = ""){
            if($email == "default"){
                $email = $this->email;
                $tipo = $this->tipo;
            }
            if($tipo == "cliente")
                $query = "SELECT * FROM endereco, cliente_has_endereco
                WHERE '".$email."' = Cliente_email and Endereco_id = id ";
            else if ($tipo == 'prestador')
                $query = "SELECT * FROM endereco, prestador_has_endereco WHERE
                Prestador_email = '".$email."' and `Endereco_id` = `id`";

            return mysqli_query($this->link, $query);
        }

        public function insertNota($SCid, $nota, $comenta, $email){ //insere uma avaliação
                $query = "INSERT INTO `avaliacao`(`nota`, `destinado`,
                `Servico Contratado_id`, `comentario`)
                VALUES ('".$nota."','".$email."','".$SCid."','".$comenta."')";
                mysqli_query($this->link, $query);
                $this->calcPont($email); //Calcula a pontuação a ser mostrada
        }

        function calcPont($email){ //Calcula a pontuação e insere na tabela cliente
            $query = "SELECT nota FROM avaliacao
            WHERE '".$email."' = destinado";
            $result = mysqli_query($this->link, $query);
            $cont = 0;
            for($i = $result->num_rows; $i > 0; $i--){
                $j = $result->fetch_object();
                $cont += $j->nota;
            }
            if($result->num_rows > 0)
                $cont = $cont/$result->num_rows;
            echo "nota:&nbsp". $cont;
            if($this->tipo == 'prestador'){
                $query = "UPDATE `cliente` SET `pontuacao`='".$cont."'
                         WHERE email = '".$email."' ";
            } else{
                $query = "UPDATE `prestador` SET `pontuacao`='".$cont."'
                         WHERE email = '".$email."' ";
            }
            mysqli_query($this->link, $query);
        }

        //Retorna os dados do prestador passado como parâmetro
        public function prestDados($presEmail){
            $query = "SELECT email, nome, pontuacao, numero
            FROM prestador, telefone AS TEL, prestador_has_telefone
            WHERE `email` = '".$presEmail."' AND Prestador_email = '".$presEmail."' AND
            Telefone_id =  id";

            return mysqli_query($this->link, $query);
        }

        //Retorna os servicos feito pelo prestador passado por parâmentro
        public function prestServFeito($presEmail){
            $query = "SELECT avaliacao.nota, avaliacao.comentario, avaliacao.destinado, servico.nome
                     FROM avaliacao, `Servico Contratado` AS SC, `Servico Ofertado` AS SO, servico
                     WHERE destinado = '".$presEmail."' AND `Servico Contratado_id`= SC.id AND
                     `Servico Ofertado_id` = SO.id AND Servico_id = servico.id ";

            $result = mysqli_query($this->link, $query);
            echo mysqli_error($this->link);
            return $result;
        }

        public function prestMelhor(){ //Retorna a lista dos prestadores com maiores  pontuações
            $query = "SELECT pontuacao, foto, nome, email
                     FROM prestador ORDER BY pontuacao DESC";
            return mysqli_query($this->link, $query);
        }

        public function servProcurado(){ //Retorna os serviços mais procurados
            $query = "SELECT S.nome, S.tipo
                     FROM servico AS S, `servico contratado` AS SC, `servico ofertado` AS SO
                     WHERE SC.`Servico Ofertado_id` = SO.id AND S.id = SO.Servico_id
                     GROUP BY S.nome
                     ORDER BY COUNT(SC.`Servico Ofertado_id`) DESC";
            return mysqli_query($this->link, $query);
        }

        public function servBaratos(){ //Retorna a lista dos serviços mais baratos
            $query = "SELECT S.nome, S.tipo, SO.Prestador_email AS prestEmail, SO.valor, SO.id, PR.nome AS Pnome
            FROM servico AS S, `servico contratado` AS SC, `servico ofertado` AS SO, prestador AS PR
            WHERE SC.`Servico Ofertado_id` = SO.id AND S.id = SO.Servico_id AND PR.email = SO.Prestador_email
            GROUP BY S.nome
            ORDER BY valor ASC";
            $result = mysqli_query($this->link, $query);
            echo mysqli_error($this->link);
            return $result;
        }

        public function clienteContratoHora(){ //Retorna clientes com maiores números de contratos
            $query = "SELECT C.nome, C.pontuacao
            FROM cliente AS C, `servico contratado` AS SC, `servico ofertado` AS SO,
            servico AS S
            WHERE SC.Cliente_email = C.email AND SC.`Servico Ofertado_id` = SO.id AND
            SO.Servico_id = S.id AND S.tipo = 'hora'
            ORDER BY COUNT(SC.Cliente_email) DESC";
            $result = mysqli_query($this->link, $query);
            echo mysqli_error($this->link);
            return $result;
        }

        public function clienteContratoDia(){ //Retorna clientes com maiores números de contratos
            $query = "SELECT C.nome, C.pontuacao
            FROM cliente AS C, `servico contratado` AS SC, `servico ofertado` AS SO,
            servico AS S
            WHERE SC.Cliente_email = C.email AND SC.`Servico Ofertado_id` = SO.id AND
            SO.Servico_id = S.id AND S.tipo = 'dia'
            ORDER BY COUNT(SC.Cliente_email) DESC";
            $result = mysqli_query($this->link, $query);
            echo mysqli_error($this->link);
            return $result;
        }

        public function servCidades(){
            $query = "SELECT prestador.pontuacao, prestador.foto, prestador.nome, prestador.email
                     FROM prestador, prestador_has_endereco, cliente_has_endereco,
                     endereco AS E, endereco AS E1
                     WHERE prestador.email = prestador_has_endereco.Prestador_email
                     and prestador_has_endereco.Endereco_id = E.id and
                     cliente_has_endereco.Endereco_id = E1.id and E.cidade = E1.cidade
                     and E.estado = E1.estado and E.pais = E1.pais
                     ORDER BY prestador.pontuacao DESC";
            $result = mysqli_query($this->link, $query);
            echo mysqli_error($this->link);
            return $result;
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
                    echo "Telefone " . $k . ": " . $j->numero;
                    if($this->quantTelefone() > 1){
                        echo "<a href='painel.php?tele=".$j->numero."' id='button-del' >deletar</a> <br>";
                    } else
                     echo "<br>";
                }

                for($i = $result3->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result3->fetch_object();
                    echo "Endereço " . $k . ": " . $j->rua . ", " . $j->numero
                    . ", " . $j->bairro . ", " . $j->complemento . ", " .
                    $j->cidade . ", " . $j->estado . ", " . $j->pais;
                    if($this->quantEndereco() > 1){
                        echo "<a href='painel.php?rua=".$j->rua."&numero=".$j->numero."&bairro=".$j->bairro."
                        &complemento=".$j->complemento."&cidade=".$j->cidade."&estado=".$j->estado."&pa=".$j->pais."' id='button-del' >deletar</a> <br>";
                    } else
                    echo "<br>";

                }

                for($i = $result4->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result4->fetch_object();
                    echo "Cartão " . $k . ": " . $j->numeroCartao . " ".
                    $j->mesVencimento . "/" . $j->anoVencimento . "<br>";
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
                    echo "Telefone " . $k . ": " . $j->numero;
                    if($this->quantTelefone() > 1){
                        echo "<a href='painel.php?tele=".$j->numero."' id='button-del' >deletar</a> <br>";
                    } else
                     echo "<br>";
                }

                for($i = $result3->num_rows, $k = 1; $i > 0; $i--, $k++){
                    $j = $result3->fetch_object();
                    echo "Endereço " . $k . ": " . $j->rua . ", " . $j->numero
                    . ", " . $j->bairro . ", " . $j->complemento . ", " .
                    $j->cidade . ", " . $j->estado . ", " . $j->pais;
                    if($this->quantEndereco() > 1){
                        echo "<a href='painel.php?rua=".$j->rua."&numero=".$j->numero."&bairro=".$j->bairro."
                        &complemento=".$j->complemento."&cidade=".$j->cidade."&estado=".$j->estado."&pa=".$j->pais."' id='button-del' >deletar</a> <br>";
                    } else
                    echo "<br>";
                }
                $this->getServico_ofertado();
            }
        }
        public function getFoto($email = "default"){
            if($email == "default"){
                $email = $this->email;
                $tipo = $this->tipo;
            }
            else{ $tipo = 'prestador'; }
            if($tipo == 'cliente') $query = "SELECT foto FROM cliente WHERE `email` = '".$email."'";
            else $query = "SELECT foto FROM prestador WHERE `email` = '".$email."'";
            $result = (mysqli_query($this->link, $query));
            return $result->fetch_object()->foto;
        }

        public function setFoto($foto){
            if($this->tipo == 'cliente') $query = "UPDATE cliente SET foto = '".$foto."' WHERE `email` = '".$this->email."'";
            else $query = "UPDATE prestador SET foto = '".$foto."' WHERE `email` = '".$this->email."'";
            mysqli_query($this->link, $query);
        }

        public function setTelefone($tele){
            if(!is_numeric($tele)) return;
            if($this->tipo == 'cliente') $query = "SELECT numero FROM telefone,
            cliente_has_telefone WHERE Cliente_email = '".$this->email."' and
            Telefone_id = id and numero = '".$tele."'";
            else $query = "SELECT numero FROM telefone,
            prestador_has_telefone WHERE Prestador_email = '".$this->email."' and Telefone_id = id and numero = '".$tele."'";
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
            if(!is_numeric($numero)) return;

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
            return $id;
        }
        public function getServico_ofertado(){
            if($this->tipo == 'prestador'){
                $query = "SELECT * FROM `servico ofertado`, servico WHERE Prestador_email =
                '".$this->email."' and Servico_id = servico.id";
                $result = mysqli_query($this->link, $query);
                for($i = $result->num_rows; $i > 0; $i--){
                    $obj = $result->fetch_object();
                    echo "Voce oferece " . $obj->nome . " por " . $obj->valor .
                    "$/" . $obj->tipo;
                    echo "<a href='painel.php?servof=".$obj->id."' id='button-del'>
                    deletar</a> <br>";
                }
            }
            else return;
        }

        public function delServ($serv){
            if($this->tipo == 'prestador'){
                $query = "DELETE FROM `servico ofertado` WHERE Servico_id =
                '".$serv."' and Prestador_email = '".$this->email."'";
                mysqli_query($this->link, $query);
            }
        }

        public function getServico_pendente(){
            if($this->tipo == 'prestador'){
                $query = "SELECT * FROM `prestador`, `servico ofertado` WHERE Prestador_email =
                '".$this->email."' and email = '".$this->email."'";
                $query2 = "SELECT * FROM `servico`, `servico ofertado` WHERE servico.id = Servico_id
                and Prestador_email = '".$this->email."'";
                $result = mysqli_query($this->link, $query);
                $result2 = mysqli_query($this->link, $query2);
                for($i = $result->num_rows; $i > 0; $i--){
                    $obj = $result->fetch_object()->id;
                    $obj2 = $result2->fetch_object()->nome;
                    $this->getPendente($obj, $obj2);
                }
            }
            else $this->getPendente();
        }

        public function getPendente($id = "", $nome = ""){
            if($this->tipo == 'prestador'){
                $query = "SELECT * FROM `servico contratado` WHERE `Servico Ofertado_id` =
                '".$id."' and (estado = 'pendente' OR estado = 'requisitado') ORDER BY estado";
                $result = mysqli_query($this->link, $query);

                if($result->num_rows > 0)
                    echo "<div id='userinformation'>";
                for($i = $result->num_rows; $i > 0; $i--){
                    $obj = $result->fetch_object();

                    $query2 = "SELECT * FROM endereco WHERE `id` =
                    '".$obj->Cliente_has_Endereco_Endereco_id."'";

                    $result2 = mysqli_query($this->link, $query2);
                    $obj2 = $result2->fetch_object();

                    $clientenome = "SELECT pontuacao FROM cliente WHERE email = '".$obj->Cliente_email."'";
                    $result3 = mysqli_query($this->link, $clientenome);
                    $obj3 = $result3->fetch_object();

                    echo "Voce tem um serviço de " .$nome. " datado de " . $obj->data . " no estado " . $obj->estado .
                    " no valor de $" . $obj->valor ." para " . $obj->Cliente_email . " que tem nota " .
                    $obj3->pontuacao ." no endereço: " . $obj2->rua . ", " . $obj2->numero .
                    ", " . $obj2->complemento . ", " . $obj2->bairro . ", " .
                    $obj2->cidade . ", " . $obj2->estado . ", " . $obj2->pais;
                    if($obj->estado == 'pendente') echo "<br>";
                    else echo "<a href='painel.php?mudarstatus=$obj->id' id='button-del'>
                    Aceitar</a> <a href='painel.php?deletarstatus=$obj->id' id='button-del'>
                    Negar</a><br>";
                }
                if($result->num_rows > 0)
                    echo "</div>";

            }

            else{
                $query = "SELECT * FROM `servico contratado` AS SC, `servico ofertado` AS SO
                WHERE Cliente_email = '".$this->email."' and estado = 'pendente' and
                SO.id = `Servico Ofertado_id`";
                $result = mysqli_query($this->link, $query);
                $resultarray = mysqli_query($this->link, $query);
                if($result->num_rows > 0)
                    echo "<div id='userinformation'>";
                for($i = $result->num_rows; $i > 0; $i--){
                    $obj = $result->fetch_object();

                    $query2 = "SELECT * FROM servico WHERE servico.id =
                    '".$obj->Servico_id."'";

                    $result2 = mysqli_query($this->link, $query2);
                    $obj2 = $result2->fetch_object();
                    $objarray = mysqli_fetch_array($resultarray);

                    echo "Voce tem um serviço de " .$obj2->nome. " contratado de " .
                    $obj->Prestador_email . " datado de " . $obj->data .
                    " no estado " . $obj->estado . " no valor de $" .
                    $obj->valor . "<a href='painel.php?mudarstatus=$objarray[0]'
                    id='button-del'>Finalizar</a><br>";
                }
                if($result->num_rows > 0)
                    echo "</div>";
            }
        }
        public function setServico_ofertado($id, $valor){
            if($this->tipo == 'prestador'){
                $query = "SELECT * FROM `servico ofertado`, servico WHERE Prestador_email =
                '".$this->email."' and Servico_id = servico.id and Servico_id = '".$id."'";
                $result = mysqli_query($this->link, $query);

                if($result->num_rows > 0)
                    return;

                $query = "SELECT * FROM `servico ofertado` WHERE Prestador_email =
                '".$this->email."'";
                $query2 = "SELECT pontuacao FROM `prestador` WHERE email =
                '".$this->email."'";
                $result = mysqli_query($this->link, $query);
                $result2 = mysqli_query($this->link, $query2);
                $pont = $result2->fetch_object()->pontuacao;

                if($result->num_rows >= 3 && $pont < 4)
                    return;
                else if($result->num_rows >= 5)
                    return;

                $query = "INSERT INTO `servico ofertado`(valor,
                Prestador_email, Servico_id) VALUES ('".$valor."',
                '".$this->email."','".$id."')";
                mysqli_query($this->link, $query);
            }
        }

        public function getTipo(){
            return $this->tipo;
        }

        public function getBalanco(){
            if($this->tipo == 'prestador')
                $query = "SELECT * FROM `servico ofertado`,`servico contratado`
                WHERE Prestador_email = '".$this->email."' and estado = 'finalizado' and
                `servico ofertado`.id = `Servico Ofertado_id` ORDER BY data, hora";
            else
                $query = "SELECT * FROM `servico contratado` WHERE Cliente_email =
                '".$this->email."' and estado = 'finalizado' ORDER BY data, hora";
            $sum = 0;
            $result = mysqli_query($this->link, $query);


            echo '<table id="customers">';
            echo '<tr>
              <th>Data</th>
              <th>Hora</th>
              <th>Custo</th>
            </tr>';
            for($i = $result->num_rows; $i > 0; $i--){
                $obj = $result->fetch_object();
                if($this->tipo == 'prestador'){
                    $sum += $obj->valor*$obj->tempo;
                    echo "<tr>" . "<td>" . $obj->data . "</td> " . "<td>" . $obj->hora .
                    "</td>" . "<td>" . "<p style='all:none; color:green; display:inline;'> $" .
                    $obj->valor*$obj->tempo . "</p></td></tr>";
                }
                else{
                    $sum -= $obj->valor*$obj->tempo;
                    echo "<tr>" . "<td>" . $obj->data . "</td> " . "<td>" . $obj->hora .
                    "</td>" . "<td>" . "<p style='all:none; color:red; display:inline;'> $-" .
                    $obj->valor*$obj->tempo . "</p></td></tr>";
                }
            }
            echo "<tr> <td></td> <td></td> <td> Seu balanço total no Ubermo é de: $" . $sum . " </td></tr>";
            echo '</table>';

        }
        public function status($id, $action = ""){
            if($this->tipo == 'cliente')
                $query = "UPDATE `servico contratado` SET `estado`= 'finalizado'
                WHERE id = '".$id."'";
            else if($this->tipo == 'prestador')
                if($action == "delete")
                    $query = "DELETE FROM `servico contratado` WHERE id =
                    '".$id."'";
                else
                    $query = "UPDATE `servico contratado` SET `estado`= 'pendente'
                    WHERE id = '".$id."'";
            $result = mysqli_query($this->link, $query);
        }
    }
?>
