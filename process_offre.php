<?php 

if(!isset($_SESSION)){
    session_start();
}

// CONNEXION BDD //

$servername = "localhost:3308";  
$dbname = "fleet"; 
$user = "root"; 
$pass = ""; 

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname",$user,$pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $erreur) {
    echo $erreur."--".$erreur->getMessage();
}


// CREATE //

if (isset($_POST['save'])) {
    $off_id = $_POST['off_id'];
    $designation = $_POST['off_designation'];
    $descriptif = $_POST['off_descriptif'];
    $date_debut = $_POST['off_date_debut'];
    $date_fin = $_POST['off_date_fin'];

    $bdd->query("INSERT INTO fiche_offre (off_id, off_designation, off_descriptif, off_date_debut, off_date_fin) 
                 VALUES ('$off_id', '$designation', '$descriptif', '$date_debut', '$date_fin')") or die ($bdd->error());

    header('location:index.php');
}

// EXTEND AND READ //

$sth = $bdd->query("SELECT * FROM fiche_offre");
$sth->execute();
      
$result = $sth->fetchAll(PDO::FETCH_ASSOC);      

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
    $results = $bdd->query("SELECT * FROM fiche_offre WHERE off_id = '$off_id'") or die ($bdd->error());

    $sth = $results->fetch(PDO::FETCH_ASSOC);
    $off_id = $sth['off_id'];
    $designation = $sth['off_designation'];
    $descriptif = $sth['off_descriptif'];
    $date_debut = $sth['off_date_debut'];
    $date_fin = $sth['off_date_fin'];   
     
}

// UPDATE // 

if (isset($_POST['update'])) {
    $off_id = $_POST['off_id'];
    $designation = $_POST['off_designation'];
    $descriptif = $_POST['off_descriptif'];
    $date_debut = $_POST['off_date_debut'];
    $date_fin = $_POST['off_date_fin'];

    $bdd->query("UPDATE fiche_offre SET off_designation = '$designation', off_descriptif = '$descriptif', off_date_debut = '$date_debut', off_date_fin = '$date_fin' 
                 WHERE off_id = '$off_id'") or die ($bdd->error());


    header('location:index.php');

}

// RETOUR EDIT //

if (isset($_POST['annule'])) {

    header('location:index.php');
}

// DELETE //

if (isset($_GET['delete'])) {
    $off_id = $_GET['delete'];

    $bdd->query("DELETE FROM fiche_offre WHERE off_id = '$off_id'") or die ($bdd->error());
    
    header('location:index.php');
    
}

$bdd = null;

