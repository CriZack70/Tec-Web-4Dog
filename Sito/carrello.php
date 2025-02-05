<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['Email'];

$templateParams["titolo"] = "4Dogs - Il mio carrello";
$templateParams["shop"] = true;
$templateParams["name"] = "prodotti-cart.php";
$templateParams["cartprod"] = $dbh->getCart($userId);
$templateParams["categories"] = $dbh->getCategories();
$templateParams["carte"] = $dbh->getPaymentMethods($userId);
$templateParams["js"] = array("js/rand-utils.js", "js/cart-utils.js");

require 'template/base.php';
?>