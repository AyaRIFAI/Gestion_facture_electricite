<?php
require_once("../connex.php");

require_once('../verificationUser.php');

verificationConnex();
verificationAdmin();
$pdostat = $pdo->prepare(
    "select consommAnnuelle,annee, lastName, firstName, consomm_annuelle.idClient, nomZone from consomm_annuelle join clients on clients.idClient=consomm_annuelle.idClient join zonegeo on clients.idZoneGeo=zonegeo.id");
    $pdostat->execute();
    $title="Liste des consommations annuelles";
    $content='
    <div class="bgNew">
        <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:40px;">
            <div class="d-flex gap-5 justify-content-center mt-3">
                <div class="modifier">
                    <a href="../espaceAdmin.php">Revenir à votre espace</a>
                </div>
            </div>
        </div>
        <div class="myTab d-flex flex-column justify-content-around">
            <table class="table table-striped">';
    foreach($pdostat->fetchAll() as $ligne){
        $content.="<tr><td>Année: ".$ligne ['annee']."</td><td>Client d'ID: ".$ligne ['idClient']."</td><td>Zone: ".$ligne ['nomZone']."</td><td>Consommation annuelle: ".$ligne ['idClient']." kw</td></tr></div>";
    }
    $content.='</table></div></div>';

    require_once('../layout.php');