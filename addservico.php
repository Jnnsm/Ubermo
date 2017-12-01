<?php include 'menu.php'; if(!isset($_SESSION['email']) || $user->getTipo() != 'prestador'){header("Location: index.php"); exit();}?>
<body>
    <div id='box'>
        <div style="padding-top:30px;text-align: center;text-justify: inter-word;">
            <b>Cadastro de Serviço</b>
        </div>
        <form method="post" style="margin-top: 30px;">
            <select name="service" id="addserv">
                <?php
                    $result = $user->servDispo();
                    for($i = $result->num_rows; $i > 0; $i--){
                        $obj = $result->fetch_object();
                        echo '<option value='.$obj->id.'>'.$obj->nome.'</option>';
                    }
                ?>
            </select>
            <input style="margin-top:5px;" type="text" name="valor" placeholder = "Valor"><br>
            <input type="submit" value="Confirmar">
        </form>
    </div>
</body>
<?php
    if($_POST && isset($_POST['service']) && isset($_POST['valor'])){
        if(is_numeric($_POST['valor']))
            $user->setServico_ofertado($_POST['service'], $_POST['valor']);
    }
?>
<?php include 'footer.php'; ?>
