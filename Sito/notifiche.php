<?php
require_once 'bootstrap.php';


if(!isUserLoggedIn()){
    $templateParams["name"] = "login-home.php";
    $templateParams["titolo"] = "4Dogs - Login";
    $templateParams["titolo_pagina"] = "Notifiche";   
    
    
}










require 'template/base.php';

?>
