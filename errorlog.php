<?php 

// Ecris les messages sur la console quand on execute le script en CLI
// Si la constante n'est pas définie, le message d'erreur est envoié dans le fichier seulement
//define('DEBUG_TO_SCREEN', 'ON');


function errorlog( $sMessageLog )
{
    // Envoi le message dans le fichier app-error.log
    $fp = fopen( "app-error.log", "a" );
    fwrite( $fp, $sMessageLog );
    fclose( $fp );

    // Envoi le message sur la console quand la constante est definie
    if ( defined('DEBUG_TO_SCREEN') ) {
        echo( $sMessageLog );
    }
}

function errorMessage( $sFunction, $sMessage )
{
    return( date("Y-m-d H:i:s") . " ". $sFunction . "(): " . $sMessage . PHP_EOL );
}

function setAlert( $sType, $sMessage)
{
    global $aAlert;

    $aAlert = [ 'type' => $sType, 'message' => $sMessage ];
}