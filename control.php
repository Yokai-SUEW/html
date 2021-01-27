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
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link href="./css/main.css" rel="stylesheet"><link rel=”stylesheet” href=”./bootstrap-css/bootstrap.css”>
    <link rel=”stylesheet” href=”./bootstrap-css/bootstrap-responsive.css”>
    <link href="./css/control.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="../favicon.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Lüftersteuerung</title>
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
            <img class="iconFan" src="https://img.icons8.com/carbon-copy/80/ffffff/fan-speed.png"/> <h3 class="iconFanh3">Lüftersteuerung</h3>
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
$myfile = fopen("output.txt", "r");
$pwm = fread($myfile, filesize("output.txt"));
echo $pwm;
echo'<input type = "range" min = "0" max = "100" value = "'.$pwm.'" id ="pwm" onchange = "adjust_pwm()"/>';
fclose($myfile);
?>
</div>

<script>
function adjust_pwm(){
var x = document.getElementById("pwm").value;
window.location.href = "main_php.php?name=" + x;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>