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
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur de connexion a la base de donnees", 1);        
    }
   
}

function closeDatabase()
{
    global $bdd;

    $bdd = null;
}
