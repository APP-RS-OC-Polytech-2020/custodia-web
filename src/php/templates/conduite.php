<?php

require_once 'src/php/autoload.php';

$db = Database::getInstance();
$session = Session::getInstance();
$auth = new Auth($session);

$auth->restrict();

$sockets = $db->query("SELECT * FROM socket");
$robots = $db->query("SELECT * FROM robot");
?>

<div class="jumbotron jumbotron-page rounded-0">
  <h1 class="display-3">Conduite</h1>
  <p class="lead">Ecran de surveillance de Robotino</p>
</div>


<div class="container margin-top-50">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title text-center text-uppercase font-weight-bold">Configuration serveur et robot</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <form action="form-group">
            <fieldset>
              <label for="sockets" class="font-weight-bold">Adresse du serveur</label>
              <select name="sockets" id="sockets" class="custom-select">
                  <?php while ($socket = mysql_fetch_assoc($sockets)) {
                      echo "<option value='" . $socket['address'] . "'>" . $socket['address'] . "</option>";
                  } ?>
              </select>
              <br><br>
              <button type="button" class="btn btn-sm btn-color-dark-blue" data-toggle="modal"
                      data-target="#newSocket">
                Ajouter
              </button>
              <button class="btn btn-sm btn-color-red" type="button" id="btnDeleteSocket">
                Supprimer
              </button>
            </fieldset>
          </form>
        </div>

        <div class="col-lg-6">
          <form action="form-group">
            <fieldset>
              <label for="robots" class="font-weight-bold">Adresse du robot</label>
              <select name="robots" id="robots" class="custom-select">
                  <?php while ($robot = mysql_fetch_assoc($robots)) {
                      echo "<option value='" . $robot['address'] . "'>" . $robot['address'] . "</option>";
                  } ?>
              </select>
              <br><br>
              <button type="button" class="btn btn-sm btn-color-dark-blue" data-toggle="modal"
                      data-target="#newRobot">
                Ajouter
              </button>
              <button class="btn btn-sm btn-color-red" type="button" id="btnDeleteRobot">
                Supprimer
              </button>
            </fieldset>
          </form>
        </div>
      </div>

      <br>

      <label for="mode" class="font-weight-bold">Mode de conduite</label>
      <select name="mode" id="mode" class="custom-select">
        <option value='manuel'>Manuel</option>
        <option value='automatique'>Automatique</option>
      </select>
    </div>

    <div class="card-footer">
      <div class="row">
        <div class="col-lg-6">
          <button class="btn btn-block btn-color-green" type="button" id="btnOpenConnection">Activer</button>
        </div>
        <div class="col-lg-6">
          <button class="btn btn-block btn-color-salmon" type="button" id="btnCloseConnection"
                  onclick="closeConnection()" disabled>
            Couper
          </button>
        </div>
      </div>
    </div>
  </div>

  <br>

  <div id="burn" class="text-center"></div>

  <div class="card rounded-0">
    <div class="card-header">
      <div id="alertSocket" class="alert alert-info" role="alert">
        Aucune connexion
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-8">
          <div class="text-center">
            <div class="video">
              <!--<img class="img-fluid" src="http://193.48.125.70:50010">-->
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div id="manager"></div>
          <br>
          <hr>
          <div class="text-center">
            <button class="btn btn-light turn" onmousedown="turnLeft()" onmouseup="stopRotation()"><i
                  class="fas fa-undo-alt fa-4x pointer"></i></button>
            <button class="btn btn-light turn" onmousedown="turnRight()" onmouseup="stopRotation()"><i
                  class="fas fa-redo-alt fa-4x pointer"></i></button>
          </div>
        </div>
      </div>
      <br>
      <div>

        <!-- MAP SVG -->
        <svg width="100%" height="100%" viewBox="0 0 1280 720" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
    <g transform="matrix(1.26384,-8.95531e-32,2.40249e-31,0.875381,-189.084,567.152)">
      <rect x="182" y="114" width="819" height="22"/>
    </g>
          <g transform="matrix(3.3585e-17,-0.774636,0.872512,7.47662e-17,1111.63,827.188)">
            <rect x="182" y="114" width="819" height="22"/>
          </g>
          <g transform="matrix(1.30148,0,0,1.16256,-14.9421,-66.225)">
            <text x="387px" y="380px" style="font-family:'SourceSansPro-Black', 'Source Sans Pro', sans-serif;font-weight:900;font-size:73.621px;">SALLE 1</text>
          </g>
          <g transform="matrix(1.43097,-1.01396e-31,2.40249e-31,0.875381,-202.116,-67.2754)">
            <rect x="182" y="114" width="819" height="22"/>
          </g>
          <g transform="matrix(3.3585e-17,-0.774636,0.872512,7.47662e-17,-58.5306,807.929)">
            <rect x="182" y="114" width="819" height="22"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,30.6116,4.43583)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,280.691,4.43583)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,530.149,4.43583)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,780.228,4.43583)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,179.054,-501.073)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,429.134,-501.073)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,678.592,-501.073)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.82836,0,0,1.87225,928.671,-501.073)">
            <path d="M99,351L12,351L12,296L99,296L99,351ZM12.53,296.801L12.53,350.199L98.47,350.199L98.47,296.801L12.53,296.801Z" style="fill:rgb(114,114,114);"/>
          </g>
          <g transform="matrix(2.39941,0,0,2.4073,364.103,-546.381)">
            <rect id="capteur1" x="336.641" y="314" width="16.359" height="26" style="fill:rgb(26,122,230);"/>
          </g>
          <g transform="matrix(2.39941,0,0,2.4073,-747.609,-444.444)">
            <rect id="capteur2" x="336.641" y="314" width="16.359" height="26" style="fill:rgb(26,122,230);"/>
          </g>
          <g transform="matrix(8.25678,0,0,0.740707,-1703.55,434.363)">
            <rect id="laser" x="336.641" y="314" width="16.359" height="26" style="fill:rgb(26,122,230);"/>
          </g>
          <g transform="matrix(0.978602,0,0,0.978602,-4.6513,-6.01041)">
            <text x="118px" y="337.533px" style="font-family:'Calibri-Bold', 'Calibri', sans-serif;font-weight:700;font-size:18px;">T<tspan x="125.356px 134.418px " y="337.533px 337.533px ">em</tspan>pér<tspan x="173.784px 182.503px 188.743px 198.402px 204.599px 213.66px " y="337.533px 337.533px 337.533px 337.533px 337.533px 337.533px ">ature </tspan>:</text>
          </g>
          <g transform="matrix(1,0,0,1,3,-12.9692)">
            <text id="capteur2-temperature" x="218px" y="337.27px" style="font-family:'Calibri', sans-serif;font-size:18px;">23 °C</text>
          </g>
          <g transform="matrix(0.978602,0,0,0.978602,-4.6513,18.5093)">
            <text x="118px" y="337.533px" style="font-family:'Calibri-Bold', 'Calibri', sans-serif;font-weight:700;font-size:18px;">Humidit<tspan x="178.179px 187.24px " y="337.533px 337.533px ">é </tspan>:</text>
          </g>
          <g transform="matrix(1,0,0,1,-23.958,9.51969)">
            <text id="capteur2-humidite" x="218px" y="339.436px" style="font-family:'Calibri', sans-serif;font-size:18px;">20 %</text>
          </g>
          <g transform="matrix(0.978602,0,0,0.978602,-4.6513,43.029)">
            <text x="118px" y="337.533px" style="font-family:'Calibri-Bold', 'Calibri', sans-serif;font-weight:700;font-size:18px;">Fumée :</text>
          </g>
          <g transform="matrix(1,0,0,1,-42.1762,33.9041)">
            <text id="capteur2-fumee" x="218px" y="339.436px" style="font-family:'Calibri', sans-serif;font-size:18px;">non</text>
          </g>
          <g transform="matrix(0.978602,0,0,0.978602,897.14,-106.01)">
            <text x="118px" y="337.533px" style="font-family:'Calibri-Bold', 'Calibri', sans-serif;font-weight:700;font-size:18px;">T<tspan x="125.356px 134.418px " y="337.533px 337.533px ">em</tspan>pér<tspan x="173.784px 182.503px 188.743px 198.402px 204.599px 213.66px " y="337.533px 337.533px 337.533px 337.533px 337.533px 337.533px ">ature </tspan>:</text>
          </g>
          <g transform="matrix(1,0,0,1,904.791,-112.969)">
            <text id="capteur1-temperature" x="218px" y="337.27px" style="font-family:'Calibri', sans-serif;font-size:18px;">23 °C</text>
          </g>
          <g transform="matrix(0.978602,0,0,0.978602,897.14,-81.4907)">
            <text x="118px" y="337.533px" style="font-family:'Calibri-Bold', 'Calibri', sans-serif;font-weight:700;font-size:18px;">Humidit<tspan x="178.179px 187.24px " y="337.533px 337.533px ">é </tspan>:</text>
          </g>
          <g transform="matrix(1,0,0,1,877.833,-90.4803)">
            <text id="capteur1-humidite" x="218px" y="339.436px" style="font-family:'Calibri', sans-serif;font-size:18px;">20 %</text>
          </g>
          <g transform="matrix(0.978602,0,0,0.978602,897.14,-56.971)">
            <text x="118px" y="337.533px" style="font-family:'Calibri-Bold', 'Calibri', sans-serif;font-weight:700;font-size:18px;">Fumée :</text>
          </g>
          <g transform="matrix(1,0,0,1,859.615,-66.0959)">
            <text id="capteur1-fumee" x="218px" y="339.436px" style="font-family:'Calibri', sans-serif;font-size:18px;">non</text>
          </g>
          <g transform="matrix(1,0,0,1,-4,-3)">
            <text x="1091px" y="659.617px" style="font-family:'Calibri-Bold', 'Calibri', sans-serif;font-weight:700;font-size:18px;">Laser :</text>
          </g>
          <g transform="matrix(1,0,-0.0392157,1,22.3918,12.75)">
            <text id="laser-text" x="1144px" y="643.872px" style="font-family:'Calibri', sans-serif;font-size:18px;">non</text>
          </g>
</svg>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newSocket" tabindex="-1" role="dialog" aria-labelledby="newSocket" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Nouvelle connexion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertNewSocket"></div>

        <form id="formNewSocket">
          <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" name="address" id="address">
          </div>
          <div class="form-group">
            <label for="port">Port</label>
            <input type="text" class="form-control" name="port" id="port">
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-color-green" onclick="postFormSocket()">Ajouter</button>
        <button type="button" class="btn btn-color-flower" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newRobot" tabindex="-1" role="dialog" aria-labelledby="newRobot" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nouveau robot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertNewRobot"></div>
        <form id="formNewRobot">
          <div class="form-group">
            <label>Adresse</label>
            <input type="text" class="form-control" name="address" id="addressRobot">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-color-green" onclick="postFormRobot()">Ajouter</button>
        <button type="button" class="btn btn-color-flower" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://rawgit.com/Haeresis/konami-code-js/master/src/konami-code.js"></script>
<script type="text/javascript" src="public/js/nipplejs.min.js"></script>
<script type="text/javascript" src="public/js/joystick.js"></script>
<script type="text/javascript" src="public/js/map.js"></script>

