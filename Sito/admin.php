<?php
require_once 'bootstrap.php';

//Base Template


if(isAdminLoggedIn()){
    $adminID = $_SESSION["idAdmin"];

    $templateParams["titolo"] = "4Dogs - Control Panel";
    $templateParams["titolo_pagina"] = "Pannello Amministratore"; 
    $templateParams["name"] = "control-panel.php";
    $templateParams["prodotti"] = $dbh->getAllProducts();
    $templateParams["utenti"] = $dbh->getAllUsers();
    $templateParams["ordini"] = $dbh->getAllOrders();
    $templateParams["versioni"] = $dbh->getAllVersions();
    $templateParams["js"] = array("js/admin-utils.js");
} else {
    header("Location: login.php");
}

require 'template/base.php';

?>