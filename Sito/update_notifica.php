<?php
require_once 'bootstrap.php';

if (isUserLoggedIn()) {
    if (isset($_POST["Numero"]) && isset($_POST["Descrizione"]) && isset($_POST["azione"])) {
        $num = $_POST["Numero"];
        $desc = $_POST["Descrizione"];
        $azione = $_POST["azione"];

        if ($azione === "letta") {
            $dbh->updateNotificationsStatus($num, $desc);
        } elseif ($azione === "elimina") {
            $dbh->deleteNotificationsStatus($num, $desc);
        }
        exit;
    } else {
        echo json_encode(["error" => "Dati mancanti"]);
        exit;
    }
}
   
?>