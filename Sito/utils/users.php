<?php

require_once '../bootstrap.php';

header('Content-Type: application/json');

$result["utenteAggiornato"] = false;
$active = $_POST["change"];
$userId = $_POST["userId"];
if (isset($userId) && isset($active)) {
    $done = $dbh->refreshUser($active, $userId);
    if ($done) {
        $result["utenteAggiornato"] = true;
    }
}

echo json_encode($result);
?>
