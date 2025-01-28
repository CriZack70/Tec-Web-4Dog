<?php

require_once '../bootstrap.php';

header('Content-Type: application/json');

$result["utenteEliminato"] = false;
$userId = $_POST["userId"];
if (isset($userId)) {
    $done = $dbh->deleteUser($userId);
    if ($done) {
        $result["utenteEliminato"] = true;
    }
}

echo json_encode($result);
?>
