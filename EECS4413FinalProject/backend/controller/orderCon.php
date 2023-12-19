<?php

    require('../dao/itemDAOImpl.php');

    /**
     * Find item and add to cart
     */
    if(filter_has_var(INPUT_POST, 'add')) { //checking for type post with name submit
        $dao = new itemDAOImpl();

        $id = $_POST['id'];
        $config = '../config/config.php';
        $db = '../config/db.php';
        $item = $dao->getItemsById($id, $config, $db);

        print_r($item);

        $qty = $_POST['qty'];
        $dao->addItemToCart($item[0], $qty);
        
        header("Location: ../../index.php");
    }

?>