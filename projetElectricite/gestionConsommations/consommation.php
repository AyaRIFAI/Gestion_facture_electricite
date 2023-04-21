<?php
require_once("../connex.php");
require_once("genererFacture.php");
require_once("Operation.php");

require_once('../verificationUser.php');
verificationConnex();
verificationAdmin();
$title="Afficher une consommation";
if($consomm=valider($_GET['c'])){
   
    $pdostat = $pdo->prepare(
    "select * from consommations where id=".$consomm); 
    $pdostat->execute();
    $T1=$pdostat->fetchAll()[0];
    $content="<div class='full3'><div class='body3 d-flex flex-column justify-content-center align-items-start'><div class='profil p-5 d-flex flex-column justify-content-start align-items-start'>".'<h2>La consommation du Client N° '.$T1["idClient"].' '.$T1["mois"].'/'.$T1["annee"].'</h2><img id="proof" src=\''.$T1['image_path'].'\'><div class="mt-3"><form action="consommation.php" method="POST" class="d-flex gap-3"><input type="text" name="valCompteur" value="'.$T1['valCompteur'].'"><input type="hidden" name="c" value="'.$consomm.'"><div><input class="lienInput" type="submit" value="Valider et Generer la facture"></div></form></div><div class="lien3 mt-5"><a href="listConsommationByF.php">Retourner à liste</a></div></div><div></div>';
    require_once("../layout.php");
}else if($consomm=valider($_POST["c"])){
    $pdostat = $pdo->prepare(
        "select * from consommations where id=".$consomm); 
        $pdostat->execute();
        $T1=$pdostat->fetchAll()[0];
    $pdostat3 = $pdo->prepare(
        "update consommations set valCompteur=? where id=?"); 
        $pdostat3->bindValue(1, valider($_POST["valCompteur"]));
        $pdostat3->bindValue(2, $consomm);
        $pdostat3->execute();
        $valMois=giveMeValMois($T1["idClient"], $T1["annee"], $T1["mois"], valider($_POST["valCompteur"]),$pdo);          
        genererFacture($consomm,$T1["idClient"], $T1["mois"], $T1["annee"], $pdo, $valMois);
        header('Location: listConsommationByF.php');
    }
