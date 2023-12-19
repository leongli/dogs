<?php

session_start();
include "access.php";
access('USER');
require('backend/config/config.php');
require('backend/config/db.php');

// Get all orders from a specific customer, sorted by date
$query = "SELECT * FROM orders WHERE CustomerID = " . $_SESSION['myid'] . " ORDER BY STR_TO_DATE(DatePurchase, '%Y-%m-%d') DESC;";
$result = $mysqli->query($query);
$orderResult = $result->fetch_all(MYSQLI_ASSOC);

// Get all users from database
$queryUsers = "SELECT * FROM users";
$resultUsers = $mysqli->query($queryUsers);
$userResult = $resultUsers->fetch_all(MYSQLI_ASSOC);

// Get all items from database
$queryItems = "SELECT * FROM items";
$resultItems = $mysqli->query($queryItems);
$itemResult = $resultItems->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['myname']; ?> Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include 'header.php' ?>
    <div style="background-color:#EEEEEE; height:90vh">
        <div class="container pt-5">
            <h3 class="">Hello, <?php echo $_SESSION['myname']; ?></h3>
            <!-- Display shipping and billing addresses -->
            <b>
                <span>Shipping Address: <?php if(isset($_SESSION['ship']) && $_SESSION['ship'] != '') { echo $_SESSION['ship'];} else { echo "None";} ?></span><br>
                <span>Billing Address: <?php if(isset($_SESSION['bill']) && $_SESSION['ship'] != '') { echo $_SESSION['bill'];} else { echo "None";} ?></span><br><br>
            </b>

            Past Orders:
            <hr>
            <!-- Display key details about each order -->
            <?php foreach ($orderResult as $order) : ?>
                <?php $i = 0?>
                <?php $i++;?>
                <a class="text-decoration-none text-dark"href="orderSummary.php?order=<?php echo $order['OrderID']; ?>">
                    <div>
                        <div class="text-decoration-underline">Order ID: <?php echo $order['OrderID']; ?></div>
                        <div>Date: <?php echo $order['DatePurchase']; ?></div>
                        <div>Cost: $<?php echo $order['TotalCost']; ?></div>
                        <hr>
                    </div>
                </a>
            <?php endforeach; ?>
            <!-- Default message if no orders exost -->
            <?php if($i == 0) {?>
                <h5 class="text-center">No order history. <a href="index.php">Shop for items</a></h5>
            <?php } ?>


        </div>
    </div>
    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
</body>

</html>