<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../bootstrap.php';

header('Content-Type: application/json');


$result["statoAggiornato"] = false;
$result["notificaInviata"] = false;

$action = $_POST["azione"];

$orderStatus = $_POST['orderStatus'] ?? '';
$orderID = $_POST['orderID'] ?? '';

if (isset($orderID) && isset($orderStatus)) {

    switch($action) {

        case 'update':
            $done = $dbh->changeOrderStatus($orderStatus, $orderID);
            if ($done) {
                $result["statoAggiornato"] = true;
            }    
            break;

        case 'send':
            $done = $dbh->createNotification($orderID, $orderStatus);
            if ($done) {
                $result["notificaInviata"] = true;
            }
        
            break;

        default:
            break;
    }
}

echo json_encode($result);

?>