<?php
session_start();
// Hier wird nachgeschaut ob der User angemeldet ist... 
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
include_once('./config/database_con.php');
// Die E-Mails und die Passwörter werden nicht in einer Session gespeichert deshalb holen wir diese aus der Datenbank.
$stmt = $link->prepare('SELECT password, email, username FROM accounts WHERE id = ?');
// Wir nutzen einfach die Session ID um die Informationen zu bekommen.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $name);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/profil.css" rel="stylesheet" type="text/css">
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
<div class="col-8 header-content">
        <div class="row">
            <div class="col-7 iconProfile">
            <img src="https://img.icons8.com/carbon-copy/100/ffffff/name.png" id="imageProfile"/> <h3>Profil</h3>
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

<div class="col-8 main-content">
<div class="row">
<div class="col-8 profilTable">
<?php 
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();
?>
<table>
		<tr>
			<th>Name:</th>
			<td><?=$_SESSION['name']?></td>
		</tr>
		<tr>
		    <th>Email:</th>
			<td><a href="mailto:$email" id="mail"><?=$email?></a></td>
        </tr>
        <tr>
            <th>IP-Adresse:</th>
            <td><?php echo $_SERVER["REMOTE_ADDR"];?></td>
        </tr>
        <tr>
            <th>Gerät:</th>
            <td><?php $host = gethostbyaddr($_SERVER['REMOTE_ADDR']); echo $host;?></td>
        </tr>
</table>
</div>
<div class="col-4 profilTabel">
<img src="https://img.icons8.com/ios-filled/300/ffffff/name.png"/></div>
</div>
</div>
    
</body>
</html>