<?php 


function insertOffre( $aOffre )
{
    global $bdd;

    $sQuery = "INSERT INTO fiche_offre (off_id, off_designation, off_descriptif, off_date_debut, off_date_fin) 
    VALUES (:off_id, :off_designation, :off_descriptif, :off_date_debut, :off_date_fin)";

    // Executer la requete
    try {
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':off_id', $aOffre['off_id'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_designation', $aOffre['off_designation'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_descriptif', $aOffre['off_descriptif'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_date_debut', $aOffre['off_date_debut'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_date_fin', $aOffre['off_date_fin'], PDO::PARAM_STR);
        $stmt1->execute();
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur insertion", 1);        
    }

}

function readOffre( $off_id )
{
    global $bdd;

    $aData = array();

    $sQuery = "SELECT * FROM fiche_offre WHERE off_id = :off_id LIMIT 1";

    // Executer la requete
    try {
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':off_id', $off_id, PDO::PARAM_STR);
    
        if ( $stmt1->execute() ) {
            $aData = $stmt1->fetch(PDO::FETCH_ASSOC);
       }
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur insertion", 1);        
    }

   return($aData);
}

function updateOffre( $nIdOrigin, $aOffre )
{
    global $bdd;

    $sQuery = " UPDATE fiche_offre 
                SET off_id= :off_id, off_designation = :off_designation, off_descriptif = :off_descriptif, off_date_debut = :off_date_debut, off_date_fin = :off_date_fin
                WHERE off_id = :off_id_orig";

    // Executer la requete
    try{
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':off_id', $aOffre['off_id'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_designation', $aOffre['off_designation'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_descriptif', $aOffre['off_descriptif'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_date_debut', $aOffre['off_date_debut'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_date_fin', $aOffre['off_date_fin'], PDO::PARAM_STR);
        $stmt1->bindValue(':off_id_orig', $nIdOrigin, PDO::PARAM_STR);
        $stmt1->execute();

    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur insertion", 1);        
    }

}

function deleteOffre( $off_id )
{
    global $bdd;

    $sQuery = " DELETE FROM fiche_offre WHERE off_id = :off_id";

    // Executer la requete
    try{
        $stmt1 = $bdd->prepare( $sQuery );
        $stmt1->bindValue(':off_id', $off_id, PDO::PARAM_STR);
        $stmt1->execute();
    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur insertion", 1);        
    }

}

function indexOffre()
{
    global $bdd;

    $aReturn = array();

    // Executer la requete
    try{
        $sth = $bdd->query("SELECT * FROM fiche_offre");
        $sth->execute();
        $aReturn = $sth->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $erreur) {
        errorlog( errorMessage( __FUNCTION__, $erreur->getMessage() ) );
        throw new Exception("Erreur insertion", 1);        
    }
          
    return( $aReturn );
}


