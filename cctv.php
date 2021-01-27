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
    <link href="./css/cctv.css" rel="stylesheet" type="text/css">
    <link href="./css/main.css" rel="stylesheet"><link rel=”stylesheet” href=”./bootstrap-css/bootstrap.css”>
    <link rel=”stylesheet” href=”./bootstrap-css/bootstrap-responsive.css”>
    <link rel="shortcut icon" type="image/png" href="../favicon.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>CCTV</title>
</head>
<body>
<section class="wrapper">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
</section>
<div onclick="location.href='profil.php'" id="userlogged">
    Logged in as: <?=$_SESSION['name']?>
    </div>
    <div class="col-8 header-content">
        <div class="row">
            <div title="Menu" class="col-12 iconMenu dropdown">
            <img class="iconCCTV" src="https://img.icons8.com/carbon-copy/100/ffffff/visible.png"/> <h3 class="iconCCTVh3">CCTV</h3>
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

<div class="col-8 main-content">
<?php 
require_once "config/database_con.php";

$sql = "SELECT id, image_name, image, timestamp FROM security ORDER BY id DESC , image_name DESC, image DESC, timestamp DESC";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
        echo "<h3>Bilder</h3>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Dateiname</th>";
        echo "<th>Bild</th>";
        echo "<th>Upload Datum & Uhrzeit</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td title=\"ID\"> #" . $row['id'] . "</td>";
                echo "<td title=\"Temperatur\">" . $row['image_name'] . "</td>";
                echo "<td title=\"Luftfeuchtigkei\">" . $row['image'] . "</td>";
                echo "<td title=\"Datum & Uhrzeit\">" . $row['timestamp'] . "</td>";
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


    
</body>
</html>