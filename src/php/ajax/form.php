<?php

require '../autoload.php';

$db = Database::getInstance();

if (isset($_POST)) {

	$address = $_POST['address'];
	$port = $_POST['port'];

	$fullAddress = $address . ":" . $port;
	$r = $db->query("INSERT INTO socket(address) VALUES ('$fullAddress') ");
	$db->close();

	echo $fullAddress;
}
