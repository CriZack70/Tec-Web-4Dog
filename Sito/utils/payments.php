<?php

require '../bootstrap.php';

header('Content-Type: application/json');

$result["aggiuntoPagamento"] = false;
$result["rimossoPagamento"] = false;

$action = $_POST["azione"];

$email = $_SESSION['Email'];

$cardNumber = $_POST['CardNumber'];
$expiryDate = $_POST['ExpiryDate'];
$cvv = $_POST['CVV'];

// Validate inputs
if (strlen($cardNumber) !== 16 || ($action === 'add' && (strlen($cvv) < 3 || strlen($cvv) > 4))) {
    echo json_encode(['success' => false, 'error' => 'Invalid card details.']);
    exit;
}

// Act onto the database
switch($action) {

    case 'add':
        $done = $dbh->addCard($email, $cardNumber, $expiryDate, $cvv);
        if ($done) {
            $result["aggiuntoPagamento"] = true;
        }
        break;

    case 'delete':
        $done = $dbh->removeCard($email, $cardNumber);
        if ($done) {
            $result["rimossoPagamento"] = true;
        }
        break;
    
    default:
        break;

}

echo json_encode($result);

?>