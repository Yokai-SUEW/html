<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

require_once "config/database_con.php";

if(isset($_GET['upd']))
{
    $id = $_GET['upd'];

    $sql = "UPDATE sensor_status SET active = 0 WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $id);
    $edit = $stmt->execute();

    header('location: homepage.php');
$link->close();
} else {
    echo "Error: " . mysqli_error($link);
}

?>