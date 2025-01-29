<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["Email"];
$templateParams["name"] = "metodi-pagamento.php";
$templateParams["titolo"] = "4Dogs - Metodi di Pagamento";
$templateParams["titolo_pagina"] = "Le mie carte";   

$templateParams["js"] = array("js/pay-utils.js");

$templateParams["carte"] = $dbh->getPaymentMethods($email);

require 'template/base.php';

?>
