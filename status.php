<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <link href="./css/main.css" rel="stylesheet"><link rel=”stylesheet” href=”./bootstrap-css/bootstrap.css”>
    <link rel=”stylesheet” href=”./bootstrap-css/bootstrap-responsive.css”>
    <link href="./css/status.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Server Status</title>
</head>
<body>
<section class="wrapper">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
</section>
<div class="col-8 header-content">
        <div class="row">
            <div class="col-7 iconServer">
            <img src="https://img.icons8.com/carbon-copy/70/ffffff/server.png"/> <h3>Serverstatus</h3>
            </div>
            <div title="Menu" class="col-12 iconMenu dropdown">
            <button class="dropbtn"><img src="https://img.icons8.com/metro/45/ffffff/menu.png"/></button>
            <div class="col-12 dropdown-content">
                <a href="homepage.php">Homepage</a>
                <a href="status.php">Serverstatus</a>
                <a href="cctv.php">CCTV</a>
                <a href="profil.php">Profil</a>
            </div>
            </div>
    </div>
</div>

<div class="col-8 container main-content">  
<div class="col-12 container statusTable">  
<?php 
require_once "config/database_con.php";

$sql = "SELECT id, Temperatur, Luftfeuchtigkeit, Datum FROM sensor_status ORDER BY id DESC , Temperatur DESC, Luftfeuchtigkeit DESC, Datum DESC";
        if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
        echo "<h3>Status</h3>";
        echo "<thead>";
        echo "<tr>";
        echo "<th title=\"ID\">ID</th>";
        echo "<th>Temperatur</th>";
        echo "<th>Luftfeuchtigkeit</th>";
        echo "<th>Datum & Uhrzeit</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td title=\"ID\"> #" . $row['id'] . "</td>";
                echo "<td title=\"Temperatur\">" . $row['Temperatur'] . "  &#8451; </td>";
                echo "<td title=\"Luftfeuchtigkei\">" . $row['Luftfeuchtigkeit'] . " % </td>";
                echo "<td title=\"Datum & Uhrzeit\">" . $row['Datum'] . "</td>";
                echo "</tr>";
            }
        echo "</tbody>";
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<p>Ups... ich habe keine Daten gefunden.</p>";
    }
} else{
    echo "Ups... ich könnte das leider nicht ausführen: $sql. " . mysqli_error($link);
}

mysqli_close($link);

?>
</div>
</div>

<div class="col-8 container footer-content statusDiagramm">
<canvas id="line-chartcanvas" width="1295px" height="600px"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/graph.js"></script>
</body>
</html>