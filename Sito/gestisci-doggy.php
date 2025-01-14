<?php
require_once 'bootstrap.php';


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
        $eta = htmlspecialchars($_POST["eta"]);

        $result = $dbh->insertDog($email, $nome, $taglia, $sesso, $eta);
        if (!$result) {
            throw new Exception("Errore durante l'inserimento: " . $dbh->error);
        }
        $msg = "Cane inserito correttamente!";
    } elseif ($action === "modifica") {
        
            $nome = htmlspecialchars($_POST["nome"]);
            $taglia = htmlspecialchars($_POST["taglia"]);
            $sesso = htmlspecialchars($_POST["sesso"]);
            $eta = htmlspecialchars($_POST["eta"]);

        $result = $dbh->updateDog($email, $nome, $taglia, $sesso, $eta);        
        $updated_dog = $dbh->getDogByEmail($email);
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
    }elseif ($action === "annulla") {
        header("Location: index.php");
        exit;
    }
     else {
        throw new Exception("Azione non valida.");
    }
} catch (Exception $e) {
    error_log($e->getMessage(), 3, "error.log");
    $msg = "Errore: " . $e->getMessage();
}

header("Location: myDoggy.php?msg=" . urlencode($msg));
exit;
?>
