<?php
function valider($var){
    if(isset($var) and !empty($var)){
        return trim(htmlspecialchars($var));
    }else{
        return "";
    }
}
try {
    $pdo=new PDO("mysql:host=localhost;dbname=electricitebd","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
    
    PDO::ERRMODE_EXCEPTION);
    
    
    
    }
    
    catch (Exception $e) {
    echo "ERREUR : ".$e->getMessage() ;
    }