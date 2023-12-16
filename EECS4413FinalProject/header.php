<!-- Header -->
<section>
    <?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        include "access.php";
    }

    if (access('ADMIN', false)) : ?>

        <a href="backend/adminpage.php">ADMIN</a>

    <?php endif;

    if (access('USER', false)) : ?>

        <div class="">Hello, <?php echo $_SESSION['myname']; ?></div><a href="logout.php">Logout</a>

    <?php endif; ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:10vh">

        <a href="index.php" class="navbar-brand" ><img src="images/logo_v2.png" alt="Logo" style="height:10vh;"></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item pl-3">
                    <a class="nav-link active" aria-current="page" href="">HOME</a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="#">MEN</a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="#">WOMEN</a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="#">KIDS</a>
                </li>
            </ul>
        </div>

        <form action="index.php" method="get" class="form-inline my-2 my-lg-0 pr-5">
                <label for="" class="pr-1"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" name="search" class="form-control rounded" placeholder="Search">  
                
                <input class="btn btn-outline-secondary" type="submit" value="Search">
        </form>

        <a href="profile.php" class="pr-3"><i class="fa-regular fa-lg fa-user" style="color: #000000;"></i></a>
        <a href="shoppingcart.php"><i class="fa-solid fa-lg fa-cart-shopping" style="color: #000000;"></i></a>


    </nav>

</section>