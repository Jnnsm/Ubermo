<?php include 'menu.php'; ?>
<body>
    <div id="box">
        <div style="width: 50%; float:left;">
            <div id="logbox">
                <form>
                    <p style="display: inline-block;margin: auto;" align= "left"><b>Crie sua conta <span style="color: #ae000e;">grátis</span></b></p>
                    <input style="margin-top:30px;" type="text" name="nomep" placeholder = "Nome"><br>
                    <input type="text" name="chavep" placeholder = "E-mail"><br>
                    <input type="text" name="telefonep" placeholder = "Telefone"><br>
                    <input type="password" name="senhap" placeholder = "Senha"><br>
                    <input type="password" name="senhacp" placeholder = "Confirmar Senha"><br>
                    <input maxlength="11" type="text" name="cpfp" placeholder = "CPF/CNPJ"><br><br>
                    <input type="text" name="paisp" placeholder = "Endereço: País"><br>
                    <input type="text" name="estadop" placeholder = "Endereço: Estado"><br>
                    <input type="text" name="cidadep" placeholder = "Endereço: Cidade"><br>
                    <input type="text" name="ruap" placeholder = "Endereço: Rua"><br>
                    <input type="text" name="numerop" placeholder = "Endereço: Número"><br>
                    <input type="text" name="complementop" placeholder = "Endereço: Complemento"><br>
                    <input type="text" name="bairrop" placeholder = "Endereço: Bairro"><br><br>
                    <input type="text" name="agencia" placeholder = "Agência do Banco"><br>
                    <input type="text" name="numeroconta" placeholder = "Número da Conta"><br><br>
                    <input type="submit" value="Confirmar">
                </form>
            </div>
        </div>
        <div style="width: 50%; float:right;padding-top:30px;text-align:justify;text-justify: inter-word;">
            <b>A sua senha é a sua chave mestra de criptografia.</b><br>
            <br>A segurança da sua conta depende da dificuldade da sua senha. Senhas que são muito curtas, muito simples ou que incluem palavras do dicionário são fáceis de adivinhar.<br>
            <br><b>Não esqueça da sua senha.</b><br>
            <br>Não existe nenhum procedimento para recuperar senhas perdidas. Se você não conseguir lembrar da sua senha, você já não poderá acessar os seus dados armazenados.<br>
            <br><b>A sua conta é tão segura quanto o seu próprio computador.</b><br>
            <br>Nunca digite a sua senha em um dispositivo no qual você não confie totalmente, nem faça login na sua conta em um computador público.<br>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>
