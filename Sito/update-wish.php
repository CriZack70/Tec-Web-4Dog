<?php
require_once 'bootstrap.php';
  
$email = $_SESSION["Email"];
$countp=0;


if (isset($_POST["prodotti"]) && is_array($_POST["prodotti"])){
    
    $prodotti = $_POST["prodotti"];
    $numprod = count($prodotti);     
    // Esegui l"eliminazione dei prodotti dal database
    foreach ($prodotti as $codice) {
        $result = $dbh->deleteWishProduct($email, $codice);
        if($result){
            $countp += 1;
        }
    }
    if($numprod == $countp){        
        header("Location: account.php");
    exit;

    }   
    
}


require 'template/base.php';

?>

