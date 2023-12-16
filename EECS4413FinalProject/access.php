<?php  

function access($rank, $redirect = true) {
    
    if(!isset($_SESSION["ACCESS"]) || !$_SESSION["ACCESS"][$rank]) {
        if($redirect) {
            header("Location: login.php");
            die;
        } 

        return false;
        
    }

    return true;
}

$_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['myrank']) && $_SESSION['myrank'] == "admin";

$_SESSION["ACCESS"]["USER"] = isset($_SESSION['myrank']) && ($_SESSION['myrank'] == "user" || $_SESSION['myrank'] == "admin");

?>