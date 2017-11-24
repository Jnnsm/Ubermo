<?php include 'menu.php'; if(!isset($_SESSION['email'])){header("Location: index.php"); exit();}?>
<body>
    <div id='box'>
        <div id='userbox'>
            <div id='userbox-image'>
                <?php
                    echo "<img src= '".$user->getFoto()."' height='100%' width='100%'>";
                ?>
            </div>
            <div id='userbox-buttons'>
                <a onclick="addImagem()" id='buttons'>Trocar foto</a>
                <a onclick="addTelefone()" id='buttons'>Adicionar Telefone</a>
                <a onclick="addEndereco()" id='buttons'>Adicionar Endereço</a>
            </div>
        </div>
        <div id='userinformation'>
            <?php $user->getDados(); ?>
        </div>
    </div>
        <?php
            if(isset($_GET['image'])){
                $user->setFoto($_GET['image']);
                header("Location: painel.php");
                exit();
            }
            if(isset($_GET['telefone'])){
                $user->setTelefone($_GET['telefone']);
                header("Location: painel.php");
                exit();
            }
            if(isset($_GET['telefone'])){
                $user->setTelefone($_GET['telefone']);
                header("Location: painel.php");
                exit();
            }
            if(isset($_GET['rua']) && isset($_GET['numero']) && isset($_GET['bairro']) &&
            isset($_GET['cidade']) && isset($_GET['pais']) && isset($_GET['estado'])){

                $user->setEndereco($_GET['rua'], $_GET['numero'], $_GET['bairro'],
                $_GET['cidade'], $_GET['estado'], $_GET['pais'], $_GET['complemento']);
            }
        ?>
</body>

<script>
    function addImagem() {
        var imagem = prompt("Link da imagem:", 'https://goo.gl/1ZQr7W');
        if(imagem != null){imagem = encodeURIComponent(imagem); window.location.href = "painel.php?image=" + imagem; }
    }
    function addTelefone() {
        var telefone = prompt("Telefone:", 'xxxxxxxxxxx');
        if(telefone != null && !isNaN(telefone)){ window.location.href = "painel.php?telefone=" + telefone; }
    }
    function addEndereco() {
        var rua, numero, bairro, cidade, estado, pais, complemento;
        rua = prompt("Rua:", 'Travessa Vereador Jose Valentino da Cruz');
        numero = prompt("Numero:", '50');
        complemento = prompt("Complemento:", 'Ap. 301');
        bairro = prompt("Bairro:", 'Centro');
        cidade = prompt("Cidade:", 'Vicosa');
        estado = prompt("Estado:", 'Minas Gerais');
        pais = prompt("País:", 'Brasil');
        if(rua != null && numero != null && bairro != null && cidade != null &&
        estado != null && pais != null && !isNaN(numero)){
            rua = encodeURIComponent(rua);
            complemento = encodeURIComponent(complemento);
            bairro = encodeURIComponent(bairro);
            cidade = encodeURIComponent(cidade);
            estado = encodeURIComponent(estado);
            pais = encodeURIComponent(pais);
            window.location.href = "painel.php?rua=" + rua + "&numero=" +
            numero + "&complemento=" + complemento + "&bairro=" + bairro +
            "&cidade=" + cidade + "&estado=" + estado + "&pais=" + pais;
        }
    }
</script>

<?php include 'footer.php'; ?>
