<?php
$title="Login page";
    if(isset($_GET['failed'])){
            $msg= "<p style=\'color: red;\'>Adresse email ou Mot de passe est erroné</p>";
    }else{
        $msg="";
    }
$content=   
    '<div class="body2"><div id="zoneForm"><div class="d-flex flex-column align-items-center pt-5"><h2>Bienvenue!</h2><span>Connectez vous!</span></div>'.$msg.'<form method="post" action="traitLogin.php" class="mt-5">
        <div class="form-floating mb-3">
        <input type="email" id="email" name="email" class="form-control" placeholder="Adresse Email">
        <label for="email">Adresse Email</label>
        </div>
        <div class="form-floating mb-3">
        <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Mot de passe">
        <label for="mdp" >Mot de passe</label>
        </div>
        <div class="mt-5 mb-3 btnWhite">
        <input type="submit" value="LOGIN">
        </div>
    </form></div></div>';
    
require_once("layout.php");