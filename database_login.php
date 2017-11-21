<?php
    function login($l){
        $email = $_POST['nome'];
        $senha = sha1($_POST['senha']);

        $query = "SELECT * FROM cliente WHERE `email` = '$email' and `senha` = '$senha'";
        $result = mysqli_query($l, $query);

        if($result->num_rows > 0){
            $result->free();
            $senha = '';
        }
        else{
            header("Location: index.php"); /* Redirect browser */
            exit();
        }
        date_default_timezone_set("America/Sao_Paulo");
        $_SESSION['email'] = $email;
        $_SESSION['date'] = date('d-m-y');
        $_SESSION['time'] = date('H:i:s');
        header("Location: index.php"); /* Redirect browser */
        exit();
    }
?>
