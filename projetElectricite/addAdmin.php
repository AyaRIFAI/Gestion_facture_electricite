<?php
require_once('connex.php');
$nbr= "succes2";

$pdostat = $pdo->prepare(
    "insert into admin values(3,'admin@gmail.com', ?)") ;
    $pdostat->bindValue(1, password_hash($nbr, PASSWORD_DEFAULT));

$pdostat->execute();
// $nbr= "123456";

// $pdostat = $pdo->prepare(
//     "update agent set mdp=? where id=?");
//     $pdostat->bindValue(1, password_hash($nbr, PASSWORD_DEFAULT));
//     $pdostat->bindValue(2, 3);

// $pdostat->execute();
