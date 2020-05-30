<?php
// CONNEXION BDD //

define( 'SERVERNAME', "localhost:3306");
define( 'DBNAME', "fleet");
define( 'USERNAME', "root");
define( 'PASSWORD', "");


function openDatabase()
{
    global $bdd;

    try {
        $bdd = new PDO( 'mysql:host='.SERVERNAME.';dbname='.DBNAME, USERNAME, PASSWORD );
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    } catch(PDOException $erreur) {
        echo $erreur."--".$erreur->getMessage();
    }
   
}

function closeDatabase()
{
    global $bdd;

    $bdd = null;
}
