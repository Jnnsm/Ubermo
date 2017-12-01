<?php include 'menu.php'; if(!isset($_SESSION['email'])){header("Location: index.php"); exit();}?>
<body>
    <div id='box'>
        <div style="padding-top:30px;text-align: center;text-justify: inter-word;">
            <b>Cadastro de Endereço</b>
        </div>
        <form method="post" style="margin-top: 30px;">
            <input type="text" name="rua" placeholder = "Endereço: Rua"><br>
            <input type="text" name="numero" placeholder = "Endereço: Número"><br>
            <input type="text" name="complemento" placeholder = "Endereço: Complemento"><br>
            <input type="text" name="bairro" placeholder = "Endereço: Bairro"><br>
            <input type="text" name="estado" placeholder = "Endereço: Estado"><br>
            <input type="text" name="cidade" placeholder = "Endereço: Cidade"><br>
            <input type="text" name="pais" placeholder = "Endereço: País"><br>
            <input type="submit" value="Confirmar">
        </form>
    </div>
</body>
<?php
    if($_POST){
        if(isset($_POST['pais']) && isset($_POST['estado']) &&
        isset($_POST['cidade']) && isset($_POST['rua']) && isset($_POST['numero']) &&
        isset($_POST['bairro'])){
            if(is_numeric($_POST['numero'])){
                $user->setEndereco($_POST['rua'], $_POST['numero'], $_POST['bairro'],
                $_POST['cidade'], $_POST['estado'], $_POST['pais'], $_POST['complemento']);
                echo '<script> alert("Endereço inserido com sucesso"); </script>';
            }
            else echo '<script> alert("Endereço inválido"); </script>';
        }
        else echo '<script> alert("Endereço inválido"); </script>';
    }
?>
<?php include 'footer.php'; ?>
