<?php

require '../bootstrap.php';

header('Content-Type: application/json');


$result["statoAggiornato"] = false;
$result["notificaInviata"] = false;

$action = $_POST["azione"];

$orderStatus = $_POST['orderStatus'] ?? '';
$orderID = $_POST['orderID'] ?? '';

if (!empty($orderID) && !empty($orderStatus)) {

    switch($action) {

        case 'update':
            $done = $dbh->changeOrderStatus($orderStatus, $orderID);
            if ($done) {
                $result["statoAggiornato"] = true;
            }    
            break;

        case 'send':
            $data = new DateTime();
            $formattedDate = $data->format('Y-m-d');
            $done = $dbh->createNotification($orderID, $orderStatus, $formattedDate);
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