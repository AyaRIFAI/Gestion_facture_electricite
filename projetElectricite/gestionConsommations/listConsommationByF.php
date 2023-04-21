<?php
require_once("../connex.php");

require_once('../verificationUser.php');
verificationConnex();
verificationAdmin();
$pdostat = $pdo->prepare(
    "select consommations.id, mois, annee, lastName, firstName,consommations.idClient  from consommations join clients on consommations.idClient=clients.idClient where state=-1"); 
    $pdostat->execute();
    $title="Liste des consommations non traitées";
    $content='
    <div class="bgNew" style="position:relative">
        <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:10px;">
            <div class="d-flex gap-5 justify-content-center mt-3">
            <div class="modifier">
                    <a href="listeFactureByF.php">Liste des factures</a>
                </div>
                <div class="modifier">
                    <a href="../espaceAdmin.php">Revenir à votre espace</a>
                </div>
            </div>
        </div>
    <div class="myTab d-flex flex-column justify-content-around"><table class="table table-striped">';
    foreach($pdostat->fetchAll() as $ligne){
        $content.="<tr><td>".$ligne['mois']."/".$ligne ['annee']."</td><td>Client N°: ".$ligne['idClient']." ".$ligne['lastName']." ".$ligne['firstName']."</td><td><div class='lien3 mibtn'><a href=\"consommation.php?c=".$ligne['id']."\">Afficher consommation</a></div></td>";
    }  
    $content.='</table></div>';

    
    require('../layout.php');
    