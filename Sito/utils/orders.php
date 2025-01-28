<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../bootstrap.php';

header('Content-Type: application/json');

try {
    $result["statoAggiornato"] = false;
    $result["notificaInviata"] = false;

    $action = $_POST["azione"];

    $orderStatus = $_POST['orderStatus'] ?? '';
    $orderID = $_POST['orderID'] ?? '';

    if (!$orderStatus || !$orderID) {
        echo json_encode(['success' => false, 'error' => 'Missing order status or order ID.']);
        exit;
    }

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
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Order status updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update order status.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
//echo json_encode($result);

?>