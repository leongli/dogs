<?php

require_once("backend/model/Cart.php");
session_start(); 
include "access.php";
access('USER');
require_once('backend/controller/cartController.php');

    
// print_r($cart);

$displaycart = $cart->getCart();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart: <?php echo $_SESSION['myname']; ?></title>
    <script src="js/file.js" defer></script>
</head>
<body>

    <?php include 'header.php' ?>

    <section>
    <?php 
    $totalPrice = 0;
    if(isset($displaycart) && !$cart->isEmpty()) {
        foreach($displaycart as $item) : ?>
        <div>
            <hr>
            <img src="<?php echo $item->getImageURL() ?>" alt="Product">
            <ul>
                <li><?php echo $item->getName() ?></li>
                <li>Item Price: $<?php echo $item->getPrice() ?></li>
            </ul>
            <form action="backend/controller/shoppingcartCon.php" method="post">
                <label for="">Qty: </label><input type="number" name="qty" min="1" max="99" value="<?php echo $item->getOrderQty() ?>">
                <input type="submit" name="update" value="Update">
                <input type="submit" name="remove" value="Remove">
                <input type="hidden" name="id" value="<?php echo $item->getId() ?>">
            </form>
            <hr>
        </div>
    <?php $totalPrice += ($item->getPrice() * $item->getOrderQty());

    endforeach; ?>
    
    <div>Total Price: $<?php echo $totalPrice; ?></div>
    <form action="backend/controller/shoppingcartCon.php" method="post">
        <input type="submit" name="order" value="Place Order">
    </form>

    <?php } else { ?>

        <h1>CART IS EMPTY</h1>
    <?php } ?>
    </section>

    <?php include 'footer.php' ?>

</body>
</html>