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
</head>
<body>
<?php 

require_once "config/database_con.php";

if(isset($_GET['uid'])) {
    $sql = mysqli_query("UPDATE sensor_status SET active = 0 WHERE id = '".$update_id."'");
    if($sql) {
        header("Refresh:0");
    } else {
        echo "ERROR <a href='mailto:yokai-suew@gmail.com?subject=\[IMPORTANT/WICHTIG\]ERROR OCCURED WHILE UPDATING ALERTMESSAGE!&body=AN ERROR OCCURED WHILE UPDATING ALERTMESSAGE ID:"
         . $update_id . ", TIME: " . date("Y-m-d | h:i:s") . " ERROR MESSAGE:'>Please contact YOKAI-Team</a>";
    }
}

?>
</body>
</html>