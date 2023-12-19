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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body style="background-color:#EEEEEE; font-family: 'Open Sans', sans-serif;">

    <?php include 'header.php' ?>

    <section>
        <h2 class="d-block mx-auto px-5 pt-5">Your Order</h2>
        <!-- Display contents of each item in the order -->
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
                                    
                                <div class="fs-4">Item Name: <?php echo $item->getName() ?></div><br>
                                <div class="fs-6">Item Price: $<?php echo $item->getPrice() ?></div>
                                <br>
                                        <label for="">Qty: </label> <span><?php echo $item->getOrderQty() ?></span>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php $totalPrice += ($item->getPrice() * $item->getOrderQty());

            endforeach; ?>
            
            <div class="row w-100 py-3">
                <div class="col-1"></div>
                <!-- Total price -->
                <div class="col-8">
                    <h4><b>Total Price: $<?php echo $totalPrice; ?></b></h4>
                </div>
                <div class="col">
                    <a href="index.php"><button class="btn btn-outline-secondary" type="button">Cancel</button></a>
                </div>
                    <!-- User shipping + billing information -->
                    <form action="backend/controller/shoppingcartCon.php" method="post">
                        <label for="">Shipping Address</label><input type="text" name="ship" value="<?php if(isset($_SESSION['ship'])) {echo $_SESSION['ship'];} ?>" required><br>
                        <label for="">Billing Address</label><input type="text" name="bill" value="<?php if(isset($_SESSION['bill'])) {echo $_SESSION['ship'];} ?>" required><br>
                        <label for="">Card #</label><input type="number" name="card" min="1" required><br>
                        <input type="submit" name="order" value="Place Order" class="btn btn-outline-secondary" style="width:50%">
                    </form>
            </div>
        <!-- Display default message for an empty cart -->
        <?php } else { ?>
            <div class="container pt-5 text-center">
                <h1 class="pt-5">CART IS EMPTY</h1>
                <h3><a href="<?php echo 'index.php'; ?> ">Shop for items</a></h3>  
            </div>
            
        <?php } ?>
    </section>

    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   
</body>

</html>