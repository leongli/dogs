<?php
require('backend/config/config.php');
require('backend/config/db.php');
require('backend/dao/itemDAOImpl.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: index.php");
}

// Update the item, if applicable
if (filter_has_var(INPUT_POST, 'update')) { //checking for type post with name update
    //Get Form Data
    $name = $mysqli->real_escape_string(test_input($_POST['name']));
    $desc = $mysqli->real_escape_string(test_input($_POST['desc']));
    $category = $mysqli->real_escape_string(test_input($_POST['cat']));
    $brand = $mysqli->real_escape_string(test_input($_POST['brand']));
    $price = $mysqli->real_escape_string(test_input($_POST['price']));
    $qty = $mysqli->real_escape_string(test_input($_POST['qty']));
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    // Update database
    $dao = new itemDAOImpl();
    if ($fileName == '') {
        $newItem = $dao->updateItemNoImage($mysqli, $id, $name, $desc, $category, $brand, $price, $qty);
    } else {
        $newItem = $dao->updateItem($mysqli, $id, $name, $desc, $category, $brand, $price, $qty, $fileName, $fileTmpName, $fileSize, $fileError);
    }
}

// Get the item information
$config = 'config/config.php';
$db = 'config/db.php';
$dao = new itemDAOImpl();
$data = $dao->getItemsById($id, $config, $db);

// Get all brands
$query = "SELECT DISTINCT `Brand` FROM `items`;";
$result = $mysqli -> query($query);
$brands = $result -> fetch_all(MYSQLI_ASSOC);

// Get all categories
$query = "SELECT DISTINCT `Category` FROM `items`;";
$result = $mysqli -> query($query);
$categories = $result -> fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-color:#EEEEEE; font-family: 'Open Sans', sans-serif;">
    <?php include 'header.php' ?>
    <section style="height:90vh">
        <!-- Display info about each item -->
        <?php foreach ($data as $item) : ?>
            <div class="container h-75">
            <!-- Create a form so that the data can be updated -->
            <form action="" method="post" id="userDetails" enctype="multipart/form-data" class="row h-100  align-items-center">
                    <div class="col-md-4">
                        <img src="<?php echo $item['ImageURL'] ?>" alt="Product" class="img-fluid">
                    </div>
                    <div class="col-md-8" style="font-family: 'Open Sans', sans-serif;">
                        <!-- Name -->
                        <div>Name: <input type="text" name="name" value='<?php echo $item['Name'] ?>'></div>
                        <!-- Brand -->
                        <div>Brand:                         
                        <input type="text" list="brands" name="brand" value='<?php echo $item['Brand'] ?>' />
                        <datalist id="brands">
                            <?php foreach ($brands as $brand) : ?>
                                <option><?php echo $brand['Brand'] ?></option>
                            <?php endforeach; ?>
                        </datalist>
                        </div>
                        <!-- Category -->
                        <div>Category:                         
                        <select name="cat" id="cat">
                            <?php foreach ($categories as $cat) : ?>
                                <option><?php echo $cat['Category'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <!-- Price -->
                        <div>Price: $<input type="number" name="price" value=<?php echo $item['Price'] ?>></div>
                        <!-- Description -->
                        <div>Description: <input type="text" name="desc" value='<?php echo $item['Description'] ?>'></div>
                        <!-- Quantity -->
                        <label for="qty">Quantity: </label>
                        <input type="number" name="qty" min="1" max="99999" value=<?php echo $item['Qty'] ?>>
                        <!-- Image -->
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label text-left">Change Image: </label>
                            <div class="col-sm-9">
                                <input class="border-card w-100 h-100" type="file" name="file">
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $item['ItemID']; ?>">
                        <!-- Submit Button -->
                        <input type="submit" name="update" value="Update Item">
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </section>

    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
</body>

</html>