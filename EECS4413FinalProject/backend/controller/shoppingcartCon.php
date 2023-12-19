<?php

    require '../config/config.php';
    require('../dao/itemDAOImpl.php');

    /**
    * Update the quanity of items in the cart
    */ 
    if(filter_has_var(INPUT_POST, 'update')) { //checking for type post with name update
        $dao = new itemDAOImpl();

        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $data = $dao->updateCartItem($id, $qty);

        header("Location: ../../shoppingcart.php");
    }

    /**
    * Removes item from the cart
    */ 
    if(filter_has_var(INPUT_POST, 'remove')) { //checking for type post with name remove
        $dao = new itemDAOImpl();

        $id = $_POST['id'];
        $data = $dao->removeItemFromCart($id);

        header("Location: ../../shoppingcart.php");
    }

    /**
    * Places the order
    */ 
    if(filter_has_var(INPUT_POST, 'order')) { //checking for type post with name order
        $dao = new itemDAOImpl();
        $ship = $_POST['ship'];
        $bill = $_POST['bill'];
        $card = $_POST['card'];

        $orderID = $dao->placeOrder($ship, $bill, $card);

        echo $orderID;

        header("Location: ../../orderSummary.php?order=" . $orderID);
    }

?>