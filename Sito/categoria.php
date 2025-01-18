<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - The best selection";
$templateParams["shop"] = true;
$templateParams["name"] = "singola-categoria.php";
$templateParams["categories"] = $dbh->getCategories();
$templateParams["brands"] = "our_brands.php";
$templateParams["js"] = array("js/rand-utils.js");
//Prodotti Categoria Template
$idcategoria = -1;
if(isset($_GET["id"])){
    $idcategoria = $_GET["id"];
}
$nomecategoria = $dbh->getCategoryById($idcategoria);
if(count($nomecategoria)>0){
    $templateParams["titolo_pagina"] = "Prodotti della categoria ".$nomecategoria[0]["Nome"];
    $templateParams["casualprod"] = $dbh->getProductsByCategory($idcategoria);
}
else{
    $templateParams["titolo_pagina"] = "Categoria non trovata"; 
    $templateParams["casualprod"] = array();   
}

require 'template/base.php';
?>