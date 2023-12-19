<?php

session_start();
include "access.php";
access('USER');
require('backend/config/config.php');
require('backend/config/db.php');

// Create Query
$query = "SELECT * FROM orders WHERE CustomerID = " . $_SESSION['myid'] . " ORDER BY STR_TO_DATE(DatePurchase, '%Y-%m-%d') DESC;";

// Get Result
$result = $mysqli->query($query);

// Fetch Data
$orderResult = $result->fetch_all(MYSQLI_ASSOC);


// Create Query
$queryUsers = "SELECT * FROM users";

// Get Result
$resultUsers = $mysqli->query($queryUsers);

// Fetch Data
$userResult = $resultUsers->fetch_all(MYSQLI_ASSOC);


// Create Query
$queryItems = "SELECT * FROM items";

// Get Result
$resultItems = $mysqli->query($queryItems);

// Fetch Data
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
    <style>
        .active-tab {
            display: block;
        }
    </style>

</head>

<body>
    <?php include 'header.php' ?>
    <div style="background-color:#EEEEEE; height:90vh">


        <div class="container pt-5">
            <h3 class="">Hello, <?php echo $_SESSION['myname']; ?></h3>

            <!-- Tab links -->
            <ul class="nav nav-tabs" id="myTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-1">Sales History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Customer Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Inventory</a>
                </li>
            </ul>

            <!-- Tab content -->
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade active show">
                    <hr>
                    <?php  $i=0;?>
                    <?php foreach ($orderResult as $order) : ?>
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
                    <?php if($i == 0) {?>
                        <h5 class="text-center">No order history, <a href="index.php">shop for items</a></h5>
                    <?php } ?>
                </div>

                <div id="tab-2" class="tab-pane fade">
                    <?php  $i=0;?>
                    <?php foreach ($userResult as $user) : ?>
                        <?php $i++;?>
                        <a class="text-decoration-none text-dark"href="userInfo.php?id=<?php echo $user['UserID']; ?>">
                            <div>                                
                                <div class="text-decoration-underline">User ID: <?php echo $user['UserID']; ?></div>
                                <div>Name: <?php echo $user['FirstName']; ?> <?php echo $user['LastName']; ?></div>
                                <div>Email: <?php echo $user['Email']; ?></div>
                                <div>Role: <?php echo $user['Rank']; ?></div>
                                <hr>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <?php if($i == 0) {?>
                        <h5 class="text-center">No users registered.</h5>
                    <?php } ?>
                </div>

                <div id="tab-3" class="tab-pane fade">
                <?php  $i=0;?>
                    <?php foreach ($itemResult as $item) : ?>
                        <?php $i++;?>
                        <div class="w-75 d-block mx-auto">
                        <a class="text-decoration-none text text-dark"href="edititem.php?id=<?php echo $item['ItemID'] ?>">
                            <hr style="clear: both; visibility: hidden;">
                            <div class="card mb-3 mx-auto">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="<?php echo $item['ImageURL'] ?>" class="rounded-start d-block mx-auto" alt="Product" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $item['Name'] ?></h5>
                                            <h5 class="card-subtitle">Price: $<?php echo $item['Price'] ?></h5>
                                            <p class="card-text"><?php echo $item['Category'] ?></p>
                                            <p class="card-text"><?php echo $item['Brand'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <?php if($i == 0) {?>
                        <h5 class="text-center">No items available. <a href="adminpage.php">Create an item here.</a></h5>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        // Custom JavaScript for tab switching
        $(document).ready(function () {
            $('.nav-link').on('click', function (e) {
                e.preventDefault();
                $('.tab-pane').removeClass('active show');
                $($(this).attr('href')).addClass('active show');
            });
        });
    </script>
</body>

</html>