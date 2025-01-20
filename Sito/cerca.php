<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - One of our best";
$templateParams["shop"] = true;
$templateParams["name"] = "singola-categoria.php";
$templateParams["categories"] = $dbh->getCategories();
$templateParams["js"] = array("js/rand-utils.js");
//Home Template
$ricerca = -1;
if(isset($_GET["search"])){
    $ricerca = $_GET["search"];
}
$prodotti = $dbh->getRelatedProducts($ricerca);
if(count($prodotti)>0){
    $templateParams["titolo_pagina"] = "Prodotti corrispondenti a \"".$ricerca."\"";
    $templateParams["casualprod"] = $prodotti;
}
else{
    $templateParams["titolo_pagina"] = "Nessun prodotto trovato dalla ricerca"; 
    $templateParams["casualprod"] = array();   
}

require 'template/base.php';
?>