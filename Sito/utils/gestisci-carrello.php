<?php

require_once '../bootstrap.php';

header('Content-Type: application/json');

if (!isUserLoggedIn()) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['Email'];
$action = $_POST['action'] ?? null;
$productId = $_POST['product_id'] ?? null;
$version = $_POST['version'] ?? null;

if (!$productId || !$version) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

if ($action === 'remove') {
    $dbh->removeFromCart($userId, $productId, $version);
    echo json_encode(['status' => 'success', 'message' => 'Item removed from cart']);
} elseif ($action === 'update') {
    $quantity = $_POST['quantity'] ?? 1;
    $dbh->updateCart($quantity, $userId, $productId, $version);
    echo json_encode(['status' => 'success', 'message' => 'Quantity updated']);
}

?>