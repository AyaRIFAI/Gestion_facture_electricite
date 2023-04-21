<?php
require_once("../connex.php");
if(session_status()===PHP_SESSION_ACTIVE)
session_start();
require_once('../verificationUser.php');
verificationConnex();
verificationClient();
$pdostat = $pdo->prepare(
    "select * from reclamations where idClient=? order by reclamations.id DESC"); 
    $pdostat->bindValue(1, $_SESSION['id']);
    $pdostat->execute();
    $title="Vos réclamations";
    $content='
    <div class="bgNew">
    <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:40px;">
        <div class="d-flex gap-5 justify-content-center mt-3">
            <div class="modifier">
                <a href="addReclamation.php">Ajouter une réclamation</a>
            </div>
            <div class="modifier">
                <a href="../espaceClient.php">Revenir à votre espace</a>
            </div>
        </div>
    </div>
        <div class="myTab d-flex flex-column justify-content-around">
            <table class="table table-striped">';
    foreach($pdostat->fetchAll() as $ligne){
        $content.="<tr><td>".$ligne['date']."</td><td>Type: ".$ligne['type']."</td><td>Objet: ".$ligne['objet']."</td><td><div class='lien2 mibtn'><a href=\"reclamation.php?r=".$ligne['id']."\">Afficher réclamation</a></div></td>";
    }  
    $content.='</table></div></div>';
    
    
    require('../layout.php');
    