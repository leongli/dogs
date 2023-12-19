<!-- Header -->
<section class="bg-light">
    <?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        include "access.php";
    }
    // <a href="backend/adminpage.php">ADMIN</a>
    if (access('ADMIN', false)) : ?>

       

    <?php endif;
    //<div class="">Hello, <?php echo $_SESSION['myname']; ></div><a href="logout.php">Logout</a>
    if (access('USER', false)) : ?>

        

    <?php endif; ?>
    <nav class="navbar navbar-expand-lg navbar-light" style="height:10vh">

        <a href="index.php" class="navbar-brand" ><img src="images/logo_v2.png" alt="Logo" style="height:10vh;"></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item pl-3">
                    <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item pl-3">
                    <form action="index.php" method="get" class="dropdown px-3">
                        <button class="btn btn-default dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            CATEGORIES
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><input type="submit" class="dropdown-item" name="search" value="Tops"></li>
                            <li><input type="submit" class="dropdown-item" name="search" value="Bottoms"></li>
                            <li><input type="submit" class="dropdown-item" name="search" value="Accessories"></li>
                        </ul>
                    </form>  

                </li>
                <li class="nav-item pl-3">
                <form action="index.php" method="get" class="dropdown px-3">
                        <button class="btn btn-default dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            BRANDS
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><input type="submit" class="dropdown-item" name="search" value="Nike"></li>
                            <li><input type="submit" class="dropdown-item" name="search" value="Adidas"></li>
                            <li><input type="submit" class="dropdown-item" name="search" value="Reebok"></li>
                            <li><input type="submit" class="dropdown-item" name="search" value="Jordan"></li>
                        </ul>
                    </form>  
                </li>
            </ul>
        </div>

        <form action="index.php" method="get" class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="" class="pr-1"><i class="fa-solid fa-magnifying-glass"></i></label>
            </div>
            <div class="col-auto">
                <input type="text" name="search" class="form-control rounded" placeholder="Search">  
            </div>
            <div class="col-auto">
                <input class="btn btn-outline-secondary" type="submit" value="Search">
            </div>
        </form>
        <div class="dropdown px-2">
            <button class="btn btn-default dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-lg fa-user" style="color: #000000;"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
            <?php
    if (access('ADMIN', false)) : ?>

        <li><a class="dropdown-item" href="adminview.php">View Admin Profile</a></li>
        <li><a class="dropdown-item" href="backend/adminpage.php">Create new item</a></li>
        <li><a class="dropdown-item" href="logout.php">Log out</a></li>

    <?php endif; ?>
            <?php
    if ((!access('ADMIN', false)) && access('USER', false)) : ?>

        <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
        <li><a class="dropdown-item" href="logout.php">Log out</a></li>

    <?php endif; ?>
    <?php
    if (!(access('USER', false) || access('ADMIN', false))) : ?>

        <li><a class="dropdown-item" href="login.php">Sign in</a></li>

    <?php endif; ?>
    
            
            </ul>
        </div>  
        
        <a href="shoppingcart.php"><i class="fa-solid fa-lg fa-cart-shopping pe-4" style="color: #000000;"></i></a>


    </nav>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
