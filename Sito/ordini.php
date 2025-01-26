<?php
require_once 'bootstrap.php';

// Abilita il debug per mostrare errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Controlla se l'utente è loggato
if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['Email'];

// Debug: Controllo sessione utente
echo "<pre>Utente loggato: $userId</pre>";

// Controlla se il carrello è vuoto
$cartItems = $dbh->getCart($userId);
if (empty($cartItems)) {
    echo "<pre>Carrello vuoto per l'utente $userId</pre>";
    header("Location: carrello.php");
    exit;
}

// Debug: Visualizza i prodotti nel carrello
echo "<pre>Prodotti nel carrello:</pre>";
print_r($cartItems);

try {
    // Inserisci l'ordine nella tabella 'ordini'
    $dataOrdine = date("Y-m-d H:i:s"); // Data e ora attuale
    $orderId = $dbh->insertOrder($userId, $dataOrdine);

    // Debug: Controllo ID dell'ordine appena creato
    echo "<pre>Ordine creato con ID: $orderId</pre>";

    // Inserisci ogni prodotto del carrello nella tabella 'dettagli_ordine'
    foreach ($cartItems as $item) {
        $dbh->insertOrderDetail(
            $orderId,
            $item['CodProdotto'], // Codice della versione prodotto
            $item['Codice'],
            $item['Quantita'],
            $item['Prezzo']
        );

        // Debug: Conferma inserimento dettagli ordine
        echo "<pre>Dettagli ordine inseriti:
            ID Ordine: $orderId,
            Codice Versione:{$item['CodProdotto']},
            Codice Prodotto: {$item['Codice']},
            Quantità: {$item['Quantita']},
            Prezzo: {$item['Prezzo']}
        </pre>";
    }

    // Svuota il carrello
    $dbh->clearCart($userId);
    echo "<pre>Carrello svuotato per l'utente $userId</pre>";

    // Recupera i dettagli dell'ordine per visualizzarli nella pagina
    $templateParams["orderDetails"] = $dbh->getOrderDetails($orderId);

    // Debug: Visualizza i dettagli dell'ordine recuperati
    echo "<pre>Dettagli ordine recuperati:</pre>";
    print_r($templateParams["orderDetails"]);

    // Mostra pagina di conferma
    $templateParams["titolo"] = "4Dogs - Ordine Completato";
    $templateParams["name"] = "ordine-completato.php";
    require 'template/base.php';

} catch (Exception $e) {

    // Debug: Mostra messaggio di errore
    echo "<pre>Errore durante l'elaborazione dell'ordine: " . $e->getMessage() . "</pre>";
    die("Errore durante l'elaborazione dell'ordine.");
}
?>
