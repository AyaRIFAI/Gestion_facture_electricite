<?php
require_once("../connex.php");

require_once('../verificationUser.php');
if(!(session_status()===PHP_SESSION_ACTIVE)){
    session_start();
}

verificationConnex();
verificationClient();
// print($_SESSION['isAdmin']);
$pdostat = $pdo->prepare(

    "SELECT moisApayer, anneeApayer FROM clients where idClient=?");
    $pdostat->bindValue(1, $_SESSION['id']);
    $pdostat->execute();
$title="Ajouter Consommation";
$content="";
$date=$pdostat->fetchAll();
if(isset($_SESSION['err']) && !empty($_SESSION['err'])){
    $content=$_SESSION['err'];
    $_SESSION['err']="";
   
}
$content.='<div class="full d-flex justify-content-start align-items-center">
<div class="formu d-flex justify-content-center align-items-center">
    <form method="post" action="traitAddConsomm.php" enctype="multipart/form-data" class="d-flex justify-content-start align-items-center flex-column">
        <div class="beT form-floating mb-3 ml-3">
            <input type="text" class="form-control" aria-label="default input example" name="moisApayer" id="moisApayer" value="'.$date[0][0].'" readonly>
            <label for="moisApayer">Le mois</label>
        </div>
        <div class="beT form-floating mb-3">
            <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" name="anneeApayer" value="'.$date[0][1].'" readonly>
            <label  for="anneeApayee">L\'année</label>
        </div>
        <div class="beT mb-3 ">
        <div class="lien4">
        <label for="image_path">Importer l\'image du compteur</label>
        </div>
            <input class="form-control  d-none" type="file" id="image_path" name="image_path" accept="image/png, image/jpeg">
        </div>
        <div class="beT form-floating mb-3">
            <input class="form-control" type="text"  aria-label="default input example" id="valCompteur" name="valCompteur" placeholder="Valeur du compteur">
            <label for="valCompteur">Valeur_du_compteur</label>
        </div>

        <div class="mybtns mt-2 d-flex">
            <div class="mb-3 me-2">
                <input type="submit" value="Envoyer">
            </div>

            <div class="mb-3 d-flex justify-content-center align-items-center" id="annuler"><a  href="listConsommationByC.php">Annuler</a></div>
        </div>
    </form>
</div></div>';

require_once('../layout.php');


//         '<form method="post" action="traitAddConsomm.php" enctype="multipart/form-data">
//     <div class="mb-3">
//         <label for="moisApayer" class="form-label">Le mois</label>

//         <input class="form-control" type="text" aria-label="default input example" name="moisApayer" id="moisApayer" value="'.$date[0][0].'" readonly>
//     </div>
//     <div class="mb-3">
//     <label for="anneeApayee" class="form-label">L\'année</label>
//     <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" name="anneeApayer" name="anneeApayee" value="'.$date[0][1].'" readonly>
//     </div>
//     <div class="mb-3">
//     <input class="form-control" type="file" id="image_path" name="image_path" accept="image/png, image/jpeg" readonly>
//         <label for="image_path" class="form-label">Importer l\'image du compteur</label>
//     </div>
//     <div class="mb-3">
//     <input class="form-control" type="text"  aria-label="default input example" id="valCompteur" name="valCompteur">
//     <label for="valCompteur" class="form-label">Valeur du compteur</label>
//     </div>
//     <div>
//         <input type="submit" value="Envoyer">
//     </div>

// </form>';