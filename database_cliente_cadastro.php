<?php
include "class_cliente_cadastro.php";
function cadastro($l){
    $cliente = new Cliente_cadastro($_POST['nome'], $_POST['chave'], $_POST['telefone']
    ,sha1($_POST['senha']), sha1($_POST['senhac']), $_POST['cpf'],
    $_POST['pais'], $_POST['estado'], $_POST['cidade'], $_POST['rua'],
    $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cartao'],
    $_POST['cartaova'], $_POST['cartaovm'], $_POST['cartaocs']);

    if($cliente->validEntry()){
        $cliente->clienteSet($l);
    }
    else{
        echo '<script type="text/javascript" src="popup.js"></script>';
        echo '<script> alert("Dados Inválidos"); </script>';
    }
}
?>
