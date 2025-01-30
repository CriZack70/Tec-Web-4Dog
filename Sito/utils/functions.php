<?php
function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo "active";
    }
}

function isUserLoggedIn(){
    return !empty($_SESSION['Email']);
}


function isAdminLoggedIn(){
    return !empty($_SESSION['idAdmin']);
}

function registerLoggedUser($user){
    $_SESSION["Email"] = $user["Email"];    
    $_SESSION["Nome"] = $user["Nome"];
}

function registerAdmin($user){
    $_SESSION["idAdmin"] = $user["Id_Adm"];    
    $_SESSION["Nome"] = "DreamTeam";
}

?>