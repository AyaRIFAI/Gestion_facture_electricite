<?php
require_once("../connex.php");
require_once("Operation.php");

require_once('../verificationUser.php');
verificationConnex();
verificationClient();
function isValide($var){
    if(isset($var) and !empty($var)){
        return true;
    }else{
        return false;
    }
}
print_r($_FILES);
if(isValide($_POST['moisApayer']) && isValide($_POST['anneeApayer']) && isValide($_FILES['image_path']) && (isValide($_POST['valCompteur']))){
    $err="";
    $mois=trim(htmlspecialchars($_POST['moisApayer']));
    $annee=trim(htmlspecialchars($_POST['anneeApayer'])); 
    $val=trim(htmlspecialchars($_POST['valCompteur']));
    if ($_FILES['image_path']['error']) {
        switch ($_FILES['image_path']['error']){
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
        header('Location: addConsommation.php');
      }else{
        $nom = $_FILES['image_path']['tmp_name'];
        $nomdestination = '../imgsCompteurs/'.$_SESSION['id'].'_'.$mois.'_'.$annee.'_'.$_FILES['image_path']['name'];
        move_uploaded_file($nom, $nomdestination);
        $pdostat = $pdo->prepare(
            "insert into consommations(mois, annee, image_path, valCompteur, state, idClient) values(?, ?, ?, ?, ?, ?)"); 
            $pdostat->bindValue(1, $mois); 
            $pdostat->bindValue(2, $annee); 
            $pdostat->bindValue(3, $nomdestination); 
            $pdostat->bindValue(4, $val); 
            $pdostat->bindValue(5, -1); 
            $pdostat->bindValue(6, $_SESSION['id']); 
            $pdostat->execute();
            $c=$pdo->lastInsertId();
            // + update mois et annee du client
            $moisSuivant=($mois==12)?1:$mois+1;
            $anneeSuivante=($moisSuivant==1)?$annee+1:$annee;
            $pdostatU = $pdo->prepare(

                "update clients set moisApayer=?, anneeApayer=? where idClient=?") ;
            
                $pdostatU->bindValue(1, $moisSuivant); 
                $pdostatU->bindValue(2, $anneeSuivante); 
                $pdostatU->bindValue(3, $_SESSION['id']);
                $pdostatU->execute();
                $consommAnc=giveMeconsommAnc($annee, $mois, $pdo,$_SESSION['id']);
                $var=(!empty($consommAnc))?$val-$consommAnc[0][0]:$val;    
            if($var>=50 && $var<=400){
                require_once("genererFacture.php");
                $valMois=giveMeValMois($_SESSION['id'], $annee,$mois, $val, $pdo);
                genererFacture($c, $_SESSION['id'],$mois, $annee, $pdo, $valMois);
            }
            header('Location: listConsommationByC.php');
      }
   
   
    
}else{
    header('Location: addConsommation.php?failed');
}













 
//  require_once('connex.php');
//  session_start();
// $pdostat = $pdo->prepare(

//     "SELECT * FROM zonegeo") ;
//    $options="";
//     $pdostat->execute();
//     foreach($pdostat->fetchAll() as $zone){
//         $options.='<option value="'.$zone['id'].'">'.$zone['nomZone'].'</option>';
//     }
// $title="Modifer Client";
// // print($_SESSION['isAdmin']);
// if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
//     $content=   
//         '<form method="post" action="traitAddClient.php">
//             <label for="lastName">Nom</label>
//             <input type="text" id="lastName" name="lastName">
//             <label for="firstName">Prénom</label>
//             <input type="text" id="firstName" name="firstName">
//             <label for="dayOfBirth">Date de naissance</label>
//             <input type="date" id="dateOfBirth" name="dateOfBirth">
//             <label for="tel">Tel</label>
//             <input type="text" id="tel" name="tel">
//             <label for="email">Adresse email</label>
//             <input type="email" id="email" name="email">
//             <label for="adressResid">Adresse de résidence</label>
//             <input type="text" id="adressResid" name="adressResid">
//             <select name="varoptions">
//            '.$options.'
//            </select>
//             <input type="submit" value="Envoyer">
//             <input type="reset" value="Annuler">
//         </form>';
    
// }else{
//     $content="<p>Vous n'êtes pas autorisés d'acceder au contenu de cette page</p>;";
// }

// require_once("layout.php");
