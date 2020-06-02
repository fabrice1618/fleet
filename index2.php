<?php
require_once("errorlog.php");
require_once("process_option.php");
require_once('offreModel.php');
require_once('auth.php');

if(!isset($_SESSION)){
  session_start();
}

// Variable globale
// Connexion Base de données
$bdd = null;
openDatabase();

setAlert( 'none', '' );
$update = false;
$off_id = '';
$methode = '';
$field = '';
$active = '';

if (
    isset( $_POST['save'] ) &&
    isset( $_POST['token'] ) && 
    checkToken( $_POST['token'] )
) {
  saveProcessOption();
}

if (isset($_GET['edit'])) {
  editProcessOption();
}

if ( 
    isset( $_POST['update'] ) &&
    isset( $_POST['token'] ) && 
    checkToken( $_POST['token'] )
) {
  updateProcessOption();
}

if (
    isset( $_GET['delete'] ) && 
    isset( $_GET['token'] ) && 
    checkToken( $_GET['token'] )
) {
  deleteProcessOption();
}


$result = indexOption();
$res_met=indexMethode();
$res_off=indexOffre();

$sToken = newToken();     // Generer un nouveau token CSRF

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/option.css">
    
    <title>Options Haulotte</title>
  </head>
  <body>
  
    <div class="container-fluid">
      <div class="row head-admin"> 
			  <div class="logo-info">
			    <a href="/index2.php"><img src="./img/HaulotteRVB.png" class="logo-image-admin"></a>
          <span class="admin-text"> Admin </span>   
        </div>
        <div class="bouton"> 
          <form action="index.php" method="POST">
            <button type="submit"  class="btn btn-light" name="offre">Offre Haulotte</button>
          </form>
        </div> 
      </div>
    </div>
        
    <?php 
      echo getAlertMessage();
    ?>
        
    <div class="container">

      <div class="row">
        <div>
          <h2>Les Options </h2>
        </div>
        <div class="bouton"> 
          <a href="#add"><button type="submit" class="btn btn-light">Add Option</button></a>
        </div>
      </div>
      
      <div class="row container">
          <h4>Select Number of Rows </h4>
          <div class="form-group">
            <select name="state" id="maxRows" class="form-control">
              <option value="5000">Show All</option>
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>                  
          <table id="mytable" class="table">
          <thead>
            <tr>
              <th>Name Offre</th>
              <th>Methode</th>
              <th>Field</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php 
              foreach ($result as $value): 
            ?>

            <tr> 
              <td><?php echo $value['off_designation'];?></td>
              <td><?php echo $value['met_name'];?></td>
              <td><?php echo $value['opt_field'];?></td>
              <td><?php echo $value['opt_active'];?></td>
              <?php
              $sDeleteLink = 'index2.php?delete='.$value['opt_id'].'&token='.$sToken;
              ?>
              <td><a href="<?php echo $sDeleteLink; ?>" class="btn btn-danger">Delete</a>
                  <a href="index2.php?edit=<?php echo $value['opt_id']; ?>#upd"   class="btn btn-info">Edit</a>
              </td>
            </tr>

            <?php 
              endforeach;
            ?>
              
          </tbody>
        </table>
        <div class="pagination-container">
          <nav>
            <ul class="pagination"></ul>
          </nav>
        </div>
      </div>
        <?php 
            if ($update == true):
        ?>

        <div id="upd">
          <h2> Modifier une option </h2>
        </div>

        <?php 
            else: 
        ?>

        <div id="add">
          <h2> Ajouter une option </h2>
        </div>
          
        <?php 
            endif; 
        ?>
      
      <div class="row justify-content-center"> 
        <form action="index2.php" method="POST">

      <?php          
      echo('<input type="hidden" name="token" value="'.$sToken.'">');
      ?>

          <div class="form-group" style="display:none">
            <label>opt_id</label>
            <input type="text" name="opt_id" class="form-control" value="<?php echo $opt_id; ?>" placeholder="entrer l'id">
          </div>
          <div class="form-group">
            <label>Offres</label>
            <br/>
            <select class="form-control" name="off_id">
                <option>--Select Offres--</option>
                <?php selectOffreView($res_off) ?>
            </select>
          </div>
          <div class="form-group">
            <label>Methode</label>
            <br/>
            <select class="form-control" name="met_name">
                <option>--Select Methode--</option>
                <?php selectMetNameView($res_met) ?>
            </select>
            
          </div>
          <div class="form-group">
            <label>Field</label>
            <input type="text" name="opt_field" class="form-control" value="<?php echo $field; ?>" placeholder="entrer le field">
          </div>
          <div class="form-group">
            <label>Active</label>
            <div>
            <?php selectActiveView($active); ?>
            </div>
          </div>
          <div class="form-group">

            <?php 
              if ($update == true):
            ?>

            <button type="submit"  class="btn btn-light" name="update">Modifier</button>
            <button type="submit"  class="btn btn-danger" name="annule">Annuler</button>

            <?php 
              else:
            ?>

            <button type="submit"  class="btn btn-light" name="save">Enregistrer</button>

            <?php 
              endif; 
            ?>

          </div>
        </form>
      </div>

    <!-- Optional JavaScript -->
    <script src="JavaScript/jquery.min.js"></script>
    <script src="JavaScript/ddtf.js"></script>
    <script src="JavaScript/script.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script> 
      
    </div>
  </body>
</html>

<?php 
closeDatabase();
?>

<?php 

function selectOffreView($res_off)
{
  global $off_id;

  foreach ($res_off as $output_off) { 
    if ($off_id == $output_off["off_id"]) {
      echo '<option value="'.$output_off["off_id"].'" selected>'.$output_off["off_designation"].'</option>'.PHP_EOL;
    } else {
      echo '<option value="'.$output_off["off_id"].'">'.$output_off["off_designation"].'</option>'.PHP_EOL;
    }
  }

}

function selectMetNameView($res_met)
{
  global $methode;

  foreach ($res_met as $output_met) { 
    if ($methode == $output_met["met_name"]) {
      echo '<option value="'.$output_met["met_name"].'" selected>'.$output_met["met_name"].'</option>'.PHP_EOL;
    } else {
      echo '<option value="'.$output_met["met_name"].'">'.$output_met["met_name"].'</option>'.PHP_EOL;
    }
  }

}

function selectActiveView($opt_active)
{
  $sSelect1 = "";
  $sSelect2 = "";

  if ($opt_active == "1") {
    $sSelect1 = "checked";
  } else {
    $sSelect2 = "checked";
  }

  echo '<input type="radio" id="yes_no" name="opt_active" value="1" '.$sSelect1.'><label for="yes_no">Yes</label>'.PHP_EOL;
  echo '<input type="radio" id="no_yes" name="opt_active" value="0" '.$sSelect2.'><label for="no_yes">No</label>'.PHP_EOL;

}



