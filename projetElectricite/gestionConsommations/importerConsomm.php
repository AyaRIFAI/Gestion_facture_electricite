<?php

require_once('../verificationUser.php');


verificationConnex();
verificationAgentI();
$title="Importer consommation annuelle";

if(isset($_SESSION['isAgent'])){

    if(isset($_FILES['consommFile']) && !empty($_FILES['consommFile'])){
        if ($_FILES['consommFile']['error']) {
            switch ($_FILES['consommFile']['error']){
              case 1: // UPLOAD_ERR_INI_SIZE
                $err="Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                break;
              case 2: // UPLOAD_ERR_FORM_SIZE
               $err="Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                break;
              case 3: // UPLOAD_ERR_PARTIAL
               $err="L'envoi du fichier a été interrompu pendant le transfert !";
                break;
              case 4: // UPLOAD_ERR_NO_FILE
                $err="Le fichier que vous avez envoyé a une taille nulle !";
                break;
            }
            $_SESSION['err']=$err;
            header('Location: importerConsomm.php');
          }else{
            require_once("../connex.php");
            $nom = $_FILES['consommFile']['tmp_name'];
            $nomdestination = '../consommFiles/'.$_SESSION['id'].'_'.$_SESSION["anneeAimporter"].'_'.$_FILES['consommFile']['name'];
            move_uploaded_file($nom, $nomdestination);
            $anneeSuivante=$_SESSION["anneeAimporter"]+1;
            $pdostatA = $pdo->prepare(

              "update agent set anneeAimporter=? where id=?") ;
          
              $pdostatA->bindValue(1, $anneeSuivante); 
              $pdostatA->bindValue(2, $_SESSION['id']);
              $pdostatA->execute();
              $_SESSION["anneeAimporter"]=$anneeSuivante;
              $file=fopen($nomdestination, "r");
              while ($userinfo = fscanf($file, "%D %D %D %D\n")) {
                list ($idClient, $consommAnn, $annee, $idZoneGeo) = $userinfo;
                $pdostatI = $pdo->prepare(
                  "insert into consomm_annuelle(idClient, consommAnnuelle, idZoneGeo, annee) values(?, ?, ?, ?)");
                  $pdostatI->bindValue(1,$idClient);
                  $pdostatI->bindValue(2,$consommAnn);
                  $pdostatI->bindValue(3,$idZoneGeo);
                  $pdostatI->bindValue(4,$annee);
                  $pdostatI->execute();
                  header('Location: importerConsomm.php?s');
            }
    }
}else{ 
    $s=(isset($_GET['s']))?'<p style="color: white; font-weight:bold;">Le fichier est bien importé!</p>':'';
    $content="";
    if(isset($_SESSION['err']) && !empty($_SESSION['err'])){
        $content=$_SESSION['err'];
        $_SESSION['err']="";
    }
    $content.='<div class="full d-flex justify-content-start align-items-center" style="position:relative;">
    <div class="formu d-flex justify-content-center align-items-center flex-column gap-5">
    <p style="font-weight: bolder; font-size: xx-large; color:white;">Bonjour cher Agent</p>'.$s.'
    <form method="POST" action="importerConsomm.php"  enctype="multipart/form-data" class="d-flex justify-content-start align-items-center flex-column">
      <div class="beT mb-3 ml-3">
        <label for="moisApayer" style="font-size:larger; font-weight:bold">Vous pouvez Importer Le fichier de consommation Annuelle de l\'année</label>
        <input type="text" name="anneeAimporter" value='.$_SESSION['anneeAimporter'].' readonly>
      </div>
      <div class=" mb-3">
        <input class="form-control" type="file" id="formFile" name="consommFile">
      </div>
      <div class=" mybtns mb-3 me-2">
        <input type="submit" value="Envoyer">
      </div>
   
    </form>
    </div>
    <div class="dec mt-3 me-5 lien" style="position:absolute; top:10px;right:10px"><a href="../deconnex.php">Se déconnecter</a></div>
    </div>';  
    require_once('../layout.php');

}
    

}