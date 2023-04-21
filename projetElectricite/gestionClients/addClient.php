<?php
 
 require_once('../connex.php');
 require_once('../verificationUser.php');
 if(!(session_status()===PHP_SESSION_ACTIVE)){
    session_start();
}

verificationConnex();
verificationAdmin();

$pdostat = $pdo->prepare(

    "SELECT * FROM zonegeo") ;
   $options="";
    $pdostat->execute();
    foreach($pdostat->fetchAll() as $zone){
        $options.='<option value="'.$zone['id'].'">'.$zone['nomZone'].'</option>';
    }
$title="Modifer Client";
// print($_SESSION['isAdmin']);
if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
    $content=   
        '<div class="full d-flex justify-content-start align-items-center"><div class="formu d-flex justify-content-center align-items-center"><form method="post" action="traitAddClient.php" class="d-flex justify-content-start align-items-center flex-column">
            <div class="form-floating mb-3 ml-3 ">
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Nom">
            <label for="lastName">Nom</label>
            </div>
            <div class="form-floating mb-3">
            <input type="text" id="firstName" name="firstName" class="form-control"  placeholder="Prénom">
            <label for="firstName">Prénom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-control" placeholder="Date de naissance">
                <label for="dayOfBirth">Date de naissance</label>
            </div>
            <div class="form-floating mb-3">
            <input type="text" id="tel" name="tel" class="form-control" placeholder="Tel">
                <label for="tel">Tel</label>
            </div>
            <div class="form-floating mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Adresse email">
            <label for="email">Adresse email</label>
            </div>
            <div class="form-floating mb-3">
            <input type="text" id="adressResid" name="adressResid"  class="form-control"  placeholder="Adresse de résidence">
            <label for="adressResid">Adresse de résidence</label>
            </div>
            <select id="specialS" class="form-select mb-5" name="varoptions">
           '.$options.'
           </select>
           <div class="mybtns mt-2 d-flex">
           <div class="mb-3 me-2">
            <input type="submit" value="Envoyer">
            </div>

            <div class="mb-3 d-flex justify-content-center align-items-center" id="annuler"><a  href="listClients.php">Annuler</a></div>
            </div>
        </form></div></div>';
    
}else{
    $content="<p>Vous n'êtes pas autorisés d'acceder au contenu de cette page</p>;";
}

require_once("../layout.php");
