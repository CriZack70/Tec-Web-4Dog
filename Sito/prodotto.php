<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - One of our best";
$templateParams["nome"] = "singolo-prodotto.php";
$templateParams["relatedprod"] = $dbh->getRandomProducts(4);
//Home Template
$idprodotto = -1;
if(isset($_GET["id"])){
    $idprodotto = $_GET["id"];
}
$templateParams["prodotto"] = $dbh->getProductById($idprodotto);

require 'template/base.php';
?>