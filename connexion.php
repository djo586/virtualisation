<?php
    //configuration de la base de données
    $serveur = "localhost";
    $base = "session";
    $utilisateur = "root";
    $motdepasse = "";

    try{
        //creation de l'instance de PDO
        $db = new PDO("mysql:host=$serveur;dbname=$base",$utilisateur,$motdepasse);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $ex){
        echo "echec de connexion ".$ex->getMessage();
    }


?>