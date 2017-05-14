
<?php
session_start();


?>

<?php

  try {
        $bdd = new PDO("mysql:host=localhost;dbname=minitchat;charset=utf8", 'root', 'samroot');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }   
    catch(Exception $e) {
        die('erreur :  ' . $e->getessage());
    }


if (($_POST['message']) &&  ($_POST['user'])){
    
//nettoyage du champ message et pseudo
$_POST['message'] = filter_var( $_POST['message'], FILTER_SANITIZE_STRING); 
$_POST['user'] = filter_var( $_POST['user'], FILTER_SANITIZE_STRING);
$_SESSION['user']  = $_POST['user'];
    
$req = $bdd->prepare('INSERT INTO messages (user, message) VALUES(?, ?)');
$req->execute(array($_POST['user'], $_POST['message']));
    
}



header('Location: index.php?pseudo=' . $_POST['user']);
