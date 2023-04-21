<?php
require_once("../connex.php");

require_once('../verificationUser.php');
verificationConnex();
verificationClient();
$limit=10;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $start=($page - 1 ) * $limit;
    $end=$start+$limit;
$pdostat = $pdo->prepare(
    "select consommations.id, mois, annee, state, urlFacture from consommations where idClient=? order by  consommations.id desc limit $start, $end"); 
    
    $pdostat->bindValue(1, $_SESSION['id']);
    // $pdostat->bindValue(2, $start);
    // $pdostat->bindValue(3, $end);
    $pdostat->execute();
    $title="Liste de vos consommations";
    $content='
    <div class="bgNew" style="position:relative">
        <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:10px;">
            <div class="d-flex gap-5 justify-content-center mt-3">
                <div class="modifier">
                    <a href="addConsommation.php">Ajouter Consommation</a>
                </div>
                <div class="modifier">
                    <a href="../espaceClient.php">Revenir à votre espace</a>
                </div>
            </div>
        </div>
        
    <div class="myTab d-flex flex-column justify-content-around"><table class="table table-striped">';
    foreach($pdostat->fetchAll() as $ligne){
        $isPaye="Non payé";
        switch($ligne['state']){
            case -1:
                $state="En cours de traitement";
                break;
            case 0;
                $state="<div class='lien2 mibtn'><a href=\".".$ligne['urlFacture']."\" download=\"facture".$ligne['mois']."/".$ligne ['annee']."\">Télécharger la facture</a></div>";
                break;
            case 1;
                $state="<div class='lien2 mibtn'><a href=.".$ligne['urlFacture']." download=\"facture".$ligne['mois']."/".$ligne ['annee'].".txt\">Télécharger la facture</a></div>";
                $isPaye="Payé";

                break;
            }
        $content.="<tr><td>".$ligne['mois']."/".$ligne ['annee']."</td><td><div class='lien3 mibtn'><a href=\"consommationByC.php?c=".$ligne['id']."\">Afficher consommation</a></div></td><td>".$isPaye."</td><td>".$state."</td></div>";
    }  
    $content.='</table>
    <nav aria-label="...">
        <ul class="pagination pagination-lg">
            <li class="page-item ">
            <a class="page-link" href="listConsommationByC.php?page=1" tabindex="-1">1</a>
            </li>
            <li class="page-item"><a class="page-link"  href="listConsommationByC.php?page=2">2</a></li>
            <li class="page-item"><a class="page-link"  href="listConsommationByC.php?page=3">3</a></li>
        </ul>
    </nav></div>
';

    
    require('../layout.php');
    // 