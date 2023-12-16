<?php 

require('config/config.php');
require('config/db.php');
require('dao/itemDAOImpl.php');
session_start();
require '../access.php';
access('ADMIN');

//Message Vars
$msg = '';

//Check For Submit
if(filter_has_var(INPUT_POST, 'submit')) { //checking for type post with name submit

    //Get Form Data
    $name = $mysqli -> real_escape_string(test_input($_POST['name']));
    $desc = $mysqli -> real_escape_string(test_input($_POST['desc']));
    $category = $mysqli -> real_escape_string(test_input($_POST['category']));
    $brand = $mysqli -> real_escape_string(test_input($_POST['brand']));
    $price = $mysqli -> real_escape_string(test_input($_POST['price']));
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    //Check Required Fields
    if(!empty($name) && !empty($desc) && !empty($category) && !empty($brand) && !empty($price)) {
        // Passed

        $dao = new itemDAOImpl();
        $dao->addItem($mysqli, $name, $desc, $category, $brand, $price, $fileName, $fileTmpName, $fileSize, $fileError);
    
    } else {
        // Failed
        $msg = 'Please fill in all fields'; //Message to user on failed submit attempt
    }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <a href="../">BACK</a>
    <section>
        <h1>Create Item</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <label for="">Name: </label><br>
            <input type="text" name="name"> <br>

            <label for="">Description</label><br>
            <textarea name="desc" id="" cols="30" rows="10"></textarea><br>

            <label for="">Category</label><br>
            <select name="category" id="cars">
                <option value="Shirt">Shirt</option>
                <option value="Pants">Pants</option>
                <option value="Sweater">Sweater</option>
                <option value="Hat">Hat</option>
            </select><br>

            <label for="">Brand</label><br>
            <input type="text" name="brand"><br>

            <label for="">Price</label><br>
            <input type="number" name="price"><br>

            <label for="">Image</label><br>
            <input class="border-card" type="file" name="file" required><br><br>

            <input type="submit" name="submit" value="Add">
        </form>
        <?php if($msg != '') {
            echo $msg;
        } ?>
    </section>
</body>
</html>