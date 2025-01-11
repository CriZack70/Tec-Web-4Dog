<?php
require_once 'bootstrap.php';

if(isset($_POST["email1"]) && isset($_POST["cognome"]) && isset($_POST["nome"]) && isset($_POST["phone"]) && isset($_POST["pwdr"])
  && isset($_POST["rpwd"])){
    $usermail = $_POST["email1"];
    $surname = $_POST["cognome"];
    $name = $_POST["nome"];
    $tel = $_POST["phone"];
    $password = $_POST["pwdr"];
    $_SESSION["errorelogin"] ="";

if ($dbh->checkEmail($usermail)) {
    $_SESSION["errorelogin"]= "Email già registrata. Effettua il login!";
    echo "<script>window.open('login.php','_self')</script>"; 

} else {
    if($dbh->createUser($usermail,  $surname, $name, $tel, $password)){
        $_SESSION["errorelogin"] = "Registrazione completata con successo. Effettua il login !" ;
        echo "<script>window.open('login.php','_self')</script>"; 
    } 
    
}
}

require 'template/base.php';

?>