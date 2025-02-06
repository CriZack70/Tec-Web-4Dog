<?php
require_once 'bootstrap.php';


if (!isUserLoggedIn() || !isset($_POST["action"])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["Email"];
$action = $_POST["action"];

if ($action === "inserisci") {
    $nome = htmlspecialchars($_POST["nome"]);
    $taglia = htmlspecialchars($_POST["taglia"]);
    $sesso = htmlspecialchars($_POST["sesso"]);
    $eta = htmlspecialchars($_POST["eta"]);

    $result = $dbh->insertDog($email, $nome, $taglia, $sesso, $eta);
    if (!$result) {
        throw new Exception("Errore durante l'inserimento: " . $dbh->error);
    }
} elseif ($action === "salva") {
    
        $nome = htmlspecialchars($_POST["nome"]);
        $taglia = htmlspecialchars($_POST["taglia"]);
        $sesso = htmlspecialchars($_POST["sesso"]);
        $eta = htmlspecialchars($_POST["eta"]);

    $result = $dbh->updateDog($email, $nome, $taglia, $sesso, $eta);        
    $updated_dog = $dbh->getDogByEmail($email);
    if (!$result) {
        throw new Exception("Errore durante la modifica: " . $dbh->error);
    }

} elseif ($action === "cancella") {
    $result = $dbh->deleteDog($email);
    if (!$result) {
        throw new Exception("Errore durante la cancellazione: " . $dbh->error);
    }
}elseif ($action === "annulla") {
    header("Location: index.php");
    exit;
}
    else {
    throw new Exception("Azione non valida.");
}


header("Location: myDoggy.php");
exit;
?>
