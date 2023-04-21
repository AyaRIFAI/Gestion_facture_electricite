<?php
require('../connex.php');
if(session_status()===PHP_SESSION_ACTIVE)
session_start();
require_once('../verificationUser.php');
verificationConnex();
verificationClient();
if(isset($_GET['r']) && !empty($_GET['r'])){
    $pdostat = $pdo->prepare(
        "update reclamations set state=1 where id=?");
        $pdostat->bindValue(1, valider($_GET['r'])); 
        $pdostat->execute();
       require('reclamation.php');
}
