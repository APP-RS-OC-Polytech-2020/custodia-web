<?php

require_once 'src/php/autoload.php';

$db = Database::getInstance();
$session = Session::getInstance();
$auth = new Auth($session);
$auth->restrict();

$meanTemperature = mysql_fetch_array($db->query("SELECT AVG(`temperature`) FROM sensor"));
$meanTemperature = $meanTemperature[0];
$meanTemperature = number_format(floatval($meanTemperature), 2);

$meanSmoke = mysql_fetch_array($db->query("SELECT AVG(`smoke`) FROM sensor"));
$meanSmoke = $meanSmoke[0];
$meanSmoke = number_format(floatval($meanSmoke), 2);

$meanHumidity = mysql_fetch_array($db->query("SELECT AVG(`humidity`) FROM sensor"));
$meanHumidity = $meanHumidity[0];
$meanHumidity = number_format(floatval($meanHumidity), 2);
$hasSmoke = $meanHumidity >= 600 ? true : false;
?>

<div class="jumbotron jumbotron-page rounded-0">
    <h1 class="display-3">Données</h1>
    <p class="lead">Capteurs de température, de monoxyde de carbone et d'humidité</p>
</div>

<div class="container mt-5">

    <div class="row mb-5">
        <div class="col-lg-4">
            <div class="card rounded-0">
                <div class="card-body font-poppins">
                    <p class="text-primary font-weight-bold">Température moyenne</p>
                    <h1 class="text-center"><?= $meanTemperature ?> °C</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card rounded-0">
                <div class="card-body font-poppins">
                    <p class="text-primary font-weight-bold">Humidité moyenne</p>
                    <h1 class="text-center"><?= $meanHumidity ?> %</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card rounded-0">
                <div class="card-body font-poppins">
                    <p class="text-primary font-weight-bold">Fumée</p>
                    <h1 class="text-center"><?= $hasSmoke ? 'Oui' : 'Non'   ?></h1>
                </div>
            </div>
        </div>
    </div>

    <h2>Les dernières données</h2>
    <hr>
    <div class="text-center">
        <div style="height: 500px; margin-bottom: 50px">
            <canvas id="chartTemperature" width="300" height="300"></canvas>
        </div>
        <div style="height: 500px; margin-bottom: 50px">
            <canvas id="chartHumidity" width="300" height="300"></canvas>
        </div>
        <div style="height: 500px">
            <canvas id="chartSmoke" width="300" height="300"></canvas>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="public/js/charts.js"></script>

