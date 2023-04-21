<?php
session_start();
if(!isset($_SESSION['id'])){
   header('Location: auth.php');
}else{
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1){
        header('Location: espaceAdmin.php');
    }else if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 0){
        header('Location: espaceClient.php');

    }else if(isset($_SESSION['isAgent']) && $_SESSION['isAgent'] == 0){
        header('Location: gestionConsommations/importerConsomm.php');
    }else {
        header('Location: errorpage.php');

    }

}