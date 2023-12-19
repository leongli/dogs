<?php  

/**
 * Check if the user has the required access level
 * @param string $rank - The required access level.
 * @param bool $redirect - Whether to redirect to the login page if access is not granted (default is true).
 * @return bool - True if the user has the required access level, false otherwise.
 */
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

// Set the "ADMIN" access level based on the user's rank
$_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['myrank']) && $_SESSION['myrank'] == "admin";

// Set the "USER" access level based on the user's rank
$_SESSION["ACCESS"]["USER"] = isset($_SESSION['myrank']) && ($_SESSION['myrank'] == "user" || $_SESSION['myrank'] == "admin");

?>