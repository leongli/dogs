<?php 

    
    require('backend/dao/itemDAOImpl.php');
    
    if(isset($_GET['id']) ){
        $id = $_GET['id'];
    } else {
        header("Location: index.php" );
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
</head>
<body>
    <?php include 'header.php' ?>

    <!-- Content -->
    <section>
        <?php foreach($data as $item) :?>
            <form action="<?php echo htmlspecialchars("backend/controller/orderCon.php"); ?>" method="post">
            <div>
                <img src="<?php echo $item['ImageURL'] ?>" alt="Product">
                <div>Name: <?php echo $item['Name'] ?></div><br>
                <div>Price: <?php echo $item['Price'] ?></div><br>
                <div>Description: <?php echo $item['Description'] ?></div><br>
                <div>Brand: <?php echo $item['Brand'] ?></div><br>
            </div>
            <label for="">Qty: </label><input type="number" name="qty" min="1" max="999" value="1">
            <input type="hidden" name="id" value="<?php echo $item['ItemID']; ?>">
            <input type="submit" name="add" value="Add to Cart">
            </form>
        <?php endforeach; ?>
    </section>

    <?php include 'footer.php' ?>
</body>
</html>