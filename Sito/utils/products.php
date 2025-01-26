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
$versionColor = $_POST['versionColor'] ?? '';
$versionFabric = $_POST['versionFabric'] ?? '';
$versionPrice = $_POST['versionPrice'] ?? '';
$versionQuantity = $_POST['versionQuantity'] ?? '';



switch ($action) {
    case 'edit':
        if (isset($productVer) && isset($productId)) {
            $price = $_POST["Prezzo"];
            $disp = $_POST["Disponibilita"];
            if (isset($price) && isset($disp)) {
                $action = $dbh->editProduct($price, $disp, $productId, $productVer);
                if ($action) {
                    $result["prodottoModificato"] = true;
                }
            }
        }
        break;

    case 'delete':
        if (isset($productVer) && isset($productId)) {
            $action = $dbh->deleteProduct($productId, $productVer);
            if ($action) {
                $result["prodottoEliminato"] = true;
            }
            $result["prodottoEliminato"] = true;
        }
        break;

    case 'new':
        if (isset($productCategory)) {
            $action = $dbh->addProduct($productName, $productBrand, $productDescription, $productImage, $productCategory);
            if ($action) {
                $result["prodottoAggiunto"] = true;
            }
        }
        break;
    
    case 'add':
        if (isset($versionCod)) {
            $action = $dbh->addVersion($versionCod, $versionSize, $versionAge, $versionColor, $versionFabric, $versionPrice, $versionQuantity);
            if ($action) {
                $result["versioneAggiunta"] = true;
            }
        }
        break;

    default:
        break;

}


echo json_encode($result);

?>