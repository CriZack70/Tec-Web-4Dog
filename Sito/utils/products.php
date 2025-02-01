<?php

require '../bootstrap.php';

header('Content-Type: application/json');

$result["prodottoEliminato"] = false;
$result["prodottoModificato"] = false;
$result["prodottoAggiunto"] = false;
$result["versioneAggiunta"] = false;

$action = $_POST["azione"];

$productId = $_POST["CodProdotto"];
$productVer = $_POST["Codice"];

$productName = $_POST['productName'] ?? '';
$productCategory = $_POST['productCategory'] ?? '';
$productDescription = $_POST['productDescription'] ?? '';
$productBrand = $_POST['productBrand'] ?? '';
$productImage = $_POST['productImage'] ?? '';

$versionSize = $_POST['versionSize'] ?? '';
$versionAge = $_POST['versionAge'] ?? '';
$versionCod = $_POST['versionCod'] ?? '';
$versionFabric = $_POST['versionFabric'] ?? '';
$versionPrice = $_POST['versionPrice'] ?? '';
$versionQuantity = $_POST['versionQuantity'] ?? '';

switch ($action) {
    case 'edit':
        if (isset($productVer) && isset($productId)) {
            $price = $_POST["editPrice"];
            $productCategory = $_POST['editCategory'];
            $disp = $_POST["editQuantity"];
            if (isset($price) && isset($disp)) {
                $done = $dbh->editProduct($price, $disp, $productId, $productVer, $productCategory);
                if ($done) {
                    $result["prodottoModificato"] = true;
                }
            }
        }
        break;

    case 'delete':
        if (isset($productVer) && isset($productId)) {
            $done = $dbh->deleteProduct($productId, $productVer);
            if ($done) {
                $result["prodottoEliminato"] = true;
            }
        }
        break;

    case 'new':
        if (isset($productCategory)) {
            $done = $dbh->addProduct($productName, $productBrand, $productDescription, $productImage, $productCategory);
            if ($done) {
                $result["prodottoAggiunto"] = true;
            }
        }
        break;
    
    case 'add':
        if (isset($versionCod)) {
            $done = $dbh->addVersion($versionCod, $versionSize, $versionAge, $versionFabric, $versionPrice, $versionQuantity);
            if ($done) {
                $result["versioneAggiunta"] = true;
            }
        }
        break;

    default:
        break;

}


echo json_encode($result);

?>