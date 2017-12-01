<head>
    <?php include 'menu.php';?>
</head>

<body>
    <div>
        <img src="css/UBERMO_IMAGE.png" alt="Ubermo Services" width="100%">
    </div>
    <?php
        if(isset($_SESSION['email']))
            include 'user_index.php';
    ?>
</body>


<?php include 'footer.php'; ?>
