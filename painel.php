<?php include 'menu.php'; if(!isset($_SESSION['email'])){header("Location: index.php"); exit();}?>
<body>
    <div id='box'>
        <div id='userbox'>
            <div id='userbox-image'>
                <?php
                    echo "<img src= '".$user->getFoto()."' height='100%' width='100%'>";
                ?>
            </div>
            <div id='userbox-buttons'>
                <a onclick="addImagem()" id='buttons'>Trocar foto</a>
                <a onclick='window_conf(`addtelefone.php`)' id='buttons'>Adicionar Telefone</a>
                <a onclick='window_conf(`addendereco.php`)' id='buttons'>Adicionar Endereço</a>
                <?php if($user->getTipo() == 'prestador')
                    echo "<a id='buttons' onclick='window_conf(`addservico.php`)'>
                    Adicionar Serviço</a>"; ?>
                <a id='buttons' onclick='window_conf("extrato.php")'>Extrato</a>
            </div>
        </div>
        <div id='userinformation'>
            <?php
                $user->getDados();
            ?>
        </div>

        <?php
            $user->getServico_pendente();
        ?>

        <div class='box-all' >
            <div class='box-main' align='center'>
            <?php
                $result = $user->servFinalizados();
                if($result->num_rows >0){
                    echo "<h2 align=center> Avaliações pendentes </h2> <br>";
                    if($user->getTipo() == 'cliente') $str = "Prestador"; else $str = "Cliente";
                    for($i = $result->num_rows; $i > 0; $i--){
                        $j = $result->fetch_object();
                        echo "<div id='servico-box' align='center'>
                                <b>Serviço:</b> &nbsp $j->nome2 <br>
                                <b>Data:</b> &nbsp $j->data <br>
                                <b>$str:</b> &nbsp $j->nome1 <br>
                                <b align=center> Nota: </b>
                                <form action='painel.php' method='post'>
                                    <select name='nota' id='select-nota'>
                                        <option value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                    </select>
                                    <input type='hidden' name='SCid' value='$j->id' />
                                    <input type='hidden' name='email' value='$j->email' />
                                    <textarea style='margin-top:5px; display:block'
                                    name='com' placeholder = 'Comentário'></textarea>
                                    <br>
                                    <input type='submit' value='Avaliar'>
                                </form>
                            </div>";
                    }
                } else   echo "<h2 align=center> Não há avaliações pendentes </h2> <br>"
            ?>
            </div>
        </div>
    </div>
        <?php
            if(isset($_GET['image'])){
                $user->setFoto($_GET['image']);
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'; />";
            }

            //Checa se o botão delete de telefone foi apertado
            if (isset($_GET['tele'])) {
                $user->delTelefone($_GET['tele']);
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'; />";
            }
            if($user->getTipo() == 'prestador')
                if (isset($_GET['servof'])) {
                    $user->delServ($_GET['servof']);
                }
            //Mudar status para finalizado
            if (isset($_GET['mudarstatus'])) {
                $user->status($_GET['mudarstatus']);
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'; />";
            }
            if(isset($_GET['deletarstatus'])){
                $user->status($_GET['deletarstatus'], 'delete');
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'; />";
            }
            //Checa se o botão delete do endereço foi apertado
            if (isset($_GET['rua']) && isset($_GET['numero']) && isset($_GET['bairro']) &&
            isset($_GET['cidade']) && isset($_GET['estado']) && isset($_GET['pa'])) {

                $user->delEndereco($_GET['rua'], $_GET['numero'], $_GET['bairro'],
                $_GET['cidade'], $_GET['estado'], $_GET['pa'], $_GET['complemento']);
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'; />";
            }

            //Checa qual foi a nota dada para o determinado serviço
            if (isset($_POST['SCid']) && isset($_POST['nota']) && isset($_POST['com'])
                && isset($_POST['email'])) {
                $user->insertNota($_POST['SCid'], $_POST['nota'],$_POST['com'], $_POST['email'] );
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'; />";
            }
        ?>
</body>

<script>
    function addImagem() {
        var imagem = prompt("Link da imagem:", 'https://goo.gl/1ZQr7W');
        if(imagem != null){imagem = encodeURIComponent(imagem); window.location.href = "painel.php?image=" + imagem; }
    }
    function window_conf(pagina){
        window.open(pagina, '_blank', ',width=500,height=500,toolbar=0,resizable=0');
        return false;
    }
</script>

<?php include 'footer.php'; ?>
