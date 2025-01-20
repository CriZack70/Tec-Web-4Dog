<?php

require_once 'bootstrap.php';
$templateParams["js"] = array("./js/modifica-account.js", "./js/modifica-wish.js" );
if(isUserLoggedIn()){
    $email = $_SESSION["Email"];
    $user_data = $dbh-> getUserByEmail($email);
   

    if (count($user_data) > 0) {
        $templateParams["user"]= [
            "cognome" => $user_data[0]["Cognome"],
            "nome" => $user_data[0]["Nome"],
            "phone" => $user_data[0]["Telefono"],
            "password" => ""
        ];
        $user_wish = $dbh-> getWishlistInfoes($email);
        if (count($user_wish) > 0){
            $templateParams["wishList"] =  $user_wish;
        }
       
    }

    
    

    $templateParams["name"]= "account-form.php";
    $templateParams["titolo"] = "4Dogs - Account";
    $templateParams["titolo_pagina"] = "Il mio Account";
    

}





// Carica il template base
require 'template/base.php';
?>
