<?php
require_once("connex.php");

$pdostat = $pdo->prepare(

    "SELECT * FROM admin WHERE addressEmail= ?") ;
    $pdostat->bindValue(1, valider($_POST['email']));
    $pdostat->execute();
    $T=$pdostat->fetchAll();

    if(isset($T[0]['mdp']) && password_verify(valider($_POST['mdp']),$T[0]['mdp'])){
        session_start();
        $_SESSION["isAdmin"]=1;
        $_SESSION["id"]=valider($T[0]['idAdmin']);
        require_once("espaceAdmin.php");
    }else{
        $pdostat2=$pdo->prepare(

            "SELECT * FROM clients WHERE email= ?") ;
            $pdostat2->bindValue(1, valider($_POST['email']));
            $pdostat2->execute();
            $T=$pdostat2->fetchAll();
           
           
            if(isset($T[0]['mdp']) && password_verify($_POST['mdp'],$T[0]['mdp'])){
                session_start();
                $_SESSION['isAdmin']=0;
                $_SESSION['id']=$T[0]['idClient'];
                header('Location: espaceClient.php');

                
            }else{
                $pdostat2=$pdo->prepare(

                    "SELECT * FROM agent WHERE email= ?") ;
                    $pdostat2->bindValue(1, valider($_POST['email']));
                    $pdostat2->execute();
                    $T=$pdostat2->fetchAll();
                   
                   
                    if(isset($T[0]['mdp']) && password_verify($_POST['mdp'],$T[0]['mdp'])){
                        session_start();
                        $_SESSION['isAgent']=1;
                        $_SESSION['id']=$T[0]['id'];
                        $_SESSION['anneeAimporter']=$T[0]['anneeAimporter'];
                        header('Location: gestionConsommations/importerConsomm.php');
                    }else{
                            header('Location: auth.php?failed');
                        }
                        
                
            }
    }
