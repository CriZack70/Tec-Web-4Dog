<?php
require_once 'bootstrap.php';





if(isset($_POST["email"]) && isset($_POST["password"])){
    $usermail = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT Email, Pwd, Nome FROM utente_registrato WHERE  Email = ?";
    $stmt = $dbh->db->prepare($query);
    $stmt->bind_param('s', $usermail);
    $stmt->execute();
    $result = $stmt->get_result();
    $result->fetch_all(MYSQLI_ASSOC);
    
    if (count($result) > 0) {
        
        $hashed_password = $result["Pwd"];

                // Verifica della password
            if (password_verify($password, $hashed_password)) {
                // Imposta la sessione
                registerLoggedUser($result[0]);

                echo "La variabile di sessione 'username' è impostata e il suo valore è: " . $_SESSION["Nome"];


                
            } else {
                $templateParams["errorelogin"] = "Errore! Controllare username o password!";
            }
    } else {
        echo "Utente non trovato!";
    }
}


    
    
    
    
    
    
    

        
   


if(isUserLoggedIn()){
    $templateParams["name"] = "login-home.php";
    $templateParams["titolo"] = "4Dogs - Account";
    $templateParams["titolo_pagina"] = "Il mio Account";
    
    
    if(isset($_GET["formmsg"])){
        $templateParams["formmsg"] = $_GET["formmsg"];
    }
}
else{
    $templateParams["name"] = "login-form.php";
    $templateParams["titolo"] = "4Dogs - Login";
    $templateParams["titolo_pagina"] = "Login-Utente";
   
}

require 'template/base.php';
?>

