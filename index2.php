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
			    <img src="./img/HaulotteRVB.png" class="logo-image-admin">
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
      require_once 'process_option.php';
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
              <td><?=$value['off_designation'];?></td>
              <td><?=$value['met_name'];?></td>
              <td><?=$value['opt_field'];?></td>
              <td><?=$value['opt_active'];?></td>
              <td><a onclick="myFunction()" href="process_option.php?delete=<?php echo $value['opt_id']; ?>"
                    class="btn btn-danger">Delete</a>
                  <a href="index2.php?edit=<?php echo $value['opt_id']; ?>"
                    class="btn btn-info" >Edit</a>
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
        <form action="process_option.php" method="POST">
          <div class="form-group" style="display:none">
            <label>opt_id</label>
            <input type="text" name="opt_id" class="form-control" value="<?php echo $opt_id; ?>" placeholder="entrer l'id">
          </div>
          <div class="form-group">
            <label>Offres</label>
            </br>
            <select class="form-control" name="off_id">
                <option>--Select Offres--</option>
                <?php foreach ($res_off as $output_off) { ?>
                  <?php if($off_id == $output_off["off_id"]) { ?>
                  <option selected ="selected" value="<?php echo $output_off["off_id"] ?>"><?php echo $output_off["off_designation"]; ?></option>
                <?php } else { ?>
                  <option value="<?php echo $output_off["off_id"] ?>"><?php echo $output_off["off_designation"]; ?></option>
                  <?php } ?>
                  <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Methode</label>
            </br>
            <select class="form-control" name="met_name">
                <option>--Select Methode--</option>
                <?php foreach ($res_met as $output_met) { ?>
                  <?php if($methode == $output_met["met_name"]) { ?>
                    <option selected="selected"><?php echo $output_met["met_name"]; ?></option>
                  <?php } else { ?>
                    <option><?php echo $output_met["met_name"]; ?></option>
                    <?php } ?>
                  <?php } ?>
            </select>
            
          </div>
          <div class="form-group">
            <label>Field</label>
            <input type="text" name="opt_field" class="form-control" value="<?php echo $field; ?>" placeholder="entrer le field">
          </div>
          <div class="form-group">
            <label>Active</label>
            <div>
              <input type="radio" id="yes_no" name="opt_active" value="1"> Yes</input>
              <input type="radio" id="no_yes" name="opt_active" value="0"> No</input>
            </div>
          </div>
          <div class="form-group">

            <?php 
              if ($update == true):
            ?>

            <button onclick="myFunction1()" type="submit"  class="btn btn-light" name="update">Modifier</button>
            <button type="submit"  class="btn btn-danger" name="annule">Annuler</button>

            <?php 
              else:
            ?>

            <button onclick="myFunction2()" type="submit"  class="btn btn-light" name="save">Enregistrer</button>

            <?php 
              endif; 
            ?>

          </div>
        </form>
      </div>

    <!-- Optional JavaScript -->
    <script src="JavaScript/jquery.min.js"></script>
    <script src="JavaScript/ddtf.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script> 

    <!-- POP-UP -->
    <script>
      function myFunction() {
        alert("Option supprimé");
      }
      function myFunction1() {
        alert("Option modifié");
      }  
        function myFunction2() {
        alert("Option enregistré");
      }
    </script>

      <!-- filtre tableau -->

      <script>
          jQuery('#mytable').ddTableFilter();
      </script>

      <!-- Bouton EDIT -->
      <?php if($update) { ?>
        <script>
          document.getElementById("upd").scrollIntoView();
      </script>
      <?php } ?>

      <!-- Pagination -->

      <script>
        var table ='#mytable'
        $('#maxRows').on('change', function(){
          $('.pagination').html('')
          var trnum = 0;
          var maxRows = parseInt($(this).val())
          var totalRows = $(table+' tbody tr').length;
          $(table+' tr:gt(0)').each(function(){
            trnum++
            if(trnum > maxRows){
              $(this).hide()
            }
            if(trnum <= maxRows){
              $(this).show()
            }
          })
          if(totalRows > maxRows){
            var pagenum = Math.ceil(totalRows/maxRows)
            for(var i=1;i<=pagenum;){
              $('.pagination').append('<li data-page ="'+i+'"><span>'+ i++ +'<span class="sr-only">(current)</span></span></li>').show()
            }
          }
          $('.pagination li:first-child').addClass('active')
          $('.pagination li').on('click',function(){
            var pageNum = $(this).attr('data-page')
            var trIndex = 0;
            $('pagination li').removeClass('active')
            $(this).addClass('active')
            $(table+' tr:gt(0)').each(function(){
              trIndex++
              if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                $(this).hide()
              } else {
                $(this).show()
              }
            })
          })
        })
        $(function(){
          $('table tr:eq(0)').prepend('<th>ID</th>')
          var id=0;
          $('table tr:gt(0)').each(function(){
            id++
            $(this).prepend('<td>'+id+'</td>')
          })
        })
      </script>

    </div>
  </body>
</html>