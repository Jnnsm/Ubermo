<head>
    <meta charset = "UTF-8">
    <?php include 'menu.php';?>
    <title>UBERMO</title>
</head>

<body>
    <div id='box' style='margin-top:30px;'>
        <?php
            if(isset($_GET['servNome'])){
                $result = $user->prestadoresServico($_GET['servNome']);
                for($i = $result->num_rows; $i > 0; $i--){
                    $j = $result->fetch_object();
                    echo "<div id='servico-box' align='center'>
                        <img src=$j->foto height=80 width=60> <br>
                        <b>Nome:</b> &nbsp<a id='button-cont' style='font-size: 100%;' 
                        href='perfil.php?prestEmail=".$j->email." ' >$j->nome</a> <br>
                        <b>Pontuação:</b> &nbsp $j->pontuacao <br>
                        <b>Valor:</b> &nbsp $j->valor <br>
                        <b>Forma de pagamento:</b> &nbsp $j->tipo <br>
                        <a href='escolha_end.php?contratar=".$j->id."' id='button-cont' >Contratar</a> <br>
                        </div>";
                }                
            } 
            else{
                $result = $user->servDispo();
                for($i = $result->num_rows; $i > 0; $i--){
                    $j = $result->fetch_object();
                    echo "<div id='servico-box' align='center'>
                            <b>Serviço:</b> &nbsp $j->nome <br>
                            <b>Tipo de pagamento:</b> &nbsp $j->tipo <br>
                            <a href='servicos.php?servNome=".$j->nome."' id='button-cont' >Prestadores</a> <br>
                        </div>";
                }
            }
        
            
        ?>
        </div>        
    </div>
</body>

<?php include 'footer.php'; ?>