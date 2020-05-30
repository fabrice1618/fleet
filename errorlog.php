<?php 

function logError( $sMessage )
{
    $fp = fopen( "app-error.log", "a");
    fwrite($fp, date("Y-m-d H:m:s ").$sMessage .PHP_EOL);
    fclose($fp);
}