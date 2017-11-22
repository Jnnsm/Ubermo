<?php include 'menu.php'; ?>
<body>
    <div id='box'>
        <div id='userbox'>
            <div id='userbox-image'>
                <?php
                    echo "<img src= '".$user->getFoto()."' height='100%' width='100%'>";
                ?>
            </div>
            <div id='userbox-buttons'>
                <a onclick="addimagem()" id='buttons'>Trocar foto</a>
                <a onclick="addTelefone()" id='buttons'>Adicionar Telefone</a>
                <a onclick="" id='buttons'>Adicionar Endereço</a>
            </div>
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

            }
        ?>
</body>

<script>
    function addimagem() {
         var imagem = prompt("Link da imagem:", 'https://goo.gl/1ZQr7W');
         imagem = encodeURIComponent(imagem);
         if(imagem != 'null'){ window.location.href = "painel.php?image=" + imagem; }
    }
    function addTelefone() {
         var telefone = prompt("Telefone:", 'xxxxxxxxxxx');
         if(telefone != 'null' && telefone != 'xxxxxxxxxxx'){ window.location.href = "painel.php?telefone=" + telefone; }
    }
</script>

<?php include 'footer.php'; ?>
