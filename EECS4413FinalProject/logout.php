<?php

session_start();

if(isset($_SESSION['myname'])) {
    unset($_SESSION['myname']);
}
if(isset($_SESSION['myid'])) {
    unset($_SESSION['myid']);
}
if(isset($_SESSION['myrank'])) {
    unset($_SESSION['myrank']);
}
if(isset($_SESSION['mycart'])) {
    unset($_SESSION['mycart']);
}

header("Location: login.php");

?>