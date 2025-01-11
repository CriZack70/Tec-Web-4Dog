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
            echo "<script>window.open('index.php','_self')</script>";         
          
        } else {      
            $_SESSION["errorelogin"] = "Email o password errati!    Non sei registrato? Registrati!";
            
                  
        }

    }    
}



if(isUserLoggedIn()){
    $templateParams["name"] = "home.php";
    $templateParams["titolo"] = "4Dogs - Account";
    $templateParams["titolo_pagina"] = "Il mio Account";
    
    
    if(isset($_GET["formmsg"])){
        $templateParams["formmsg"] = $_GET["formmsg"];
    }
}
else{
    $templateParams["name"] = "login-home.php";
    $templateParams["titolo"] = "4Dogs - Login";
    $templateParams["titolo_pagina"] = "Accedi/Registrati";
    
       
}

require 'template/base.php';

?>

