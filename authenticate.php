<?php
session_start();
include_once('./config/database_con.php');
// Hier wird geschaut ob die Daten beim Login mitgesendet wurden oder nicht. isset() schaut ob die Daten vorhanden sind
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Daten konnten nicht gefunden werden...
	exit('Bitte füllen Sie beide Felder aus!');
}

// SQL-Abfrage wird hier schon vordefiniert. Dadurch werden SQL-Injections verhindert. 
if ($stmt = $link->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Hier werden die Parameter festgelegt (s = string, i = int, b = blob, etc)
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account existiert, nun können wir die Passwörter vergleichen 
        if (password_verify($_POST['password'], $password)) {
            // Passwörter sind richtig, nun eröffnen wir eine Session. Es funktioniert wie Cookies nur das Sessions 
            // auf dem Server gespeichert werden
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: homepage.php');
        } else {
            echo('PASSWORT FALSCH!');
        }
    } else {
        echo('NUTZER EXISTIERT NICHT');
    }


	$stmt->close();
}


?>

