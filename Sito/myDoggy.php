<?php
require_once 'bootstrap.php';
session_start(); // Assicurati che la sessione sia avviata

// Controlla se l'utente è loggato
if (isUserLoggedIn()) {
    // Ottieni l'ID utente dalla sessione
    $user_id = $_SESSION['user_id'];

    // Recupera i dettagli del cane associati all'utente loggato
    $dog = $dbh->getDogByUserId($user_id);
    if ($dog) {
        $templateParams["titolo"] = "Il tuo cucciolo";
        $templateParams["dog"] = $dog; // Passa i dettagli del cane al template
    } else {
        // L'utente non ha registrato un cane, mostra il modulo per l'inserimento
        $templateParams["name"] = "myDoggy-form.php";
        $templateParams["titolo"] = "Registra il tuo cucciolo";
        $templateParams["titolo_pagina"] = "Aggiungi un nuovo cucciolo";
    }
} else {
    // L'utente non è loggato, reindirizza alla pagina di login
    header("Location: login.php");
    exit;
}

// Carica il template base
require 'template/base.php';
?>

