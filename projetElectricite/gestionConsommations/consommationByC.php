<?php
require_once("../connex.php");
require_once("genererFacture.php");
require_once("Operation.php");
require_once('../verificationUser.php');

verificationConnex();
verificationClient();
$title="Afficher une consommation";

if($consomm=valider($_GET['c'])){
   
    $pdostat = $pdo->prepare(
    "select * from consommations where id=".$consomm); 
    $pdostat->execute();
    $T1=$pdostat->fetchAll()[0];
    $content='<div class="full3"><div class="body3 d-flex flex-column justify-content-center align-items-start"><div class="profil p-5 d-flex flex-column justify-content-start align-items-start">'.'<h2>Votre consommation du '.$T1["mois"].'/'.$T1["annee"].'</h2>';
    $content.='<img id="proof" src=\''.$T1['image_path'].'\'><p class="mt-5">Consommation en (Kw): '.$T1['valCompteur'].'</p><div class="ml-3 modifier"><a href="listConsommationByC.php">Retouner à la liste</a></div></div><div></div></div>';
    require_once("../layout.php");
}
