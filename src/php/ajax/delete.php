<?php

require '../autoload.php';

$db = Database::getInstance();

if (isset($_POST)) {
	$address = $_POST['address'];
	$db->query("DELETE FROM socket WHERE address = '$address'");
	$db->close();
}
