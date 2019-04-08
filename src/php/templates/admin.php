<?php
require_once 'src/php/autoload.php';
$session = Session::getInstance();
$auth = new Auth($session);
$auth->restrict();
$db = Database::getInstance();

$esps = $db->query("SELECT * FROM esp");
?>

<div class="jumbotron jumbotron-page rounded-0">
  <h1 class="display-3">Espace admin</h1>
  <p class="lead">Gestion de l'administration de Robotino</p>
</div>

<div class="container margin-top-50">
    <section>
        <button class="btn btn-primary" id="btnStartCustodia">Lancer Custodia</button>
    </section>
    <section>
        <h1>Les ESP valides</h1>
        <hr>
        <table class="table">
            <thead class="font-weight-bold">
            <tr>
                <td>Nom</td>
                <td>Adresse MAC</td>
                <td>Adresse IP</td>
                <td>Localisation</td>
            </tr>
            </thead>
            <tbody>
            <?php while ($esp = mysql_fetch_assoc($esps)) {
                echo "<tr>";
                echo "<td>" . $esp['name'] . "</td>";
                echo "<td>" . $esp['address'] . "</td>";
                echo "<td>" . $esp['ip'] . "</td>";
                echo "<td>" . $esp['localisation'] . "</td>";
                echo "</tr>";
            } ?>
            </tbody>
        </table>
    </section>
</div>

<script type="text/javascript" src="public/js/admin.js"></script>