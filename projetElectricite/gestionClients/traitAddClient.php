<?php
require_once('../connex.php');

require_once('../verificationUser.php');
if(!(session_status()===PHP_SESSION_ACTIVE)){
    session_start();
}

verificationConnex();
verificationAdmin();

session_start();
$nbr= (time()%1000+1000)."";
$zone;
if(isset($_POST['varoptions']) && !empty($_POST['varoptions'])){
$zone=$_POST['varoptions'];
}else{
    $zone=1;
}
try{
    $email=valider($_POST['email']);
    $lastName=valider($_POST['lastName']);
    $firstName=valider($_POST['firstName']);
$pdostat = $pdo->prepare(

    "insert into clients(lastName, firstName, dateOfBirth, tel, email, adressResid, mdp, reserve, idZoneGeo, idAdmin, moisApayer, anneeApayer) values(?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?)") ;

    $pdostat->bindValue(1, $lastName); 
    $pdostat->bindValue(2, $firstName); 
    $pdostat->bindValue(3, valider($_POST['dateOfBirth'])); 
    $pdostat->bindValue(4, valider($_POST['tel'])); 
    $pdostat->bindValue(5, $email); 
    $pdostat->bindValue(6, valider($_POST['adressResid'])); 
    $pdostat->bindValue(7, password_hash($nbr, PASSWORD_DEFAULT));
    $pdostat->bindValue(8, 0); 
    $pdostat->bindValue(9, $zone); 
    $pdostat->bindValue(10, $_SESSION['id']);
    $pdostat->bindValue(11, date("m")); 
    $pdostat->bindValue(12, date("Y")); 
    $pdostat->execute();
    $c=$pdo->lastInsertId();

// $to = $_POST['email'];
//
// *** Subject Email ***
// $subject = 'Vote Code de compte';
//
// *** Content Email ***
// $msg = "Bonjour cher client,\nPour accéder à votre compte, veuillez utiliser le code suivant : $nbr \n Cordialement.";

//
//*** Head Email ***
// $headers = "From: rifaiaya2002@gmail.com\r\n";
//
//*** Show the result... ***
// if (mail($to, $subject, $msg, $headers))
// {
// 	echo "Success !!!";
// } 
// else 
// {
//    	echo "ERROR";
// }
require('../email.php');
$mail->addAddress($email, $lastName." ".valider($firstName));
$mail->Subject = 'Votre code de compte';
$mail->Body = "Bonjour cher(e) client, \nVoici votre mot de passe pour accéder à votre compte à l'application Gestion_éléctricité\nCordialement.";
$mail->Body .=' Mot de passe : '.$nbr;
// $mail->Body .=' login name : '.$login;
if(!$mail->send()) {
 echo 'Email not sent';
} else {
 echo 'Email sent';
 }
}catch(Exception $e){
    print($e->getMessage());
}
    
    require_once("listClients.php");
    