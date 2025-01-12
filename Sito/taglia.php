<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - The best selection";
$templateParams["shop"] = true;
$templateParams["name"] = "singola-categoria.php";
$templateParams["categories"] = $dbh->getCategories();
$templateParams["brands"] = "our_brands.php";
//Prodotti Categoria Template

if(isset($_GET["id"])){
    $taglia = $_GET["id"];
}

if(isset($taglia)){
    $templateParams["titolo_pagina"] = "Prodotti per la taglia " . $taglia;
    $templateParams["casualprod"] = $dbh->getProductsBySize($taglia);
}
else{
    $templateParams["titolo_pagina"] = "Taglia non trovata"; 
    $templateParams["casualprod"] = array();   
}

require 'template/base.php';
?>