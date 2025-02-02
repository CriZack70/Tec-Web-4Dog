<?php

require '../bootstrap.php';

header("Content-Type: application/json");


$result["categoriaAggiunta"] = false;
$result["categoriaEliminata"] = false;

$action = $_POST["azione"];

$categoryID = $_POST['categoryID'] ?? '';
$categoryName = $_POST['categoryName'] ?? '';

switch($action) {
    case 'add':
        if (!empty($categoryName)) {
            $done = $dbh->createCategory($categoryName);
            if ($done) {
                $result["categoriaAggiunta"] = true;
            }
        }
        break;
    case 'delete':
        if (!empty($categoryID)) {
            $done = $dbh->removeCategory($categoryID);
            if ($done) {
                $result["categoriaEliminata"] = true;
            }
        }
        break;
    default:
        break;
}

echo json_encode($result);
error_log(json_encode($result));
?>

