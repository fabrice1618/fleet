<?php 
    require_once('optionModel.php');
    require_once('offreModel.php');
    require_once('dbconfig.php');
    require_once("errorlog.php");


function saveProcessOption()
{
        // https://www.php.net/manual/en/migration70.new-features.php
        $aOption = array();
        $aOption['off_id'] = $_POST['off_id'] ?? "";
        $aOption['met_name'] = $_POST['met_name'] ?? "";
        $aOption['opt_field'] = htmlentities( $_POST['opt_field'] ) ?? "";
        $aOption['opt_active'] = $_POST['opt_active'] ?? "";

        try {
            insertOption( $aOption );
            setAlert( 'success', "Votre option à été ajoutée");
        } catch ( Exception $erreur) {
            setAlert( 'danger', "Une erreur s'est produite");
        }
    
}

function editProcessOption()
{
    global $update, $opt_id, $off_id, $methode, $field, $active;

    $opt_id = $_GET['edit'];
    $update = true;
    $sth = readOption( $opt_id );

    $off_id = $sth['off_id'];
    $methode = $sth['met_name'];
    $field = $sth['opt_field'];
    $active = $sth['opt_active'];    
}

function updateProcessOption()
{
    $aOption = array();
    $aOption['opt_id'] = $_POST['opt_id'] ?? "";
    $aOption['off_id'] = $_POST['off_id'] ?? "";
    $aOption['met_name'] = $_POST['met_name'] ?? "";
    $aOption['opt_field'] = htmlentities( $_POST['opt_field'] ) ?? "";
    $aOption['opt_active'] = $_POST['opt_active'] ?? "";

    try {
        updateOption( $aOption );
        setAlert( 'success', "Votre option à été modifiée");
    } catch ( Exception $erreur) {
        setAlert( 'danger', "Une erreur s'est produite");
    }
}

function deleteProcessOption()
{
    $opt_id = $_GET['delete'];

    try {
        deleteOption($opt_id);
        setAlert( 'success', "Votre option à été supprimée");
    } catch ( Exception $erreur) {
        setAlert( 'danger', "Une erreur s'est produite");
    }

}

    

