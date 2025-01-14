<?php
require_once 'bootstrap.php';
session_start();

if (!isUserLoggedIn() || !isset($_POST["action"])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["Email"];
$action = $_POST["action"];
$msg = "";

try {
    if ($action === "inserisci") {
        $nome = htmlspecialchars($_POST["nome"]);
        $taglia = htmlspecialchars($_POST["taglia"]);
        $sesso = htmlspecialchars($_POST["sesso"]);
        $data_nascita = htmlspecialchars($_POST["data_nascita"]);

        $result = $dbh->insertDog($email, $nome, $taglia, $sesso, $data_nascita);
        if (!$result) {
            throw new Exception("Errore durante l'inserimento: " . $dbh->error);
        }
        $msg = "Cane inserito correttamente!";
    } elseif ($action === "modifica") {
        $nome = htmlspecialchars($_POST["nome"]);
        $taglia = htmlspecialchars($_POST["taglia"]);
        $sesso = htmlspecialchars($_POST["sesso"]);
        $data_nascita = htmlspecialchars($_POST["data_nascita"]);

        $result = $dbh->updateDog($email, $nome, $taglia, $sesso, $data_nascita);
        if (!$result) {
            throw new Exception("Errore durante la modifica: " . $dbh->error);
        }
        $msg = "Cane modificato correttamente!";
    } elseif ($action === "cancella") {
        $result = $dbh->deleteDog($email);
        if (!$result) {
            throw new Exception("Errore durante la cancellazione: " . $dbh->error);
        }
        $msg = "Cane cancellato correttamente!";
    } else {
        throw new Exception("Azione non valida.");
    }
} catch (Exception $e) {
    error_log($e->getMessage(), 3, "error.log");
    $msg = "Errore: " . $e->getMessage();
}

header("Location: myDoggy.php?msg=" . urlencode($msg));
exit;
?>
