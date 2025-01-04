<?php
    session_start();
    define("UPLOAD_DIR", "./imgs/");
    require_once("utils/functions.php");
    require_once("db/database.php");    
    $dbh = new DatabaseHelper("localhost", "root", "", "4dogs_db", 3306);


    
?>