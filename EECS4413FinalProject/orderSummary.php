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
//here
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body style="background-color:#EEEEEE; font-family: 'Open Sans', sans-serif;">

    <?php include 'header.php'; ?>

    <section class="container">
        <br><br><br>
        <h2>ORDER NUMBER: <?php echo $orderResult[0]['OrderID']; ?></h2>
        <h5>DATE: <?php echo $orderResult[0]['DatePurchase']; ?></h5>
        <h5>Name: <?php echo $userResults[0]['FirstName'] . " " . $userResults[0]['LastName']; ?></h5>
        <br>
        <h6>Your Items:</h6>
        <hr>
        <?php foreach($itemResults as $item) : ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <img  class="rounded-start d-block mx-auto" src="<?php echo $item['ImageURL']; ?>" alt="Product" style="object-fit:cover; height:32vh; width:32vh">
                </div>
                <div class="col-md-9">
                    <div class="fs-4">Product Name: <?php echo $item['Name']; ?></div><br>
                    <div>Price: $<?php echo $item['Price']; ?></div><br>
                    <div>Brand: <?php echo $item['Brand']; ?></div><br>
                    <div>Qty: <?php echo $item['Qty']; ?></div><br>
                    <div>Sub-total: $<?php echo ($item['Price']*$item['Qty']); ?></div>
                </div>
                <hr>
            </div>
        <?php endforeach; ?>

        <div class="ps-3 fw-bold fs-3 pb-5">TOTAL: $<?php echo $orderResult[0]['TotalCost']; ?></div>
    </section>

    <?php include 'footer.php'; ?>

</body>
</html>