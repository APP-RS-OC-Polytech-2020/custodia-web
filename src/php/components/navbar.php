<?php
require_once 'src/php/autoload.php';

$session = Session::getInstance();
$path = $_SERVER['PHP_SELF'];
$file = substr($path, 18);

?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">Custodia</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <i class="material-icons text-white">menu</i>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ml-auto text-uppercase">
            <li class="nav-item">
                <a <?php if ($page == "presentation") { echo "class='nav-link active'"; } else { echo "class='nav-link'"; } ?>  href="index.php?page=presentation">Présentation</a>
            </li>
            <li class="nav-item">
                <a <?php if ($page == "conduite") { echo "class='nav-link active'"; } else { echo "class='nav-link'"; } ?>  href="index.php?page=conduite">Conduite</a>
            </li>
            <li class="nav-item">
                <a <?php if ($page == "donnees") { echo "class='nav-link active'"; } else { echo "class='nav-link'"; } ?>  href="index.php?page=donnees">Données</a>
            </li>
            <?php if ($session->read('auth')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=logout">Déconnexion</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a <?php if ($page == "login") { echo "class='nav-link active'"; } else { echo "class='nav-link'"; } ?> href="index.php?page=login">Connexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
