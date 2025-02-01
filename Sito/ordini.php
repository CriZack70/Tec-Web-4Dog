<?php
require_once 'bootstrap.php';


if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['Email'];

// Controlla se il carrello è vuoto
$cartItems = $dbh->getCart($userId);
if (empty($cartItems)) {
   
    header("Location: carrello.php");
    exit;
}

$total = 0;

foreach($cartItems as $cartItem) {
    $total += $cartItem['Prezzo'] * $cartItem['Quantita'];
}




    // Inserisci l'ordine nella tabella 'ordini'
    $dataOrdine = date("Y-m-d H:i:s"); // Data e ora attuale
    $orderId = $dbh->insertOrder($userId, $dataOrdine, $total);
    $dbh->insertorderNotification($dataOrdine, $orderId);
    // Inserisci ogni prodotto del carrello nella tabella 'dettagli_ordine'
    foreach ($cartItems as $item) {
        $dbh->insertOrderDetail(
            $orderId,
            $item['CodProdotto'], // Codice della versione prodotto
            $item['Codice'],
            $item['Quantita'],
            $item['Prezzo']
        );
        $quantitaDisponibile = $dbh->updateQuantity($item['Codice'],$item['Quantita']);       
        if ($quantitaDisponibile == 0){
            $dbh->insertDisponibilityNotification($dataOrdine, $item['Codice']);
        }
    }

    // Svuota il carrello
    $dbh->clearCart($userId);
    

// Recupera i dettagli dell'ordine per visualizzarli nella pagina
$templateParams["orderDetails"] = $dbh->getOrderDetails($orderId);


$templateParams["titolo"] = "4Dogs - Ordine Completato";
$templateParams["name"] = "ordine-completato.php";
require 'template/base.php';

?>
