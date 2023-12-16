<?php
require('backend/config/config.php');
require('backend/config/db.php');
require('backend/dao/itemDAOImpl.php');

$dao = new itemDAOImpl();

if (!isset($_GET['search']) || $_GET['search'] == '') {
    $data = $dao->getAllItems($mysqli);
} else {
    $data = $dao->searchItems($mysqli, $_GET['search']);
    // print_r($data);
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Dogs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <?php include 'header.php' ?>

    <!-- Content -->
    <section>
        <?php foreach ($data as $item) : ?>
            <div class="w-75 d-block mx-auto">
                <a href="itempage.php?id=<?php echo $item['ItemID'] ?>">
                    <!-- <div>
                    <hr>
                    <img src="<?php echo $item['ImageURL'] ?>" alt="Product">
                    <div><?php echo $item['Name'] ?></div>
                    <div>Price: $<?php echo $item['Price'] ?></div>
                    <div><?php echo $item['Category'] ?></div>
                    <div><?php echo $item['Brand'] ?></div>
                    <hr>
                </div> -->
                    <hr style="clear: both; visibility: hidden;">
                    <div class="card mb-3 mx-auto">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="<?php echo $item['ImageURL'] ?>" class="rounded-start d-block mx-auto" alt="Product" style="object-fit:cover; height:32vh; width:32vh">
                                <!--<img src="<?php echo $item['ImageURL'] ?>" class="mx-auto d-block float-right" alt="Product" style="height: 450px; width:100%;"> style="height: 450px; width:100%;" -->
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
                    <hr style="clear: both; visibility: hidden;">
                </a>
            </div>
        <?php endforeach; ?>
    </section>

    <?php include 'footer.php' ?> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>