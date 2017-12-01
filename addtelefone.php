<?php include 'menu.php'; if(!isset($_SESSION['email'])){header("Location: index.php"); exit();}?>
<body>
    <div id='box'>
        <div style="padding-top:30px;text-align: center;text-justify: inter-word;">
            <b>Cadastro de Telefone</b>
        </div>
        <form method="post" style="margin-top: 30px;">
            <input type="text" name="telefone" placeholder = "Telefone"><br>
            <input type="submit" value="Confirmar">
        </form>
    </div>
</body>
<?php
    if($_POST && isset($_POST['telefone'])){
        if(is_numeric($_POST['telefone'])){
            $user->setTelefone($_POST['telefone']);
            echo '<script> alert("Telefone inserido com sucesso"); </script>';
        }
        else
            echo '<script> alert("Telefone inválido"); </script>';
    }
?>

<?php include 'footer.php'; ?>
