<?php

require_once '../bootstrap.php';

header('Content-Type: application/json');

if (!isUserLoggedIn()) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['Email'];
$productId = $_POST['product_id'] ?? null;
$listType = $_POST['list_type'] ?? null;
$quantity = $_POST['quantity'] ?? 1;
$version = $_POST['version'];

if (!$productId || !$listType) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

if ($listType === 'cart') {
    $dbh->addToCart($userId, $version, $productId, $quantity);
    echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
} elseif ($listType === 'wishlist') {
    $dbh->addToWishlist($userId, $version, $productId);
    echo json_encode(['status' => 'success', 'message' => 'Item added to wishlist']);
}

?>