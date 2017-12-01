<?php
    include 'menu.php';
    if(!isset($_SESSION['email'])){
        header("Location: index.php");
        exit();
    }
    if(isset($_GET['prestEmail'])){
        $presEmail = $_GET['prestEmail'];
    }
    else{
        header('index.php');
        exit();
    }
?>
<body>

    <div id='box'>
        <div id='userbox'>
            <div id='userbox-image'>
                <?php
                    echo "<img src= '".$user->getFoto($presEmail)."' height='100%' width='100%'>";
                ?>
            </div>
            <div align=center id='userbox-buttons' style='color: white; margin-top: 20px' >
                <?php
                    $result = $user->prestDados($presEmail);
                    for($i = $result->num_rows; $i > 0; $i--){
                        $j = $result->fetch_object();
                        if($i == $result->num_rows){
                            echo "Nome: $j->nome <br>
                                Email: $j->email <br>
                                Pontuação: $j->pontuacao <br>
                                Telefone: $j->numero <br>";
                        } else{
                            $k = abs($i-$result->num_rows-1);
                            echo "Telefone$k: $j->numero <br>";
                        }
                    }
                    $resultend = $user->getEndereco($presEmail, 'prestador');
                    $k = 0;
                    $cont = 0;
                    $obj = " ";
                    $end_array = array();
                    for($i = $resultend->num_rows; $i > 0; $i--, $k++){
                        $aux = $resultend->fetch_object();

                        $obj = $aux->rua . ", " . $aux->numero . ", " .
                        $aux->bairro . ", " . $aux->cidade .
                        ", " . $aux->estado . ", " . $aux->pais;
                        $end_array[$k] = $obj;
                    }
                ?>
            </div>
        </div>

        <div id='userinformation'>
            <h2 style="color:black">Serviços prestados</h2>
            <?php
                $result = $user->servPrestador($presEmail);
                for($i = $result->num_rows; $i > 0; $i--){
                    $j = $result->fetch_object();
                    echo "<div id='servico-box' align='center'>
                            <b>Nome:</b> &nbsp $j->nome <br>
                            <b>Tipo:</b> &nbsp $j->tipo <br>
                            <b>Valor:</b> &nbsp $j->valor <br>
                            <a href='escolha_end.php?contratar=".$j->id."'
                            id='button-cont' >Contratar</a> <br>
                         </div>";
                }
            ?>
        </div>

        <div id='userinformation'>
            <h2 style="color:black">Serviços feitos</h2>
            <?php
                $result = $user->prestServFeito($presEmail);
                for($i = $result->num_rows; $i > 0; $i--){
                    $j = $result->fetch_object();
                    echo "<div id='servico-box' align='center'>
                            <b>Serviço:</b> &nbsp $j->nome <br>
                            <b>Nota:</b> &nbsp $j->nota <br>
                            <b>Comentário: <br></b> &nbsp $j->comentario <br>
                         </div>";
                }
            ?>
        </div>

        <div id='map'></div>
    </div>
</body>

<script src='//maps.googleapis.com/maps/api/js?sensor=false'></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBL5dDMg4JGofEdaDRtA8TDp8llylXOPG8&callback=initMap">
</script>
<script>
function initMap(){
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 40,
        center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    var address = '<?PHP echo $end_array[0];?>';

    geocodeAddress(geocoder, map, address);
}

function geocodeAddress(geocoder, resultsMap, address) {
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
        } else {
            alert(status);
        }
    });
}
</script>

<?php include 'footer.php'; ?>
