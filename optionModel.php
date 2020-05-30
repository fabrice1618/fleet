<?php 

function insertOption( $aOption )
{
    global $bdd;

    $sQuery = "INSERT INTO fiche_option (off_id, met_name, opt_field, opt_active) VALUES ( :off_id, :met_name, :opt_field, :opt_active)";

    // Executer la requete
    $stmt1 = $bdd->prepare( $sQuery );
    $stmt1->bindValue(':off_id', $aOption['off_id'], PDO::PARAM_STR);
    $stmt1->bindValue(':met_name', $aOption['met_name'], PDO::PARAM_STR);
    $stmt1->bindValue(':opt_field', $aOption['opt_field'], PDO::PARAM_STR);
    $stmt1->bindValue(':opt_active', $aOption['opt_active'], PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
        // Requete OK
   }

}

function readOption( $opt_id )
{
    global $bdd;

    $sQuery = "SELECT * FROM fiche_option WHERE opt_id = :opt_id LIMIT 1";

    // Executer la requete
    $stmt1 = $bdd->prepare( $sQuery );
    $stmt1->bindValue(':opt_id', $opt_id, PDO::PARAM_INT);

    if ( $stmt1->execute() ) {
        $aData = $stmt1->fetch(PDO::FETCH_ASSOC);
   }

   return($aData);
}

function updateOption( $aOption )
{
    global $bdd;

    $sQuery = " UPDATE fiche_option 
                SET off_id = :off_id, met_name = :met_name, opt_field = :opt_field, opt_active = :opt_active
                WHERE opt_id = :opt_id";

    // Executer la requete
    $stmt1 = $bdd->prepare( $sQuery );
    $stmt1->bindValue(':off_id', $aOption['off_id'], PDO::PARAM_STR);
    $stmt1->bindValue(':met_name', $aOption['met_name'], PDO::PARAM_STR);
    $stmt1->bindValue(':opt_field', $aOption['opt_field'], PDO::PARAM_STR);
    $stmt1->bindValue(':opt_active', $aOption['opt_active'], PDO::PARAM_INT);
    $stmt1->bindValue(':opt_id', $aOption['opt_id'], PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
        // Requete OK
   }

}


function deleteOption( $opt_id )
{
    global $bdd;

    $sQuery = " DELETE FROM fiche_option WHERE opt_id = :opt_id";

    // Executer la requete
    $stmt1 = $bdd->prepare( $sQuery );
    $stmt1->bindValue(':opt_id', $opt_id, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
        // Requete OK
   }

}

function indexOption()
{
    global $bdd;

    $sth = $bdd->query("    SELECT opt.opt_id, o.off_designation, opt.met_name, opt.opt_field, opt.opt_active
                            FROM fiche_offre o
                            JOIN fiche_option opt ON o.off_id = opt.off_id") ;
    $sth->execute();
          
    return( $sth->fetchAll(PDO::FETCH_ASSOC) );
}

function indexMethode()
{
    global $bdd;

    $sth = $bdd->query("SELECT * FROM fiche_methode") ;
    $sth->execute();
          
    return( $sth->fetchAll(PDO::FETCH_ASSOC) );
}