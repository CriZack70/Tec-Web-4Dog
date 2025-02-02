<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - Brand";
$templateParams["shop"] = true;
$templateParams["name"] = "singola-categoria.php";
$templateParams["categories"] = $dbh->getCategories();
$templateParams["brands"] = "our_brands.php";
$templateParams["js"] = array("js/rand-utils.js");
//Home Template
$brand = -1;
if(isset($_GET["brand"])){
    $brand = $_GET["brand"];
}
$prodotti = $dbh->getBrandProducts($brand);
if(count($prodotti)>0){
    $templateParams["titolo_pagina"] = "Prodotti corrispondenti a \"".$brand."\"";
    $templateParams["casualprod"] = $prodotti;
}
else{
    $templateParams["titolo_pagina"] = "Nessun prodotto trovato dalla Marca richiesta"; 
    $templateParams["casualprod"] = array();   
}

require 'template/base.php';
?>