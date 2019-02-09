<?php

require_once 'src/php/autoload.php';

$session = Session::getInstance();
$auth = new Auth($session);
$auth->logout();
