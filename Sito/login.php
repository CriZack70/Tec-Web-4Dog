<?php
require_once 'bootstrap.php';


if(isset($_POST["email"]) && isset($_POST["password"])){
    $usermail = $_POST["email"];
    $password = $_POST["password"];
    $login_result = $dbh->checkLogin($_POST["email"]);   
    
    
    if(count($login_result)==0){
        echo "Utente non trovato!";
    }else{
        $hashed_password = $login_result[0]["Password"];
        if (password_verify($password, $hashed_password)) {
            // Imposta la sessione
            $_SESSION["errorelogin"] ="";
            registerLoggedUser($login_result[0]);            
            header("Location: index.php");
            exit;         
          
        } else {      
            $_SESSION["errorelogin"] = "Email o password errati!    Non sei registrato? Registrati!";
            
                  
        }

    }    
}

$templateParams["js"]= array("./js/tab-pane.js");


if(!isUserLoggedIn()){
    $templateParams["name"] = "login-home.php";
    $templateParams["titolo"] = "4Dogs - Login";
    $templateParams["titolo_pagina"] = "Accedi/Registrati";   
    
    
}


require 'template/base.php';

?>

