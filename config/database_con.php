<?php
define('DB_SERVER', '4.tcp.ngrok.io:19986');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '292726242528');
define('DB_NAME', 'yokai');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>