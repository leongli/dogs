<?php

require('../dao/itemDAOImpl.php');

/**
 * Get the item and add it to cart
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $dao = new itemDAOImpl();
   
    $id = $_POST['inputValue'];
    $config = '../config/config.php';
    $db = '../config/db.php';
    $item = $dao->getItemsById($id, $config, $db);

    $qty = 1;
    $dao->addItemToCart($item[0], $qty);
        
 
}
?>