<?php 

function insertOption( $aOption )
{
    global $bdd;

    $sQuery = "INSERT INTO fiche_option (off_id, met_name, opt_field, opt_active) VALUES ( :off_id, :met_name, :opt_field, :opt_active)";

    // Executer la requete
    try {
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':off_id', $aOption['off_id'], PDO::PARAM_STR);
        $stmt1->bindValue(':met_name', $aOption['met_name'], PDO::PARAM_STR);
        $stmt1->bindValue(':opt_field', $aOption['opt_field'], PDO::PARAM_STR);
        $stmt1->bindValue(':opt_active', $aOption['opt_active'], PDO::PARAM_INT);
        $stmt1->execute(); 
        // Requete OK
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur insertion", 1);        
    }
       
}

function readOption( $opt_id )
{
    global $bdd;

    $aData = array();

    $sQuery = "SELECT * FROM fiche_option WHERE opt_id = :opt_id LIMIT 1";

    // Executer la requete
    try {
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':opt_id', $opt_id, PDO::PARAM_INT);

        if ( $stmt1->execute() ) {
            $aData = $stmt1->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur affichage", 1);        
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
    try {
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':off_id', $aOption['off_id'], PDO::PARAM_STR);
        $stmt1->bindValue(':met_name', $aOption['met_name'], PDO::PARAM_STR);
        $stmt1->bindValue(':opt_field', $aOption['opt_field'], PDO::PARAM_STR);
        $stmt1->bindValue(':opt_active', $aOption['opt_active'], PDO::PARAM_INT);
        $stmt1->bindValue(':opt_id', $aOption['opt_id'], PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
        // Requete OK
        }
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur modification", 1);        
    }
}


function deleteOption( $opt_id )
{
    global $bdd;

    $sQuery = " DELETE FROM fiche_option WHERE opt_id = :opt_id";

    // Executer la requete
    try {
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':opt_id', $opt_id, PDO::PARAM_INT);
        $stmt1->execute();
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur suppression", 1);        
    }

}

function indexOption()
{
    global $bdd;

    $aReturn = array();

    try{
        $sth = $bdd->query("SELECT opt.opt_id, o.off_designation, opt.met_name, opt.opt_field, opt.opt_active
                            FROM fiche_offre o
                            JOIN fiche_option opt ON o.off_id = opt.off_id") ;
        $sth->execute();
        $aReturn = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur affichage", 1);        
    }
    
    return( $aReturn );
}

function indexMethode()
{
    global $bdd;

    $aReturn = array();

    try{
        $sth = $bdd->query("SELECT * FROM fiche_methode") ;
        $sth->execute();
        $aReturn = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur affichage", 1);        
    }
    
    return( $aReturn );
}
