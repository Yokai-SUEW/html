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
    <link href="./css/main.css" rel="stylesheet">
    <link rel=”stylesheet” href=”./bootstrap-css/bootstrap.css”>
    <link rel=”stylesheet” href=”./bootstrap-css/bootstrap-responsive.css”>
    <link rel="shortcut icon" type="image/png" href="../favicon.png"/>
    <link href="./css/homepage.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Home Page</title>
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
    <div class="col-8 container header-content">
        <div class="row">
            <div class="col-11 text-container titleYokai">
                <h1>YOKAI</h1>
            </div>
            <div title="Kontaktiere uns" class="col-1 iconMenu" onclick="location.href='mailto:yokai-suew@gmail.com'">
            <img src="https://img.icons8.com/carbon-copy/55/ffffff/ask-question.png"/>
            </div>
        </div>
    </div>
    <div class="col-8 container main-content">
        <div class="row">
            <div class="col-12 container text textFirst" >
                Schnellzugriff
            </div>
        </div>
        <div class="row">
            <div onclick="location.href='status.php'" class="col-3 viewBox viewStatus" onmouseover="onhoverServer()" onmouseout="nonhoverServer()">
            <img src="https://img.icons8.com/carbon-copy/100/ffffff/server.png" id="imageServer"/>
            <p class="text" >Server Status</p>
            </div>
            <div onclick="location.href='cctv.php'" class="col-3 viewBox viewCam" onmouseover="onhoverVisible()" onmouseout="nonhoverVisible()">
            <img src="https://img.icons8.com/carbon-copy/100/ffffff/visible.png" id="imageVisible"/>
            <p class="text" >CCTV</p>
            </div>
            <div onclick="location.href='profil.php'" class="col-3 viewBox viewProfile" onmouseover="onhoverName()" onmouseout="nonhoverName()">
            <img src="https://img.icons8.com/carbon-copy/100/ffffff/name.png" id="imageName"/>
            <p class="text" >Profil</p>
            </div>
        </div>
        <div class="row">
            <div onclick="location.href='control.php'" class="col-11 viewBox viewFan" onmouseover="onhoverFan()" onmouseout="nonhoverFan()">
            <img src="https://img.icons8.com/carbon-copy/100/ffffff/fan-speed.png" id="imageFan"/>
            <p class="text" >Lüftersteuerung</p>
            </div>
        </div>
    </div>
    <div class="col-8 container footer-content">
    <div class="col-12 container text textFirst" >
             Vorkommnisse 
            </div>
    <?php  
    require_once "config/database_con.php";

$sql = "SELECT * FROM sensor_status WHERE active = 1";

        if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){   
        echo "<div class=\"col-12 alertBlock\">";
            echo "<table class=\"alertTable\">";
                echo "<thead>"; 
                  echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Temperatur</th>";
                        echo "<th>Datum</th>";
                        echo "<th>Approved</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                                echo "<td name=\"id\">" . $row['id'] . "</td>";
                                echo "<td>" . $row['Temperatur'] . "</td>";
                                echo "<td>" . $row['Datum'] . "</td>";
                                echo "<td>
                                      <a class=\"activeButton\" href='update.php?uid=".$row['id']."'>Approve</a>
                                      </td>";
                            echo "</tr>";
            }
                echo "</tbody>";
            echo "</table>";
        echo "</div>";
        mysqli_free_result($result);
    } else{
        echo "<p style=\"text-align: center;\">Es gibt keine Probleme!</p>";
    }
} else{
    echo "Ups... ich könnte das leider nicht ausführen: <br> $sql. <br>" . mysqli_error($link);
}

mysqli_close($link);

?>
    </div>


    <script>

        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: "status.php",
                data: {"id": <?php echo $machine_id;?>},
                success: function (data) {
                    console.log(data)
                }
            });
        });

        function onhoverServer() {
            document.getElementById("imageServer").setAttribute("src", "https://img.icons8.com/carbon-copy/115/ffffff/server.png");
        }

        function nonhoverServer() {
            document.getElementById("imageServer").setAttribute("src", "https://img.icons8.com/carbon-copy/100/ffffff/server.png");
        }

        function onhoverVisible() {
            document.getElementById("imageVisible").setAttribute("src", "https://img.icons8.com/carbon-copy/115/ffffff/visible.png");
        }

        function nonhoverVisible() {
            document.getElementById("imageVisible").setAttribute("src", "https://img.icons8.com/carbon-copy/100/ffffff/visible.png");
        }

        function onhoverName() {
            document.getElementById("imageName").setAttribute("src", "https://img.icons8.com/carbon-copy/115/ffffff/name.png");
        }

        function nonhoverName() {
            document.getElementById("imageName").setAttribute("src", "https://img.icons8.com/carbon-copy/100/ffffff/name.png");
        }
        
        function onhoverFan() {
            document.getElementById("imageFan").setAttribute("src", "https://img.icons8.com/carbon-copy/115/ffffff/fan-speed.png");
        }

        function nonhoverFan() {
            document.getElementById("imageFan").setAttribute("src", "https://img.icons8.com/carbon-copy/100/ffffff/fan-speed.png");
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>