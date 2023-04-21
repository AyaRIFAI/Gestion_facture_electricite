<?php
require_once("../connex.php");

require_once('../verificationUser.php');
if(!(session_status()===PHP_SESSION_ACTIVE)){
    session_start();
}

verificationConnex();
verificationAdmin();
$pdostat = $pdo->prepare(
    "select * from clients join zonegeo on zonegeo.id=clients.idZoneGeo"); 
    $pdostat->execute();
    $title="Liste des clients";
   
    $noeud="";
    foreach($pdostat->fetchAll() as $ligne){
    
    $noeud.='
    
        <tr><td><div>'.$ligne['idClient'].'</td><td>'.$ligne["lastName"].'</td><td>'.$ligne["firstName"].'</td><td class="d-flex justify-content-center"><div class="lien" style="width:fit-content;"><a href="profilClient.php?c='.$ligne['idClient'].'">Afficher le profil</a>'.'</div></td></tr>';
} 
$content='
<div class="bgNew">
    <div class="d-flex gap-5 justify-content-center mt-3">
        <div class="d-flex justify-content-center gap-3 mb-5" style="position:absolute; top:10px; right:40px;">
            <div class="d-flex gap-5 justify-content-center mt-3">
                <div class="modifier">
                    <a href="addClient.php">Ajouter un client</a>
                </div>
                <div class="modifier">
                    <a href="../espaceAdmin.php">Revenir à votre espace</a>
                </div>
            </div>
        </div>
    </div>
<div class="myTab d-flex flex-column justify-content-around" style="width:40%"><table class="table table-striped"><tr><th>ID Client</th><th>Nom</th><th>Prénom</th><th></th></tr>';
$content.=$noeud.'</table></div></div>';

    require('../layout.php');
       
    // $noeud.='<div class="accordion fixSize" id="accordionPanelsStayOpenExample">
    // <div class="accordion-item">
    //   <h2 class="accordion-header" id="'.$ligne['idClient'].'">
    //     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
    //       Client N° '.$ligne['idClient'].'
    //     </button>
    //   </h2>
    //   <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="'.$ligne['idClient'].'">
    //     <div class="accordion-body">
    //        <p>Nom: '.$ligne['lastName'].'</p>
    //        <p>Prénom: '.$ligne['firstName'].'</p>
    //        <p>Date de naissance: '.$ligne['dateOfBirth'].'</p>
    //        <p>Tel:  '.$ligne['tel'].'</p>
    //        <p>Email:  '.$ligne['email'].'</p>
    //        <p>Adresse:  '.$ligne['adressResid'].'</p>
    //        <p>Zone Géographique:  '.$ligne['nomZone'].'</p>
    //        <div class="lien2"><a href="modifyClient.php?c='.valider($ligne['idClient']).'">Modifier ce profil</a></div>
    //     </div>
    //   </div>
    // </div>';
