<div class="box-main" align='center'>
        <h2> Melhores Prestadores </h2>
        <?php
            $result = $user->prestMelhor();
            for($i = 0; $i<$result->num_rows && $i < 5; $i++ ){
                $j = $result->fetch_object();
                echo "<div id='servico-box' align='center'>
                <img src=$j->foto height=80 width=60> <br>
                <b>Nome:</b> &nbsp<a id='button-cont-rev' style='font-size: 100%;'
                href='perfil.php?prestEmail=".$j->email." ' >$j->nome</a> <br>
                <b>Pontuação:</b> &nbsp $j->pontuacao <br>
                </div>";
            }
        ?>
</div>
<div class="box-main" align='center'>
        <h2> Serviços mais procurados </h2>
        <?php
            $result = $user->servProcurado();
            for($i = 0; $i<$result->num_rows && $i < 5; $i++ ){
                $j = $result->fetch_object();
                echo "<div id='servico-box' align='center'>
                <b>Serviço:</b> &nbsp $j->nome <br>
                <b>Pagamento:</b> &nbsp $j->tipo <br>
                <a href='servicos.php?servNome=".$j->nome."' id='button-cont-rev' >Prestadores</a> <br>
                </div>";
            }
        ?>
</div>

<div class="box-main" align='center'>
        <h2> Serviços mais baratos </h2>
        <?php
            $result = $user->servBaratos();
            for($i = 0; $i<$result->num_rows && $i < 5; $i++ ){
                $j = $result->fetch_object();
                echo "<div id='servico-box' align='center'>
                <b>Serviço:</b> &nbsp $j->nome <br>
                <b>Pagamento:</b> &nbsp $j->tipo <br>
                <b>Valor:</b> &nbsp $j->valor <br>
                <b>Prestador:</b> &nbsp <a id='button-cont-rev' style='font-size: 100%;'
                href='perfil.php?prestEmail=".$j->prestEmail." ' >$j->Pnome</a> <br>
                <a href='escolha_end.php?contratar=".$j->id."'
                id='button-cont' >Contratar</a> <br>
                </div>";
            }
        ?>
</div>

<div class="box-main" align='center'>
        <h2> Prestadores da sua cidade </h2>
        <?php
            $result = $user->servCidades();
            for($i = 0; $i<$result->num_rows && $i < 5; $i++ ){
                $j = $result->fetch_object();
                echo "<div id='servico-box' align='center'>
                <img src=$j->foto height=80 width=60> <br>
                <b>Nome:</b> &nbsp<a id='button-cont-rev' style='font-size: 100%;'
                href='perfil.php?prestEmail=".$j->email." ' >$j->nome</a> <br>
                <b>Pontuação:</b> &nbsp $j->pontuacao <br>
                </div>";
            }
        ?>
</div>

<div class="box-main" align='center'>
        <h2> Clientes com mais contratações  </h2>
        <h3> Hora:  </h3>
        <?php
            $result = $user->clienteContratoHora();
            for($i = 0; $i<$result->num_rows && $i < 5; $i++ ){
                $j = $result->fetch_object();
                echo "<div id='servico-box' align='center'>
                <b>Nome:</b> &nbsp $j->nome <br>
                <b>Pontuação:</b> &nbsp $j->pontuacao <br>
                </div>";
            }
        ?>
        <h3> Dia:  </h3>
        <?php
            $result = $user->clienteContratoDia();
            for($i = 0; $i<$result->num_rows && $i < 5; $i++ ){
                $j = $result->fetch_object();
                echo "<div id='servico-box' align='center'>
                <b>Nome:</b> &nbsp $j->nome <br>
                <b>Pontuação:</b> &nbsp $j->pontuacao <br>
                </div>";
            }
        ?>
</div>
