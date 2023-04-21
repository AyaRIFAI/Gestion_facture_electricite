<?php
require_once('connex.php');
require_once('verificationUser.php');

verificationConnex();
verificationClientO();
$pdostat = $pdo->prepare(
   "select * from clients where idClient=?");
    $pdostat->bindValue(1, $_SESSION['id']); 
    $pdostat->execute();
    $client=$pdostat->fetchAll()[0];
$title="Espace Admin";
$content="<div class='row row-cols-2 full'>
    <div class='col d-flex justify-content-center align-items-center'>
        <h2>Bienvenue ".$client['lastName']." ".$client['firstName']."<h2>
    </div>
    <div class='col d-flex flex-column justify-content-start align-items-end'><div class='mt-5 me-5 lien'><a href='deconnex.php'>Se déconnecter</a></div></div>
    <div class='col d-flex flex-column justify-content-evenly align-items-center'>
        <div class='lien'><a href='gestionConsommations/listConsommationByC.php'>Liste des consommations</a></div>
        <div class='lien'><a href='gestionReclamations/listReclamationByC.php'>Liste des réclamations</a></div>
    </div>
    
    
    <div class='col d-flex justify-content-end align-items-end'></div>

    </div>";
require_once("layout.php");
// <a href='addClient.php'>Ajouter un client</a>