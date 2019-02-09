<?php

require '../autoload.php';

$db = Database::getInstance();

$sensors = $db->query("SELECT * FROM sensor ORDER BY captureTime LIMIT 50");
$db->close();

$row = array();

while($r = mysql_fetch_array($sensors)) { $row[] = $r; };

$row = json_encode($row);
echo $row;
