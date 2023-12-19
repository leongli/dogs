<?php
require('backend/config/config.php');
require('backend/config/db.php');
require('backend/dao/itemDAOImpl.php');

$dao = new itemDAOImpl();
// Retrieve all the items, depending on the search and/or sort settings applied
 if (!isset($_GET['search']) || $_GET['search'] == '' && (!isset($_GET['sort']))) {
    if(!isset($_GET['sort'])) $data = $dao->getAllItems($mysqli);
    else $data = $dao->getItemsSorted($mysqli, $_GET['sort'],'');
} else{
    if(!isset($_GET['sort'])) $data = $dao->searchItems($mysqli, $_GET['search']);
    else $data = $dao->getItemsSorted($mysqli, $_GET['sort'],$_GET['search']);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/main.js" defer></script>
</head>

<body style="background-color:#EEEEEE; font-family: 'Open Sans', sans-serif;">

    <?php include 'header.php' ?>
    <section>
        <div class="row g-0 pt-2">
            <div class="col col-sm-1"></div>
            <div class="col col-sm-9">
                <!-- display category or brand route (if selected via navbar) -->
                <?php  if(isset($_GET['search'])) {?>
                    <p>Search results for <b><?php echo $_GET['search'] ?></b></p>
                <?php }?>
            </div>
            <div class="col col-sm-1">
            
                <!-- sorting dropdown menu -->
                <form action="" method="get" class="dropdown">
                    <label for="">Sort By:</label>
                    <button class="btn btn-default dropdown-toggle btn-outline-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if(isset($_GET['sort'])) {echo $_GET['sort']; }
                    else {echo "--" ;}?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><input type="submit" class="dropdown-item" name="sort" value="Price Ascending"></li>
                        <li><input type="submit" class="dropdown-item" name="sort" value="Price Descending"></li>
                        <li><input type="submit" class="dropdown-item" name="sort" value="Brand Ascending"></li>
                        <li><input type="submit" class="dropdown-item" name="sort" value="Brand Descending"></li>
                        <li><input type="submit" class="dropdown-item" name="sort" value="Category Ascending"></li>
                        <li><input type="submit" class="dropdown-item" name="sort" value="Category Descending"></li>
                    </ul>
                    <?php if(isset($_GET['search'])) {?>
                    <input type="hidden" name="search" value="<?php echo $_GET['search'] ?>">
                    <?php } ?>
                </form> 
            </div>
        </div>
        
        <!-- Display each item -->
        <?php $count = 0 ?>
        <div class="container-fluid">
            <div class="row">
        <?php foreach ($data as $item) : ?>
            <div class="col-md-3 mb-3">
                <a class="text-decoration-none text text-dark" href="itempage.php?id=<?php echo $item['ItemID'] ?>">
                    <div class="card">
                        <img src="<?php echo $item['ImageURL'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Product">
                        <div class="card-body">
                            <h5 class="card-text"><?php echo $item['Name'] ?></h5>
                            <h5 class="card-text">Price: $<?php echo $item['Price'] ?></h5>
                            <p><?php echo $item['Category'] ?></p>
                            <p><?php echo $item['Brand'] ?></p>
                        </div>
                    </div>
                </a>
                <div class="text-center" style="padding-top:10px;"> <!-- Center-align the button -->
                    <div class="quick">
                        <button>Quick Add to Cart</button>
                        <input type="hidden" name="id" value="<?php echo $item['ItemID']; ?>">
                    </div>
                </div>
            </div>
            <?php $count++; ?>
            <?php if ($count % 4 == 0) : ?>
                </div><div class="row">
            <?php endif; ?>

        <?php endforeach; ?>
        
        </div>
        </div>
    </section>

    <?php include 'footer.php' ?> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    </body>

</html>