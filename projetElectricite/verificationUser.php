<?php

if(!(session_status()==PHP_SESSION_ACTIVE)){
    session_start();
  }


function verificationConnex(){
    if(!isset($_SESSION['id'])){
        header('Location: ../auth.php');
    }
}
function verificationAdmin(){
    if(!(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1)){
        header('Location: ../errorpage.php');
    }
}
function verificationClient(){
    if(!(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==0)){
        header('Location: ../errorpage.php');
    }
}
function verificationAdminO(){
    if(!(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1)){
        header('Location: errorpage.php');
    }
}
function verificationClientO(){
    if(!(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==0)){
        header('Location: errorpage.php');
    }
}
function verificationAgent(){
    if(!(isset($_SESSION['isAgent']) && $_SESSION['isAgent']==1)){
        header('Location: errorpage.php');
    }
}
function verificationAgentI(){
    if(!(isset($_SESSION['isAgent']) && $_SESSION['isAgent']==1)){
        header('Location: ../errorpage.php');
    }
}
