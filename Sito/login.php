<?php
require_once 'bootstrap.php';


if(isset($_POST["email"]) && isset($_POST["password"])){
    $usermail = $_POST["email"];
    $password = $_POST["password"];
    $admin_result = $dbh->checkAdmin($usermail);
    $login_result = $dbh->checkLogin($usermail);   
    $notActive = $dbh->checkDisactiveUser($usermail);
    if(count($admin_result)==0){
        if(count($login_result)==0){
            if($notActive){
                $_SESSION["errorelogin"] = "Il tuo Utente è Sospeso!";
            }else {
                 $_SESSION["errorelogin"] = "Utente non trovato!";
             }
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
    } else {
        $hashed_password = $admin_result[0]["Password"];
        if (password_verify($password, $hashed_password)) {
            // Imposta la sessione
            $_SESSION["errorelogin"] ="";
            registerAdmin($admin_result[0]);
            header("Location: admin.php");
            exit;         
        } else {                 
                $_SESSION["errorelogin"] = "Email o password errati!!";            
        }
    }
}

$templateParams["js"]= array("./js/tab-pane.js");


if(!isUserLoggedIn() || !isAdminLoggedIn()){
    $templateParams["name"] = "login-home.php";
    $templateParams["titolo"] = "4Dogs - Login";
    $templateParams["titolo_pagina"] = "Accedi/Registrati";   
}

require 'template/base.php';

?>

