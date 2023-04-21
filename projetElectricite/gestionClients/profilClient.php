<?php
require_once("../connex.php");

require_once('../verificationUser.php');
if(!(session_status()===PHP_SESSION_ACTIVE)){
    session_start();
}

verificationConnex();
verificationAdmin();
$c="";
if(isset($_GET['c']) && !empty($_GET['c'])){
    $c=valider($_GET['c']);
}
$pdostat = $pdo->prepare(

    "SELECT * FROM clients where idClient=?") ;
    $pdostat->bindValue(1, $c);
    $pdostat->execute();
    print($c);
    // print_r($pdostat->fetchAll());
$title="Profil Client";
$noeud="";
if((isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) || (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==0 && $_SESSION['id']==$c)){
    foreach($pdostat->fetchAll() as $client){
        $pdostat2 = $pdo->prepare(
            "SELECT * FROM zonegeo where id=?") ;
            $pdostat2->bindValue(1, valider($client['idZoneGeo']));
            $pdostat2->execute();
            $noeud='<div class="profil p-5 d-flex flex-column justify-content-start align-items-start"><p>Nom: '.valider($client['lastName']).'</p><p>Prénom: '.valider($client['firstName']).'</p>
            <p>Date de naissance: '.valider($client['dateOfBirth']).'</p>
            <p>Tel: '.valider($client['tel']).'</p>
            <p>Adresse email: '.valider($client['email']).'</p>
            <p>Adresse de résidence: '.valider($client['adressResid']).'</p>
            <p>Zone géographique: '.valider(($pdostat2->fetchAll())[0][1]).'</p>
            <div class="mt-3 d-flex gap-5"><div class="modifier"><a href="modifyClient.php?c='.valider($client['idClient']).'">Modifier</a></div><div class="ml-3 modifier"><a href="listClients.php">Retouner à la liste</a></div></div><div>';       
        }
        $content="<div class='full3'><div class='body3 d-flex flex-column justify-content-center align-items-start'>".$noeud."</div></div>";
}else{
    $content="<p>Vous n'êtes pas autorisés d'acceder au contenu de cette page</p>;";
}

require_once("../layout.php");
