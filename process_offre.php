<?php 
    require_once('offreModel.php');
    require_once('dbconfig.php');
    require_once("errorlog.php");

// https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2680167-la-faille-xss

function saveProcessOffre()
{
        // https://www.php.net/manual/en/migration70.new-features.php
        $aOffre = array();
        $aOffre['off_id'] = htmlentities( $_POST['off_id'] ) ?? "";
        $aOffre['off_designation'] = htmlentities( $_POST['off_designation'] ) ?? "";
        $aOffre['off_descriptif'] = htmlentities( $_POST['off_descriptif'] ) ?? "";
        $aOffre['off_date_debut'] = $_POST['off_date_debut'] ?? "";
        $aOffre['off_date_fin'] = $_POST['off_date_fin'] ?? "";
    
        try {
            insertOffre($aOffre);
            setAlert( 'success', "Votre offre à été ajoutée");
        } catch ( Exception $erreur) {
            setAlert( 'danger', "Une erreur s'est produite");
        }
    
}

function editProcessOffre()
{
    global $update, $off_id_origin, $off_id, $designation, $descriptif, $date_debut, $date_fin;
    
    $off_id_origin = $_GET['edit'];
    $update = true;
    $sth = readOffre( $off_id_origin );

    $off_id = $sth['off_id'];
    $designation = $sth['off_designation'];
    $descriptif = $sth['off_descriptif'];
    $date_debut = $sth['off_date_debut'];
    $date_fin = $sth['off_date_fin'];   
}

function updateProcessOffre()
{
    $nOffIDOrigin = htmlentities( $_POST['off_id_origin'] ) ?? "";
    $aOffre = array();
    $aOffre['off_id'] = htmlentities( $_POST['off_id'] ) ?? "";
    $aOffre['off_designation'] = htmlentities( $_POST['off_designation'] ) ?? "";
    $aOffre['off_descriptif'] = htmlentities( $_POST['off_descriptif'] ) ?? "";
    $aOffre['off_date_debut'] = $_POST['off_date_debut'] ?? "";
    $aOffre['off_date_fin'] = $_POST['off_date_fin'] ?? "";

    try {
        updateOffre( $nOffIDOrigin, $aOffre );
        setAlert( 'success', "Votre offre à été modifiée");
    } catch ( Exception $erreur) {
        setAlert( 'danger', "Une erreur s'est produite");
    }
}

function deleteProcessOffre()
{
    $off_id = $_GET['delete'];

    try {
        deleteOffre( $off_id );
        setAlert( 'success', "Votre offre à été supprimé");
    } catch ( Exception $erreur) {
        setAlert( 'danger', "Une erreur s'est produite");
    }

}

