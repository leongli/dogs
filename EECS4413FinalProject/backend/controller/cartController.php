<?php 

/**
 * Create a new cart if one doesn't already exist
*/ 
if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = new Cart();
    
} 

/**
 *  Set the cart to the current session
*/ 
$cart = $_SESSION['mycart'];

?>