<?php
include "class_prestador_cadastro.php";
function cadastro_p($l){
    $prestador = new Prestador_cadastro($_POST['nomep'], $_POST['chavep'], $_POST['telefonep']
    ,sha1($_POST['senhap']), sha1($_POST['senhacp']), $_POST['cpfp'],
    $_POST['paisp'], $_POST['estadop'], $_POST['cidadep'], $_POST['ruap'],
    $_POST['numerop'], $_POST['complementop'], $_POST['bairrop'],
    $_POST['agencia'], $_POST['numeroconta']);

    if($prestador->validEntry()){
        $prestador->prestadorSet($l);
    }
    else{
        echo '<script type="text/javascript" src="popup.js"></script>';
        echo '<script> alert("Dados Inválidos"); </script>';
    }
}
?>
