<?php
require_once 'bootstrap.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['Email'];

// Recupera gli ordini effettuati dall'utente
$orders = $dbh->getUserOrders($userId); // Assicurati che questa funzione esista

// Passa i dati al template
$templateParams["titolo"] = "4Dogs - I miei ordini";
$templateParams["orders"] = $orders;
$templateParams["name"] = "template/ordini-precedenti.php";

require 'template/base.php';
?>
