<?php

require_once '../bootstrap.php';

header('Content-Type: application/json');

$result["utenteEliminato"] = false;
$userId = $_POST["userId"];
if (isset($userId)) {
    $action = $dbh->deleteUser($userId);
    if ($action) {
        $result["utenteEliminato"] = true;
    }
}

echo json_encode($result);
?>
