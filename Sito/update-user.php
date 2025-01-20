<?php
require_once 'bootstrap.php';
  
$email = $_SESSION["Email"];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
    $cognome =htmlspecialchars($_POST["cognome"]);
    $nome =htmlspecialchars($_POST["nome"]);
    $phone =htmlspecialchars($_POST["phone"]);

$result = $dbh->updateUser($email, $cognome, $nome, $phone);

if($result){
    $templateParams["user"]= [
        "cognome" => $cognome,
        "nome" => $nome,
        "phone" => $phone    
    ];
    $_SESSION["Nome"] = $templateParams["user"]["nome"];
}
}


header("Location: account.php");
exit;
?>