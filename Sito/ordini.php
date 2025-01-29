<?php
require_once 'bootstrap.php';

// Controlla se l'utente è loggato
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

foreach($cartItems as $cartItem) {
    $total += $cartItem['Prezzo'] * $cartItem['Quantita'];
}

// Inserisci l'ordine nella tabella 'ordini'
$dataOrdine = date("Y-m-d H:i:s"); // Data e ora attuale
$orderId = $dbh->insertOrder($userId, $dataOrdine, $total);

// Inserisci ogni prodotto del carrello nella tabella 'dettagli_ordine'
foreach ($cartItems as $item) {
    $dbh->insertOrderDetail(
        $orderId,
        $item['CodProdotto'], // Codice della versione prodotto
        $item['Codice'],
        $item['Quantita'],
        $item['Prezzo']
    );
}

// Svuota il carrello
$dbh->clearCart($userId);

// Recupera i dettagli dell'ordine per visualizzarli nella pagina
$templateParams["orderDetails"] = $dbh->getOrderDetails($orderId);

// Mostra pagina di conferma
$templateParams["titolo"] = "4Dogs - Ordine Completato";
$templateParams["name"] = "ordine-completato.php";
require 'template/base.php';

?>
