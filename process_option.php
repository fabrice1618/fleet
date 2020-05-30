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
    $methode = $_POST['met_name'];
    $field = $_POST['opt_field'];
    $active = $_POST['opt_active'];

    $bdd->query("INSERT INTO fiche_option (off_id, met_name, opt_field, opt_active) 
                 VALUES ('$off_id', '$methode', '$field', '$active')") or die ($mysqli->error());

    header('location:index2.php');
}

// EXTEND AND READ //

$sth = $bdd->query("SELECT fiche_option.opt_id, fiche_offre.off_designation, fiche_option.met_name, fiche_option.opt_field, fiche_option.opt_active
                    FROM fiche_offre, fiche_option WHERE fiche_option.off_id = fiche_offre.off_id");
$sth->execute();
      
$result = $sth->fetchAll(PDO::FETCH_ASSOC);      

// DECLARATION DE VARIABLE (update) //

$update = false;
$off_id = '';
$methode = '';
$field = '';
$active = '';

if (isset($_GET['edit'])) {
    $opt_id = $_GET['edit'];
    $update = true;
    $results = $bdd->query("SELECT * FROM fiche_option WHERE opt_id = '$opt_id'") or die ($mysqli->error());

    $sth = $results->fetch(PDO::FETCH_ASSOC);
    $off_id = $sth['off_id'];
    $methode = $sth['met_name'];
    $field = $sth['opt_field'];
    $active = $sth['opt_active'];  
     
}

// UPDATE // 

if (isset($_POST['update'])) {
    $opt_id = $_POST['opt_id'];
    $off_id = $_POST['off_id'];
    $methode = $_POST['met_name'];
    $field = $_POST['opt_field'];
    $active = $_POST['opt_active'];

    $bdd->query("UPDATE fiche_option SET off_id = '$off_id', met_name = '$methode', opt_field = '$field', opt_active = '$active' 
                 WHERE opt_id = '$opt_id'") or die ($mysqli->error());

    header('location:index2.php');

}

// RETOUR EDIT //

if (isset($_POST['annule'])) {

    header('location:index2.php');

}

// DELETE //

if (isset($_GET['delete'])) {
    $opt_id = $_GET['delete'];

    $bdd->query("DELETE FROM fiche_option WHERE opt_id = '$opt_id'") or die ($mysqli->error());
    

    header('location:index2.php');
    
}

// met_name pour liste déroulante

$sql_met = "SELECT * FROM fiche_methode";

try {
    $stmt = $bdd->prepare($sql_met);
    $stmt->execute();
    $res_met=$stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $erreur) {
    echo $erreur."--".$erreur->getMessage();
}

// off_designation pour liste déroulante

$sql_off = "SELECT * FROM fiche_offre";

try {
    $stmt = $bdd->prepare($sql_off);
    $stmt->execute();
    $res_off=$stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $erreur) {
    echo $erreur."--".$erreur->getMessage();
}

$bdd = null;