<?php
require_once("../connex.php");
function isValide($var){
    if(isset($var) and !empty($var)){
        return true;
    }else{
        return false;
    }
}
if(session_status()===PHP_SESSION_ACTIVE)
session_start();
require_once('../verificationUser.php');
verificationConnex();
verificationClient();
if(isset($_POST) && !empty($_POST)){
    if(isValide($_POST['type']) && isValide($_POST['objet'] && isValide($_POST['description']))){
        $pdostat = $pdo->prepare("insert into reclamations(type, objet, description, state,date, idClient) values(?, ?, ?, ?, ?, ?)");
        $pdostat->bindValue(1,valider($_POST['type']));
        $pdostat->bindValue(2,valider($_POST['objet']));
        $pdostat->bindValue(3, valider($_POST['description']));
        $pdostat->bindValue(4, 0);
        $pdostat->bindValue(5, date("Y-m-d"));
        $pdostat->bindValue(6, $_SESSION['id']);
        $pdostat->execute();
        header('Location: listReclamationByC.php');
    }else{
        echo "hi1";
        $err="Les données sont non valides";
        header('Location: addReclamation.php?err='.urlencode($err));
    }

}else{
    $content="";
    if(isset($_GET['err']) && !empty($_GET['err'])){
        $msg='<p>'.urldecode($_GET['err']).'</p>';
        echo "hi";
        $content=$msg;
    }
    $content.='<div class="full d-flex justify-content-start align-items-center">
    <div class="formu d-flex justify-content-center align-items-center">
    <form method="post" action="addReclamation.php" class="d-flex justify-content-start align-items-center flex-column">
        <select id="specialS" class="form-select mb-3" aria-label="Floating select example" required name="type">
            <option selected>Choisissez le type de votre réclamation</option>
            <option value="Fuite externe/interne">Fuite externe/interne</option>
            <option value="Facture">Facture</option>
            <option value="Autre">Autre</option>
        </select>
        <div class="beT form-floating mb-3 ml-3">
        <input type="text" class="form-control" id="objet" placeholder="Objet" name="objet">
        <label for="objet">Objet</label>
      </div>
      <div class="beT form-floating mb-3 ml-3">
            <textarea class="form-control" placeholder="Description" id="floatingTextarea2" style="height: 100px" name="description" required></textarea>
            <label for="floatingTextarea2">Description</label>
         </div>
         <div class="mybtns mt-2 d-flex">
            <div class="mb-3 me-2">
                <input type="submit" value="Envoyer">
            </div>
            <div class="mb-3 d-flex justify-content-center align-items-center" id="annuler"><a  href="listReclamationByC.php">Annuler</a></div>

        </div>
    
    </form></div></div>';
    
    require_once('../layout.php');
}
