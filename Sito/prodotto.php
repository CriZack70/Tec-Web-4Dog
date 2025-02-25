<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - One of our best";
$templateParams["shop"] = true;
$templateParams["name"] = "singolo-prodotto.php";
$templateParams["categories"] = $dbh->getCategories();
$templateParams["relatedprod"] = $dbh->getRandomProducts(4);
$templateParams["js"] = array("js/product-utils.js", "js/rand-utils.js");

//Home Template
$idprodotto = -1;
if(isset($_GET["id"])){
    $idprodotto = $_GET["id"];
}
$templateParams["prodotto"] = $dbh->getProductById($idprodotto);
$templateParams["infoprodotto"] = $dbh->getProductVersions($idprodotto);
$templateParams["default"] = $dbh->getProductDefaultInfos($idprodotto);

if (isUserLoggedIn()) {
    $user =  $_SESSION["Email"];
    $templateParams["owned"] = $dbh->isInWishList($user, $idprodotto);
} else {
    $templateParams["owned"] = false;
}

require 'template/base.php';
?>