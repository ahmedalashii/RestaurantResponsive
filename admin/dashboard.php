<?php
    // This Dashboard Page is Completely By Ahmed Hesham Alashi 120191156
    session_start();
    include("../database.php");
    if (isset($_SESSION['user'])) { // if it's user
        header("location: cantAccess.php");
    } elseif(isset($_SESSION['admin'])){ // if it's admin
        include "sidenav.php";
        include "topheader.php";
    }else{ // otherwise go to login page
        header("location: ../login.php");
    }