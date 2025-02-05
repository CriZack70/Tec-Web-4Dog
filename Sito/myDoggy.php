<?php
require_once 'bootstrap.php';
 
$templateParams["js"] = array("./js/gestisci-Doggy.js");
// Controlla se l'utente è loggato
if (isUserLoggedIn()) {
    // Ottieni l'ID utente dalla sessione
    $user_email = $_SESSION['Email']; 

    // Recupera i dettagli del cane associato all'utente loggato
    $dog = $dbh->getDogByEmail($user_email);
    
    
    if ($dog && count($dog) > 0) {
        // Cane già presente: Mostra il form precompilato per modifica o cancellazione
        $templateParams["dog"]= [
            "nome" => $dog[0]["Nome"],
            "taglia" => $dog[0]["Taglia"],
            "sesso" => $dog[0]["Sesso"],
            "eta" => $dog[0]["Eta"]
        ]; // Prendi il primo (e unico) cane trovato
        
        $templateParams["action"] = "modifica";
        $templateParams["titolo_pagina"] = "Modifica o Cancella i dati del tuo Doggy";
    } else {
        // Nessun cane trovato: Mostra il form vuoto per l'inserimento
        $templateParams["dog"] = [
            "nome" => "",
            "taglia" => "",
            "sesso" => "",
            "eta" => ""
        ];
        $templateParams["action"] = "inserisci"; 
        $templateParams["titolo_pagina"] = "Inserisci i dati del tuo Doggy";
        
    }

    // Imposta i parametri del template
    $templateParams["name"] = "myDoggy-form.php";
    $templateParams["titolo"] = "Registra il tuo cucciolo";
} else {
    // L'utente non è loggato, reindirizza alla pagina di login
    header("Location: login.php");
    exit;
}

require 'template/base.php';
?>
