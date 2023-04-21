<?php

require_once('verificationUser.php');
verificationConnex();
verificationAdminO();
$title="Espace Admin";

$content="<div class='row row-cols-2 full'>
    <div class='col d-flex justify-content-center align-items-center'>
        <h1>Espace Fournisseur</h1>
    </div>
    <div class='col d-flex justify-content-start align-items-start flex-row-reverse'><div class='mt-3 me-5 lien'><a href='deconnex.php'>Se déconnecter</a></div><div class='mt-3 me-5 lien'><a href='gestionConsommations/consommAnnuelle.php'>Vérifier la consommation annuelle</a></div><div class='lien mt-3 me-5'><a href='gestionClients/listClients.php'>Liste des clients</a></div></div>
    <div class='col d-flex flex-column justify-content-evenly align-items-center'>
        
        <div class='lien'><a href='gestionConsommations/listConsommationByF.php'>Liste des consommations</a></div>
        <div class='lien'><a href='gestionReclamations/listReclamationByF.php'>Liste des réclamations</a></div>
        
    </div>
    
    
    <div class='col d-flex justify-content-end align-items-end'><div class='mb-5 me-5 lien'><a href='dashboard.php'>Accéder au Dashboard</a></div></div>

    </div>";
require_once("layout.php");
// <a href='addClient.php'>Ajouter un client</a>