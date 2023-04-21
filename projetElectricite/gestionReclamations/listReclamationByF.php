<?php
require_once("../connex.php");
if(session_status()===PHP_SESSION_ACTIVE)
session_start();
require_once('../verificationUser.php');
verificationConnex();
verificationAdmin();
$pdostat = $pdo->prepare(
    "select * from reclamations where state=0 order by id DESC"); 
   
    $pdostat->execute();
    $title="Les réclamations non résolues";
    $content='
    <div class="bgNew">
    <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:40px;">
        <div class="d-flex gap-5 justify-content-center mt-3">
            <div class="modifier">
                <a href="../espaceAdmin.php">Revenir à votre espace</a>
            </div>
        </div>
    </div>
    <div class="myTab d-flex flex-column justify-content-around"><h2 class="mb-5" style="color: white;">Les réclamations non résolues</h2><table class="table table-striped">';
    foreach($pdostat->fetchAll() as $ligne){
        $content.="<tr><td>".$ligne['date']."</td><td>Client N° ".$ligne['idClient']."</td><td>Type: ".$ligne['type']."</td><td>Objet: ".$ligne['objet']."</td><td><div class='lien3 mibtn'><a href=\"reclamation.php?r=".$ligne['id']."\">Afficher réclamation</a></td>";
    }  
    $content.='</table>';
    
    
    require('../layout.php');
    