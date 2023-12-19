<?php 
    require('backend/config/config.php');
    require('backend/config/db.php');
    require('backend/dao/itemDAOImpl.php');
    require('backend/dao/userDAOImpl.php');
    session_start();
    require 'access.php';
    access('ADMIN');

    
    $userId = null;

    if(isset($_GET['id'])) {
        $userId = $_GET['id'];
    }

    // Updates the user
    if (filter_has_var(INPUT_POST, 'update')) { //checking for type post with name update
        //Get Form Data
        $first = $mysqli->real_escape_string(test_input($_POST['first']));
        $last = $mysqli->real_escape_string(test_input($_POST['last']));
        $email = $mysqli->real_escape_string(test_input($_POST['email']));
        $role = $mysqli->real_escape_string(test_input($_POST['role']));

        $dao = new userDAOImpl();
        $dao->updateUser($mysqli, $first, $last, $email, $role, $userId);
    }

    /*
    * Get Database data
    */
    if($userId != null) {
        $userId = $mysqli -> real_escape_string(test_input($userId));

        // Get the user with the given id
        $query = "SELECT * FROM users WHERE UserID = " . $userId . " LIMIT 1;";
        $result = $mysqli -> query($query);
        $userResult = $result -> fetch_all(MYSQLI_ASSOC);

        // Get all orders from the given user
        $query = "SELECT * FROM orders WHERE CustomerID = " . $userId . ";";
        $result = $mysqli -> query($query);
        $orderResults = $result -> fetch_all(MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
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
        <!-- Display user-specific info -->
        <form action="" method="post" id="userDetails" enctype="multipart/form-data">
            <h2><em>USER INFO</em></h2>
            <div class="text-decoration-underline">User ID: <?php echo $userResult[0]['UserID']; ?></div>
            <div>First Name: <input type="text" name="first" value=<?php echo $userResult[0]['FirstName']; ?>></div>
            <div>Last Name: <input type="text" name="last" value=<?php echo $userResult[0]['LastName']; ?>></div>
            <div>Email: <input type="email" name="email" value=<?php echo $userResult[0]['Email']; ?>></div>
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="admin" <?php echo ($userResult[0]['Rank'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo ($userResult[0]['Rank'] == 'user') ? 'selected' : ''; ?>>User</option>
            </select>
            <br><br>
            <button type="submit" name="update">Update User Details</button>
        </form>
        <hr>
        <!-- Display order history of the given user -->
        <h2><em>ORDER HISTORY</em></h2>
        <?php  $i=0;?>
        <?php foreach ($orderResults as $order) : ?>
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
            <h5 class="text-center">No order history. <a href="index.php">Shop for items</a></h5>
        <?php } ?>
    </section>

    <?php include 'footer.php'; ?>
    
</body>
</html>