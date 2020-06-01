<?php
require_once("errorlog.php");
require_once("process_offre.php");
require_once('auth.php');

if(!isset($_SESSION)){
  session_start();
}

// Variable globale
// Connexion Base de données
$bdd = null;
openDatabase();

$aAlert = [ 'type' => 'none', 'message' => '' ];
$update = false; 
$off_id_origin = '';
$off_id = '';
$designation = '';
$descriptif = '';
$date_debut = '';
$date_fin = '';

if ( 
  isset( $_POST['save'] ) &&
  isset( $_POST['token'] ) && 
  checkToken($_POST['token'])
) {
  saveProcessOffre();
}

if (isset($_GET['edit'])) {
  editProcessOffre();
}

if ( 
  isset($_POST['update']) &&
  isset( $_POST['token'] ) && 
  checkToken($_POST['token'])
  ) {
  updateProcessOffre();
}

if (
  isset( $_GET['delete'] ) && 
  isset( $_GET['token'] ) && 
  checkToken($_GET['token'])
  ) {
  deleteProcessOffre();
}

// Lecture des données à afficher dans la table
$result = indexOffre();

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
    
    <title>Offre Haulotte</title>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row head-admin"> 
			  <div class="logo-info">
        <a href="/index.php"><img src="./img/HaulotteRVB.png" class="logo-image-admin"></a>
          <span class="admin-text"> Admin </span>   
        </div>
        <div class="bouton"> 
          <form action="index2.php" method="POST">
            <button type="submit"  class="btn btn-light" name="option">Options Haulotte</button>
          </form>
        </div>
      </div>
    </div>

    <?php 
      if ( $aAlert['type'] !== 'none' ) {
        $sAlertType = 'alert-' . $aAlert['type'];
        echo('<div class="alert '.$sAlertType.' container" role="alert">'.$aAlert['message'].'</div>');
      }
    ?>

    <div class="container">

      <div class="row">
        <div>
          <h2>Les Offres Haulotte </h2>
        </div>
        <div class="bouton"> 
          <a href="#add"><button type="submit" class="btn btn-light">Add Offre</button></a>
        </div>
      </div>

      <div class="row container">
        <table class="table">
          <thead>
            <tr>
              <th>ID Offre</th>
              <th>Name Offre</th>
              <th>Descriptif</th>
              <th>Date début</th>
              <th>Date fin</th>
              <th>Action</th>
            </tr>

            <?php 
              foreach ($result as $value): 
            ?>

            <tr> 
              <td><?php echo $value['off_id'];?></td>
              <td><?php echo $value['off_designation'];?></td>
              <td><?php echo $value['off_descriptif'];?></td>
              <td><?php echo $value['off_date_debut'];?></td>
              <td><?php echo $value['off_date_fin'];?></td>
              <?php
              $sDeleteLink = 'index.php?delete='.$value['off_id'].'&token='.$sToken;
              ?>
              <td><a href="<?php echo $sDeleteLink; ?>" class="btn btn-danger">Delete</a>
                  <a href="index.php?edit=<?php echo $value['off_id']; ?>#upd"   class="btn btn-info">Edit</a>
              </td>
            </tr>

            <?php 
              endforeach;
            ?>
              
          </thead>
        </table>
      </div>

      <?php 
        if ($update == true):
      ?>

      <div id="upd">
        <h2> Modifier une offre  </h2>
      </div>

      <?php 
        else: 
      ?>

      <div id="add">
        <h2> Ajouter une offre </h2>
      </div>
         
      <?php 
        endif; 
      ?>

      <div class="row justify-content-center"> 
        <form action="index.php" method="POST">      
<?php          
  echo('<input type="hidden" name="token" value="'.$sToken.'">');
?>          
<?php          
  if ($update) {
    echo('<input type="hidden" name="off_id_origin" value="'.$off_id_origin.'">');
  }
?>          

          <div class="form-group">
            <label>Off_id</label>
            <input type="text" name="off_id" class="form-control" value="<?php echo $off_id; ?>" placeholder="entrer l'id">
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="off_designation" class="form-control" value="<?php echo $designation; ?>" placeholder="entrer la designation">
          </div>
          <div class="form-group">
            <label>Descriptif</label>
            <input type="text" name="off_descriptif" class="form-control" value="<?php echo $descriptif; ?>" placeholder="entrer la descriptif">
          </div>
          <div class="form-group">
            <label>Date debut</label>
            <input type="date" name="off_date_debut" class="form-control" value="<?php echo $date_debut; ?>" placeholder="JJ/MM/AAAA">
          </div>
          <div class="form-group">
            <label>Date fin</label>
            <input type="date" name="off_date_fin" class="form-control" value="<?php echo $date_fin; ?>" placeholder="JJ/MM/AAAA">
          </div>
          <div class="form-group">

            <?php 
              if ($update == true):
            ?>

            <button type="submit"  class="btn btn-light" name="update">modifier</button>
            <button type="submit"  class="btn btn-danger" name="annule">Annuler</button>

            <?php 
              else: 
            ?>

            <button type="submit"  class="btn btn-light" name="save">enregistrer</button>

            <?php 
              endif; 
            ?>

          </div>
        </form>
      </div>
      

    <!-- Optional JavaScript -->
    <!-- Bootstrap JS -->
    <script src="JavaScript/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script> 
    
  </div>

  </body>
</html>

<?php
closeDatabase();