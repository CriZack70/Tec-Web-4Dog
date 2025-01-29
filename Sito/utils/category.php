<?php

require '../bootstrap.php';

header('Content-Type: application/json');


$result["categoriaAggiunta"] = false;
$result["categoriaEliminata"] = false;

$action = $_POST["azione"];

$categoryID = $_POST['categoryName'] ?? '';

if (isset($categoryID)) {

    switch($action) {

        case 'add':
            $done = $dbh->createCategory($categoryID);
            if ($done) {
                $result["categoriaAggiunta"] = true;
            }    
            break;

        case 'delete':
            $done = $dbh->removeCategory($categoryID);
            if ($done) {
                $result["categoriaEliminata"] = true;
            }
        
            break;

        default:
            break;
    }
}

echo json_encode($result);

?>