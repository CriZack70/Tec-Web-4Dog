<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - Home";
$templateParams["shop"] = true;
$templateParams["name"] = "home.php";
$templateParams["casualprod"] = $dbh->getRandomProducts(4);
$templateParams["brands"] = "our_brands.php";
require 'template/base.php';
?>