<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "4Dogs - Le Mascotte";

//$templateParams["shop"] = true;

$templateParams["name"] = "cuccioli.php";

//$templateParams["categories"] = $dbh->getCategories();

//$templateParams["js"] = array("js/rand-utils.js");

require 'template/base.php';

?>