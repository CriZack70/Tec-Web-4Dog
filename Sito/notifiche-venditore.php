<?php
require_once 'bootstrap.php';


if(isAdminLoggedIn()){
    $email = $_SESSION["idAdmin"];
    $templateParams["js"] = array("./js/notifiche-venditore.js");
    $templateParams["name"] = "notificheVenditore-form.php";
    $templateParams["titolo"] = "4Dogs - Notifiche Admin";
    $templateParams["titolo_pagina"] = "Notifiche Amministratore";   
    $notificationOrder = $dbh->getNotificationsOrdersAdm();
    $notificationProduct = $dbh->getNotificationsDispAdm();
    $templateParams["notificationsOrderAdm"]= $notificationOrder;
    $templateParams["notificationsProductAdm"]= $notificationProduct;
    
}

require 'template/base.php';

?>
