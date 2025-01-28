<?php
require_once 'bootstrap.php';


if(isUserLoggedIn()){
    $email = $_SESSION["Email"];
    $templateParams["js"] = array("./js/notifiche.js");
    $templateParams["name"] = "notifiche-form.php";
    $templateParams["titolo"] = "4Dogs - Notifiche";
    $templateParams["titolo_pagina"] = "Le mie Notifiche";   
    $notification = $dbh->getNotifications($email);
    
    echo "<pre>";
    print_r($notification);
    echo "</pre>";

    $templateParams["notifications"]= $notification;
    
    
}










require 'template/base.php';

?>
