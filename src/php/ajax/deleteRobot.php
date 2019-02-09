<?php

require '../autoload.php';

$db = Database::getInstance();

if (isset($_POST)) {
	$address = $_POST['address'];
	$db->query("DELETE FROM robot WHERE address = '$address'");
	$db->close();
}
