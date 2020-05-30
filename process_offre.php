<?php 
    require_once('offreModel.php');
    require_once('dbconfig.php');
    require_once("errorlog.php");


// https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2680167-la-faille-xss


if(!isset($_SESSION)){
    session_start();
}


openDatabase();

// CREATE //

if (isset($_POST['save'])) {

    // https://www.php.net/manual/en/migration70.new-features.php

    $aOffre['off_id'] = $_POST['off_id'] ?? "";
    $aOffre['off_designation'] = $_POST['off_designation'] ?? "";
    $aOffre['off_descriptif'] = $_POST['off_descriptif'] ?? "";
    $aOffre['off_date_debut'] = $_POST['off_date_debut'] ?? "";
    $aOffre['off_date_fin'] = $_POST['off_date_fin'] ?? "";

    insertOffre($aOffre);

    header('location:index.php');
}

// EXTEND AND READ //
$result = indexOffre();

// DECLARATION DE VARIABLE (update) //

$update = false; 
$off_id = '';
$designation = '';
$descriptif = '';
$date_debut = '';
$date_fin = '';

if (isset($_GET['edit'])) {
    $off_id = $_GET['edit'];
    $update = true;
    $sth = readOffre( $off_id );

    $off_id = $sth['off_id'];
    $designation = $sth['off_designation'];
    $descriptif = $sth['off_descriptif'];
    $date_debut = $sth['off_date_debut'];
    $date_fin = $sth['off_date_fin'];   
     
}

// UPDATE // 

if (isset($_POST['update'])) {
    $aOffre['off_id'] = $_POST['off_id'] ?? "";
    $aOffre['off_designation'] = htmlentities($_POST['off_designation']) ?? "";
    $aOffre['off_descriptif'] = htmlentities($_POST['off_descriptif']) ?? "";
    $aOffre['off_date_debut'] = $_POST['off_date_debut'] ?? "";
    $aOffre['off_date_fin'] = $_POST['off_date_fin'] ?? "";

    updateOffre( $aOffre );

    header('location:index.php');

}

// RETOUR EDIT //

if (isset($_POST['annule'])) {

    header('location:index.php');
}

// DELETE //

if (isset($_GET['delete'])) {
    $off_id = $_GET['delete'];

    deleteOffre( $off_id );
    
    header('location:index.php');
    
}

closeDatabase();
