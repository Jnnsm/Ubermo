<?PHP
    include 'menu.php';
    include 'footer.php';
    session_destroy();
    header("Location: index.php"); /* Redirect browser */
    exit();
?>
