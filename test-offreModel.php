<?php 
require_once('offreModel.php');
require_once('dbconfig.php');
require_once("errorlog.php");

// Ecris les messages sur la console quand on execute le script en CLI
// Si la constante n'est pas définie, le message d'erreur est envoié dans le fichier seulement
define('DEBUG_TO_SCREEN', 'ON');

$bdd = null;
openDatabase();

$nOffId = "HR000101";
$aOffre = array();
$aOffre['off_id'] = "HR000101a";
$aOffre['off_designation'] = "Pilot 2019";
$aOffre['off_descriptif'] = "Offre Basic Fleet 2019";
$aOffre['off_date_debut'] = "2020-01-01";
$aOffre['off_date_fin'] = "2020-12-31";

updateOffre( $nOffId, $aOffre );

closeDatabase();