<?php

require '../autoload.php';

$db = Database::getInstance();

if (isset($_POST)) {

	$address = $_POST['address'];

	$db->query("INSERT INTO robot(address) VALUES ($address') ");
	$db->close();

	echo $address;
}
