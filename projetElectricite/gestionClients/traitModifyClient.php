<?php
require_once('../connex.php');

require_once('../verificationUser.php');
if(!(session_status()===PHP_SESSION_ACTIVE)){
    session_start();
}

verificationConnex();
verificationAdmin();

$pdostat = $pdo->prepare(

    "update clients set lastName=?, firstName=?, dateOfBirth=?, tel=?, email=?,adressResid=?, idZoneGeo=?, idAdmin=? where idClient=?") ;

    $pdostat->bindValue(1, valider($_POST['lastName'])); 
    $pdostat->bindValue(2, valider($_POST['firstName'])); 
    $pdostat->bindValue(3, valider($_POST['dateOfBirth'])); 
    $pdostat->bindValue(4, valider($_POST['tel'])); 
    $pdostat->bindValue(5, valider($_POST['email'])); 
    $pdostat->bindValue(6, valider($_POST['adressResid'])); 
    $pdostat->bindValue(7, valider($_POST['varoptions'])); 
    $pdostat->bindValue(8, $_SESSION['id']);
    $pdostat->bindValue(9,valider($_GET['c'])); 
    $pdostat->execute();
    $c=valider($_GET['c']);
    header('Location: profilClient.php?c='.$c);
    // header('Location: profilClient.php?s='.$pdo->lastInsertId());
