<?php 

if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = new Cart();
    
} 

$cart = $_SESSION['mycart'];

// print_r($cart);

?>