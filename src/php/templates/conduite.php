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
                            <img class="img-fluid" src="http://193.48.125.70:50010">
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
            <object data="public/img/map.svg" type="image/svg+xml" id="map"></object>

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

