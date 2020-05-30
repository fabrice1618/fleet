<?php 
    require_once('optionModel.php');
    require_once('offreModel.php');
    require_once('dbconfig.php');
    require_once("errorlog.php");


if(!isset($_SESSION)){
    session_start();
}

openDatabase();

// CREATE //

if (isset($_POST['save'])) {
    $aOption['off_id'] = $_POST['off_id'] ?? "";
    $aOption['met_name'] = $_POST['met_name'] ?? "";
    $aOption['opt_field'] = $_POST['opt_field'] ?? "";
    $aOption['opt_active'] = $_POST['opt_active'] ?? "";

    insertOption( $aOption );
    
    header('location:index2.php');
}

// EXTEND AND READ //
$result = indexOption();
// DECLARATION DE VARIABLE (update) //

$update = false;
$off_id = '';
$methode = '';
$field = '';
$active = '';

if (isset($_GET['edit'])) {
    $opt_id = $_GET['edit'];
    $update = true;

    $sth = readOption( $opt_id );

    $off_id = $sth['off_id'];
    $methode = $sth['met_name'];
    $field = $sth['opt_field'];
    $active = $sth['opt_active'];  
}

// UPDATE // 

if (isset($_POST['update'])) {
    $aOption['opt_id'] = $_POST['opt_id'] ?? "";
    $aOption['off_id'] = $_POST['off_id'] ?? "";
    $aOption['met_name'] = $_POST['met_name'] ?? "";
    $aOption['opt_field'] = $_POST['opt_field'] ?? "";
    $aOption['opt_active'] = $_POST['opt_active'] ?? "";

    updateOption( $aOption );

    header('location:index2.php');

}

// RETOUR EDIT //

if (isset($_POST['annule'])) {

    header('location:index2.php');
}

// DELETE //

if (isset($_GET['delete'])) {
    $opt_id = $_GET['delete'];
    deleteOption($opt_id);

    header('location:index2.php');
}

// met_name pour liste déroulante
$res_met=indexMethode();

// off_designation pour liste déroulante
$res_off=indexOffre();

closeDatabase();
