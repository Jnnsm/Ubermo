<?php include 'menu.php'; if(!isset($_SESSION['email']) || $user->getTipo() != 'cliente'){header("Location: index.php"); exit();}?>
<body>
    <div id="box" class="limit-box">
        <?php
            if(isset($_GET['contratar'])){
                $auxCont = $_GET['contratar'];
                echo "<b>Escolha o endereço cadastrado</b>
                <form method='post' style='margin-bottom: 30px;'>
                    <select name='endereco' id='addserv'>";
                    $result = $user->getEndereco();
                    for($i = $result->num_rows; $i > 0; $i--){
                        $obj = $result->fetch_object();
                        echo "<option value='$obj->id'> $obj->rua, &nbsp $obj->numero, 
                        &nbsp $obj->bairro, &nbsp $obj->cidade, &nbsp $obj->estado,
                         &nbsp $obj->pais, &nbsp $obj->complemento </option>";
                    }
                 echo"</select>
                        <input type='text' name='tempo' placeholder='Tempo'>
                        <input type='submit' value='Confirmar'>
                    </form>";

                echo "Ou preencha os dados abaixo";

                echo "<form method='post' style='margin-top: 30px;'>
                            <input type='text' name='rua' placeholder = 'Rua'><br>
                            <input type='text' name='numero' placeholder = 'Numero'><br>
                            <input type='text' name='bairro' placeholder = 'Bairro'><br>
                            <input type='text' name='cidade' placeholder = 'Cidade'><br>
                            <input type='text' name='estado' placeholder = 'Estado'><br>
                            <input type='text' name='pais' placeholder = 'Pais'><br>
                            <input type='text' name='complemento' placeholder = 'Complemento'><br>
                            <input type='text' name='tempo' placeholder='Tempo'>
                            <input type='submit' value='Confirmar'>
                    </form>";
            } else{
                header("Location: servicos.php");
                exit();
            }

            

        ?>
    </div>
</body>
<?php
    if($_POST && isset($_POST['endereco']) && isset($_POST['tempo'])){
        $end = $_POST['endereco'];
        $tempo = $_POST['tempo'];
        $user->fazerContrato($auxCont, $end, $tempo);
        header("Location: painel.php");
        exit();
    } else if($_POST && isset($_POST['rua']) && isset($_POST['numero']) && isset($_POST['bairro'])
            && isset($_POST['cidade']) && isset($_POST['estado']) && isset($_POST['pais'])
            && isset($_POST['complemento']) && isset($_POST['tempo'])){
                if(!is_numeric($_POST['numero']) || !is_numeric($_POST['tempo']))
                    echo "Não numerico";
                else{
                    $tempID = $user->setEndereco($_POST['rua'], $_POST['numero'], $_POST['bairro'],
                    $_POST['cidade'], $_POST['estado'], $_POST['pais'],$_POST['complemento'] );
                    $tempo = $_POST['tempo'];
                    $user->fazerContrato($auxCont, $tempID, $tempo);
                    header("Location: painel.php");
                    exit();
                }
                

    }
?>
<?php include 'footer.php'; ?>
