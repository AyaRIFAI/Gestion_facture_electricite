<?php

require_once('../verificationUser.php');
verificationConnex();

function giveMeconsommAnc($annee, $mois, $pdo, $idClient){
    $moisAnc=($mois==1)?12:$mois-1;
    $anneeAnc=($mois==1)?$annee-1:$annee;
    $pdostat3 = $pdo->prepare(
            
        "SELECT valCompteur FROM consommations where idClient=? and mois=? and annee=?") ;
        $pdostat3->bindValue(1,  $idClient);
        $pdostat3->bindValue(2,  $moisAnc);
        $pdostat3->bindValue(3,  $anneeAnc);
        $pdostat3->execute();
        $consommAnc=$pdostat3->fetchAll();
        return $consommAnc;
}

function giveMeValMois($idClient, $annee, $mois, $valCompteurActuel,$pdo){
    $consommAnc=giveMeconsommAnc($annee, $mois, $pdo, $idClient);
    $anneeAnc=($mois==1)?$annee-1:$annee;
        if(!empty($consommAnc)){
            $consommAnc=$consommAnc[0][0];//valeur compteur du mois precedent
            if($mois==1){
                $pdostat4=$pdo->prepare("select consommAnnuelle from consomm_annuelle where idClient=? and annee=?");
                $pdostat4->bindValue(1, $idClient);
                $pdostat4->bindValue(2, ($anneeAnc));
                $pdostat4->execute();
                $T5=$pdostat4->fetchAll()[0];
                $diff=(abs(($T5[0] -$consommAnc)) > 100)?$T5[0] -$consommAnc:0;
                $valMois=$valCompteurActuel - $T5[0] +$diff;
            }
            $valMois=$valCompteurActuel - $consommAnc;
            return $valMois;
        }
        return $valCompteurActuel;
}