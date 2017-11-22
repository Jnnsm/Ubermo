<?php
    include 'database_connect.php';
    include 'class_user.php';
    session_start();
    $link = connect();
?>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<div id="navbar">
    <a id="navbar-image" href="index.php" style="opacity:1;"></a>
    <div id = "links">
        <a href="index.php">Home</a>
        <?PHP
            if (!empty($_SESSION)){
                echo '<a href="painel.php">Painel</a> <a href="logout.php">Logout</a>';
                $user = new User($_SESSION['email'], $_SESSION['tipo'], $link);
            }
            else{
                echo '<a href="login.php">Entre</a>';
            }
        ?>
    </div>
</div>
