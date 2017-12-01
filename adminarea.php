<script>
function admlog(){
    var user = prompt("Usuário:", '');
    var senha = prompt("Senha:", '');
    if(user != 'admin' && senha != 'admin') window.location.replace("index.php");
}
</script>

<?php
    include 'menu.php';
    if(isset($_SESSION['email'])){
        header("Location: index.php");
        exit();
    }
    echo "<script type='text/javascript'> admlog(); </script>";
?>
<body>
    <div id='box'>
        <div style="padding-top:30px;text-align: center;text-justify: inter-word;">
            <b>Serviço</b>
        </div>
        <form method="post" style="margin-top: 30px;">
            <input type="text" name="servico" placeholder = "Servico"><br>
            <input type="text" name="tipo" placeholder = "Tipo"><br>
            <input type="submit" value="Confirmar">
        </form>
    </div>
</body>

<?php

    if($_POST && isset($_POST['servico']) && isset($_POST['tipo'])){
        $servico = $_POST['servico'];
        $tipo = $_POST['tipo'];
        $query = "INSERT INTO `servico`(`nome`, `tipo`) VALUES ('".$servico."', '".$tipo."')";
        mysqli_query($link, $query);
        echo mysqli_error($link);
    }

?>
