<?php
require_once 'bootstrap.php';

if (isAdminLoggedIn()) {
    if (isset($_POST["Id"]) && isset($_POST["azione"])) {
        $id = $_POST["Id"];        
        $azione = $_POST["azione"];        

        if ($azione === "letta") {
            $dbh->updateNotificationsStatusAdm($id);
        } elseif ($azione === "elimina") {
            $dbh->deleteNotificationsAdm($id);
        }
        exit;
    } else {
        echo json_encode(["error" => "Dati mancanti"]);
        exit;
    }
}
   
?>