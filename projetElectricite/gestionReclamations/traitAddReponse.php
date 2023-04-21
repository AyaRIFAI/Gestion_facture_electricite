<?php
require_once('../connex.php');
if(session_status()===PHP_SESSION_ACTIVE)
session_start();
require_once('../verificationUser.php');
verificationConnex();
verificationAdmin();

$pdostat = $pdo->prepare(
    "insert into reponses(reponse, date, idAdmin, idClient, idReclamation) values(?, ?, ?, ? ,?)");
    $pdostat->bindValue(1, valider($_POST['reponse']));
    $pdostat->bindValue(2, date("Y-m-d"));
    $pdostat->bindValue(3, null);
    $pdostat->bindValue(4, null);
   

    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
        $pdostat->bindValue(3, $_SESSION['id']);    
    }else if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==0){
        $pdostat->bindValue(4, $_SESSION['id']);
    }

    $pdostat->bindValue(5, valider($_POST['idReclamation']));
    $pdostat->execute();
    header('Location: reclamation.php?r='.valider($_POST['idReclamation']));
