<?php
header('Content-Type: application/json');

define('DB_HOST', '4.tcp.ngrok.io:12248');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '292726242528');
define('DB_NAME', 'yokai');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

$query = sprintf("SELECT id, Temperatur, Luftfeuchtigkeit, Datum FROM sensor_status");

$result = $mysqli->query($query);

$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

$result->close();

$mysqli->close();

print json_encode($data);