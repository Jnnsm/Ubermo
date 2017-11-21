<?php
function cadastro($l){
    $nome = $_POST['nome'];
    $email = $_POST['chave'];
    $senha = sha1($_POST['senha']);
    $senhaconf = sha1($_POST['senhac']);
    $cpf = $_POST['cpf'];

    if($nome != '' && $email != '' && $senha != '' && $senhaconf != ''
    && $senha == $senhaconf && $cpf != ''){
        $query = "INSERT INTO cliente (email, nome, senha, foto, cpf,
            pontuacao) VALUES ('".$email."', '".$nome."','".$senha."','https://goo.gl/1ZQr7W',
            '".$cpf."',0)";
            if(mysqli_query($l, $query)){
                echo '<script type="text/javascript" src="popup.js"></script>';
                echo '<script> alert("Registro feito"); </script>';
            }
            else{
                echo '<script type="text/javascript" src="popup.js"></script>';
                echo '<script> alert("Usuário já cadastrado"); </script>';
            }
        }
        else{
            echo '<script type="text/javascript" src="popup.js"></script>';
            echo '<script> alert("Dados Inválidos"); </script>';
        }
        echo '<script> alert(mysqli_error($l)); </script>';
    }
?>
