<?php 

function newToken()
{
    $sToken = bin2hex(random_bytes(32));
    
    $_SESSION['token'] = $sToken;

    return($sToken);
}

function checkToken( $sTokenRequest )
{
    $bReturn = false;

    if ( $sTokenRequest === $_SESSION['token'] ) {
        $bReturn = true;
    }

    return($bReturn);
}