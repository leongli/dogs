<?php


require('backend/dao/itemDAOImpl.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: index.php");
}

$config = 'config/config.php';
$db = 'config/db.php';
$dao = new itemDAOImpl();
$data = $dao->getItemsById($id, $config, $db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body style="background-color:#EEEEEE; font-family: 'Open Sans', sans-serif;">
    <?php include 'header.php' ?>

    <!-- Content -->
    <section style="height:90vh">
        <?php foreach ($data as $item) : ?>
            <div class="container h-75">
                <form action="<?php echo htmlspecialchars("backend/controller/orderCon.php"); ?>" method="post" class="row h-100  align-items-center">
                    <div class="col-md-4">
                        <img src="<?php echo $item['ImageURL'] ?>" alt="Product" class="img-fluid">
                    </div>
                    <div class="col-md-8" style="font-family: 'Open Sans', sans-serif;">
                        <div style="font-weight:700; font-size:xx-large" class="pb-0">Name: <?php echo $item['Name'] ?></div>
                        <div style="font-weight:700; font-size:large">Brand: <?php echo $item['Brand'] ?></div><br>
                        <div>Price: $<?php echo $item['Price'] ?></div><br>
                        <div>Description: <?php echo $item['Description'] ?></div><br>
                       
                        <label for="">Qty: </label><input type="number" name="qty" min="1" max=<?php echo $item['Qty'] ?> value="1">
                        <div>Quantity Remaining: <?php echo $item['Qty'] ?></div><br>
                        <input type="hidden" name="id" value="<?php echo $item['ItemID']; ?>">
                        <input type="submit" name="add" value="Add to Cart">
                    </div>
                </form>
            </div>


        <?php endforeach; ?>
    </section>

    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
</body>

</html>