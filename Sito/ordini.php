<?php
require_once 'bootstrap.php';


if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['Email'];


$cartItems = $dbh->getCart($userId);
if (empty($cartItems)) {
    header("Location: carrello.php");
    exit;
}

foreach($cartItems as $cartItem) {
    $total += $cartItem['Prezzo'] * $cartItem['Quantita'];
}

// Inserisci l'ordine nella tabella 'ordini'
$dataOrdine = date("Y-m-d H:i:s"); // Data e ora attuale
$orderId = $dbh->insertOrder($userId, $dataOrdine, $total);

// Inserisci ogni prodotto del carrello nella tabella 'ordine:prodotto'
foreach ($cartItems as $item) {
    $dbh->insertOrderDetail(
        $orderId,
        $item['CodProdotto'],
        $item['Codice'],
        $item['Quantita'],
        $item['Prezzo']
    );
}

$dbh->clearCart($userId);

// Recupera i dettagli dell'ordine per visualizzarli nella pagina
$templateParams["orderDetails"] = $dbh->getOrderDetails($orderId);


$templateParams["titolo"] = "4Dogs - Ordine Completato";
$templateParams["name"] = "ordine-completato.php";
require 'template/base.php';

?>
