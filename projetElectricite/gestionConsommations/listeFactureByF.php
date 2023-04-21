<?php
require_once("../connex.php");

require_once('../verificationUser.php');
verificationConnex();
verificationAdmin();
if(isset($_GET['p']) && !empty($_GET['p'])){
    $pdostat = $pdo->prepare(
        "update consommations set state=1 where id=?"); 
        $pdostat->bindValue(1,valider($_GET['p']));
        $pdostat->execute();
        header('Location: listeFactureByF.php');
}else{
    $limit=10;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $start=($page - 1 ) * $limit;
    $end=$start+$limit;
    $pdostat = $pdo->prepare(
        "select * from consommations where state in (0, 1) order by id desc limit ".$start.", ".$end);
       
        $pdostat->execute();
        $title="Liste des factures";
        
        $content='
        <div class="bgNew">
        <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:40px;">
            <div class="d-flex gap-5 justify-content-center mt-3">
                <div class="modifier">
                    <a href="../espaceAdmin.php">Revenir à votre espace</a>
                </div>
            </div>
        </div>
        <div class="myTab d-flex flex-column justify-content-around"><table class="table table-striped">';
        foreach($pdostat->fetchAll() as $ligne){
            $var=($ligne['state']==1)?"Payée":"<div class='lien2 mibtn'><a href=\"listeFactureByF.php?p=".$ligne['id']."\">Déclarer comme payée</a></div>";
            $content.="<tr><td>".$ligne['mois']."/".$ligne ['annee']."</td><td> Facture N° ".$ligne['id']."</td><td><div class='lien2 mibtn'><a href=\".".$ligne ['urlFacture']."\" download=\"facture".$ligne['mois']."/".$ligne ['annee'].".txt\">Afficher facture</a></div></td><td>".$var."</td>";
        }  
        $content.='</table>
        <nav aria-label="...">
            <ul class="pagination pagination-lg">
                <li class="page-item ">
                <a class="page-link" href="listeFactureByF.php?page=1" tabindex="-1">1</a>
                </li>
                <li class="page-item"><a class="page-link"  href="listeFactureByF.php?page=2">2</a></li>
                <li class="page-item"><a class="page-link"  href="listeFactureByF.php?page=3">3</a></li>
            </ul>
        </nav>
        </div></div>';
        require('../layout.php');
}

    
   
    