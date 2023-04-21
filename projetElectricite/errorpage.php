<?php
session_start();
$title="Pas d'autorisation";
$lien=(isset($_SESSION['id']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1)?"espaceAdmin.php":"";
$lien=(isset($_SESSION['id']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==0)?"espaceClient.php":$lien;
$lien=(isset($_SESSION['id']) && isset($_SESSION['isAgent']) && $_SESSION['isAgent']==1)?"gestionConsommations/importerConsomm.php":$lien;
$btn=(isset($_SESSION['id']))?"<div class='col d-flex justify-content-start align-items-start flex-row-reverse'><div class='mt-3 me-5 lien'><a href='deconnex.php'>Se déconnecter</a></div><div class='mt-3 me-5 lien'><a href='".$lien."'>Revenir à votre espace</a></div></div>":"";
$content="<div class='row row-cols-2 full'>
    <div class='col d-flex justify-content-center align-items-center'>
        <h1>Vous n'tes pas autorisés pour ouvrir cette page</h1>
    </div>".$btn."
    <div class='col d-flex flex-column justify-content-evenly align-items-center'>
    </div>

    </div>";
require_once("layout.php");
