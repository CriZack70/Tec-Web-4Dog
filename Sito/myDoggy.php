<?php
require_once 'bootstrap.php';
session_start(); // Assicurati che la sessione sia avviata

// Controlla se l'utente è loggato
if (isUserLoggedIn()) {
    // Ottieni l'ID utente dalla sessione
    $user_email = $_SESSION['Email']; // Assicurati che 'user_id' sia il nome corretto nella sessione

    // Recupera i dettagli del cane associato all'utente loggato
    $dog = $dbh->getDogByEmail($user_email);

    if ($dog && count($dog) > 0) {
        // Cane già presente: Mostra il form precompilato per modifica o cancellazione
        $templateParams["dog"] = $dog[0]; // Prendi il primo (e unico) cane trovato
        $templateParams["action"] = "modifica"; // Azione specifica per il form
        $templateParams["titolo_pagina"] = "Modifica o Cancella i dati del tuo Doggy";
    } else {
        // Nessun cane trovato: Mostra il form vuoto per l'inserimento
        $templateParams["dog"] = [
            "nome" => "",
            "taglia" => "",
            "sesso" => "",
            "eta" => ""
        ];
        $templateParams["action"] = "inserisci"; // Azione specifica per il form
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

// Carica il template base
require 'template/base.php';
?>
