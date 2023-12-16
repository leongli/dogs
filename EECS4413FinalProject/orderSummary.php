<?php 

    require('backend/config/config.php');
    require('backend/config/db.php');

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $orderId = null;

    if(isset($_GET['order'])) {
        $orderId = $_GET['order'];
    }

    if($orderId != null) {

        $orderId = $mysqli -> real_escape_string(test_input($orderId));

        // Create Query
        $query = "SELECT * FROM orders WHERE OrderID = " . $orderId . " LIMIT 1;";

        // Get Result
        $result = $mysqli -> query($query);

        // Fetch Data
        $orderResult = $result -> fetch_all(MYSQLI_ASSOC);

        // Create Query
        $query = "SELECT * FROM order_items WHERE OrderID = " . $orderId . ";";

        // Get Result
        $result = $mysqli -> query($query);

        // Fetch Data
        $itemResults = $result -> fetch_all(MYSQLI_ASSOC);

        // Create Query
        $query = "SELECT FirstName, LastName FROM users WHERE UserID = " . $orderResult[0]['CustomerID'] . ";";

        // Get Result
        $result = $mysqli -> query($query);

        // Fetch Data
        $userResults = $result -> fetch_all(MYSQLI_ASSOC);
    }

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <section>
        <div>ORDER NUMBER: <?php echo $orderResult[0]['OrderID']; ?></div>
        <div>DATE: <?php echo $orderResult[0]['DatePurchase']; ?></div>
        <div>Name: <?php echo $userResults[0]['FirstName'] . " " . $userResults[0]['LastName']; ?></div>
        <br>

        <?php foreach($itemResults as $item) : ?>
            <div>
                <hr>
                <img src="<?php echo $item['ImageURL']; ?>" alt="Product">
                <div>Name: <?php echo $item['Name']; ?></div><br>
                <div>Price: $<?php echo $item['Price']; ?></div><br>
                <div>Brand: <?php echo $item['Brand']; ?></div><br>
                <div>Brand: <?php echo $item['Qty']; ?></div>
                <hr>
            </div>
        <?php endforeach; ?>

        <div>TOTAL: $<?php echo $orderResult[0]['TotalCost']; ?></div>
    </section>

    <?php include 'footer.php'; ?>
    
</body>
</html>