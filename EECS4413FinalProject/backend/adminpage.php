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
if (filter_has_var(INPUT_POST, 'submit')) { //checking for type post with name submit

    //Get Form Data
    $name = $mysqli->real_escape_string(test_input($_POST['name']));
    $desc = $mysqli->real_escape_string(test_input($_POST['desc']));
    $category = $mysqli->real_escape_string(test_input($_POST['category']));
    $brand = $mysqli->real_escape_string(test_input($_POST['brand']));
    $price = $mysqli->real_escape_string(test_input($_POST['price']));
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    //Check Required Fields
    if (!empty($name) && !empty($desc) && !empty($category) && !empty($brand) && !empty($price)) {
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body style="background-color:#EEEEEE; font-family: 'Open Sans', sans-serif;">


    <section class="container pt-5">
        <div class="row justify-content-center pt-5">
            <div class="col-md-6 text-center">
                <h1>Create Item</h1>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label text-left">Name: </label><br>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label text-left">Description: </label><br>
                        <div class="col-sm-9">
                            <textarea name="desc" id="" cols="30" rows="10" class="w-100"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label text-left">Category: </label>
                        <div class="col-sm-9">
                            <select name="category" id="cars" class="w-100 h-100">
                            <option value="Tops">Tops</option>
                            <option value="Bottoms">Bottoms</option>
                            <option value="Accessories">Accessories</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label text-left">Brand: </label>
                        <div class="col-sm-9">
                            
                            <select name="brand" id="cars" class="w-100 h-100">
                            <option value="Nike">Nike</option>
                            <option value="Adidas">Adidas</option>
                            <option value="Reebok">Reebok</option>
                            <option value="Jordan">Jordan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label text-left">Price ($): </label>
                        <div class="col-sm-9">
                            <input type="number" name="price" class="w-100 h-100">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label text-left">Image: </label>
                        <div class="col-sm-9">
                            <input class="border-card w-100 h-100" type="file" name="file" required>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Add" class="btn btn-outline-success">
                    <button type="button" class="btn btn-outline-danger" onclick="location.href='../'">Cancel</button>
                </form>
                <?php if ($msg != '') {
                    echo $msg;
                } ?>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>