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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php include 'header.php' ?>

    <section>
        <h2 class="d-block mx-auto px-5 pt-5">Your Shopping Cart</h2>
        <?php
        $totalPrice = 0;
        if (isset($displaycart) && !$cart->isEmpty()) {
            foreach ($displaycart as $item) : ?>
                <div class="d-block mx-auto px-5">
                    <hr style="clear: both; visibility: hidden;">
                    <div class="card mb-3 mx-auto">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="<?php echo $item->getImageURL() ?>" alt="Product" class="rounded-start d-block mx-auto" style="object-fit:cover; height:32vh; width:32vh">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php $totalPrice += ($item->getPrice() * $item->getOrderQty());

            endforeach; ?>
            
            <div class="row w-100 py-3">
                <div class="col-1"></div>
                <div class="col-9">
                    <h4><b>Total Price: $<?php echo $totalPrice; ?></b></h4>
                </div>
                <div class="col">
                    <form action="backend/controller/shoppingcartCon.php" method="post">
                        <input type="submit" name="order" value="Place Order" style="width:50%">
                    </form>
                </div>
            </div>

        <?php } else { ?>
            <div class="container pt-5 text-center">
                <h1 class="pt-5">CART IS EMPTY</h1>
                <h3><a href="<?php echo 'index.php'; ?> ">Shop for items</a></h3>  
            </div>
            
        <?php } ?>
    </section>

    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>