<?php 
    require_once("config.php");

    // Connexion à la base de données
    $con = new mysqli($serverName, $user, $password, $bdName);

    if ( $con->connect_error ) 
    {
        die('Erreur lors de la connexion à la base de données: ' . $con->connect_error);
    }
?>
   