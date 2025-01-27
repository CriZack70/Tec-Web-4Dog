<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - Home";
$templateParams["shop"] = true;
$templateParams["name"] = "home.php";
$templateParams["categories"] = $dbh->getCategories();

if(!isUserLoggedIn() ){
$templateParams["casualprod"] = $dbh->getRandomProducts(4);
$templateParams["brands"] = "our_brands.php";
$templateParams["js"] = array("js/rand-utils.js");


}else {
    $email = $_SESSION["Email"];
    $isDog = $dbh->getDogByEmail($email);
    
    $templateParams["js"] = array("js/badge.js");
    if(empty($isDog)){
    $templateParams["casualprod"] = $dbh->getRandomProducts(4);
    $templateParams["brands"] = "our_brands.php";
    
    }else{
        $taglia = $isDog[0]["Taglia"];
        $eta = $isDog[0]["Eta"];
        $sesso = $isDog[0]["Sesso"];
        $templateParams["dog"]=[            
            "taglia" => $taglia,
            "sesso" => $sesso,
            "eta" => $eta
        ];
        $templateParams["casualprod"] = $dbh->casualProdDoggy($taglia, $eta, $sesso, 4);
        $templateParams["brands"] = "our_brands.php";
       
    }
}
require 'template/base.php';

?>