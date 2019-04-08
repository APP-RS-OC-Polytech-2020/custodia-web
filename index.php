<?php

ob_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page) {
    case 'home':
        $title = 'Accueil';
        include 'src/php/templates/home.php';
        break;
    case 'presentation':
        $title = 'Présentation';
        include 'src/php/templates/presentation.php';
        break;
    case 'conduite':
        $title = 'Conduite';
        include 'src/php/templates/conduite.php';
        break;
    case 'donnees':
        $title = 'Données';
        include 'src/php/templates/donnees.php';
        break;
    case 'login':
        $title = 'Connexion';
        include 'src/php/templates/login.php';
        break;
    case 'logout':
        $title = 'Déconnexion';
        include 'src/php/templates/logout.php';
        break;
    case 'admin':
        $title = 'Admin';
        include 'src/php/templates/admin.php';
        break;
    default:
        $title = 'Accueil';
        include 'src/php/templates/home.php';
        break;
}

$body = ob_get_clean();

include 'src/php/templates/template.php';
