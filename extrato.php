<?php include 'menu.php'; if(!isset($_SESSION['email'])){header("Location: index.php"); exit();}?>
<body>
    <div id='box'>
        <div style="padding-top:30px;text-align: center;text-justify: inter-word;">
            <b>Extrato</b>
        </div>
        <?php $user->getBalanco(); ?>
    </div>
</body>
<?php include 'footer.php'; ?>
