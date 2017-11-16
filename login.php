<?php include 'menu.php'; ?>
<body>
    <div id="box">
        <div style="width: 50%; float:left;">
            <div id="logbox">
                <form method="post">
                    <p style="display: inline-block;margin: auto;" align= "left"><b>Entrar</b></p>
                    <p style="float: right;display: inline-block;margin: auto;">ou <a id="normalhl" href="cadastro.php">crie uma conta</a></p>
                    <input style="margin-top:30px;" type="text" name="nome" placeholder = "E-mail"><br>
                    <input type="password" name="senha" placeholder = "Senha"><br><br>
                    <input type="submit" value="Confirmar">
                </form>
            </div>
        </div>
        <div style="width: 50%; float:right;padding-top:30px;text-align:justify;text-justify: inter-word;">
            <b>A sua conta é tão segura quanto o seu próprio computador.</b><br><br>
            Nunca digite a sua senha em um dispositivo no qual você não confie
            totalmente, nem faça login na sua conta em um computador
            público.<br>
            Para uma segurança aprimorada, não seja um idiota.<br>
            <p style="float: right;display: inline-block;margin: 40px auto;">Você quer se tornar um prestador? <a id="normalhl" href="cadastro_prest.php">Crie uma conta aqui</a></p>
        </div>
    </div>
    <?php
        if($_POST){
            $email = $_POST['nome'];
            $senha = $_POST['senha'];
            date_default_timezone_set("America/Sao_Paulo");
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['date'] = date('d-m-y');
            $_SESSION['time'] = date('H:i:s');
            header("Location: index.php"); /* Redirect browser */
            exit();
        }
    ?>
</body>
<?php include 'footer.php'; ?>
