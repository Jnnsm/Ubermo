<?php include 'menu.php'; ?>
<body>
    <div id="box">
        <div style="width: 50%; float:left;">
            <div id="logbox">
                <form>
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
            Para uma segurança aprimorada, não seja um idiota.
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>
