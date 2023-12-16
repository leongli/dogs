<?php 

    session_start(); 
    include "access.php";
    access('USER');
    require('backend/config/config.php');
    require('backend/config/db.php');

    // Create Query
    $query = "SELECT * FROM orders WHERE CustomerID = " . $_SESSION['myid'] . " ORDER BY STR_TO_DATE(DatePurchase, '%Y-%m-%d') DESC;";

    // Get Result
    $result = $mysqli -> query($query);

    // Fetch Data
    $orderResult = $result -> fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['myname']; ?> Profile</title>
</head>
<body>
    <?php include 'header.php' ?>

    <section>
        Past Orders: 

        <?php foreach($orderResult as $order) : ?>
        
        <a href="orderSummary.php?order=<?php echo $order['OrderID']; ?>">
            <div>
                <hr>
                <div>Order ID: <?php echo $order['OrderID']; ?></div>
                <div>Date: <?php echo $order['DatePurchase']; ?></div>
                <div>Cost: $<?php echo $order['TotalCost']; ?></div>
                <hr>
            </div>
        </a>
        <?php endforeach; ?>

    </section>

    <?php include 'footer.php' ?>
</body>
</html>