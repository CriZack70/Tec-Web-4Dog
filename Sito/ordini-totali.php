<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['Email'];

// Recupera gli ordini effettuati dall'utente
$orders = $dbh->getUserOrders($userId); 

// Passa i dati al template
$templateParams["titolo"] = "4Dogs - I miei ordini";
$templateParams["orders"] = $orders;
$templateParams["name"] = "template/ordini-precedenti.php";

require 'template/base.php';
?>
