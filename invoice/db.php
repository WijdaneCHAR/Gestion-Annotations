<?php 
    $con = new mysqli('localhost','root','', 'annot');

    if ( $con->connect_error ) 
    {
        die('Erreur lors de la connexion à la base de données: ' . $con->connect_error);
    }
?>