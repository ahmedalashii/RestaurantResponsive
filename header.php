<?php
  // This Index Page is Completely By Ahmed Hesham Alashi 120191156 and Mohammed Abo Sido 120192308
  session_start();
    include "database.php";
    // if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) { // neither admin nor user
    //     header("location: login.php"); // default page
    //     // you can't access this page (index) else if either the user or the admin logged in
    // }
?>

<!DOCTYPE html>
<html dir="rtl">

<head>
    <title>مطعم الحنيذ التراثي</title>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icon -->
    <link rel="icon" href="https://i.pinimg.com/originals/4e/24/f5/4e24f523182e09376bfe8424d556610a.png">
    <!-- Arabic Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Css Files -->
    <link rel="stylesheet" href="../FP2/css/style1.css">
    <link rel="stylesheet" href="../FP2/css/header.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
    <!-- Header Section -->
    <header>
    <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <div class="logo">
            <a href="index.php"><img src="images/logo.jpg" alt="This is a Logo !" draggable="false"></a>
        </div> <!-- ./logo -->
        <nav class="nav">
            <ul>
                <li>
                    <?php
                         if (isset($_SESSION['admin'])) {
                             $sql = "SELECT name from  admin_info WHERE username= '$_SESSION[admin]'";
                             $data = mysqli_query($conn, $sql);
                             $row = mysqli_fetch_array($data);
                             echo "<span>مرحباً ADMIN $row[name]</span>";
                             echo "<a href ='logout.php' >تسجيل الخروج</a>";
                         } elseif (isset($_SESSION['user'])) { // user
                             $sql = "SELECT name from  user_info WHERE username= '$_SESSION[user]'";
                             $data = mysqli_query($conn, $sql);
                             $row = mysqli_fetch_array($data);
                             echo "<span>مرحباً $row[name]</span>";
                             echo "<a href ='logout.php' >تسجيل الخروج</a>";
                         }
                    ?>
                </li>
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="#meals">الوجبات الرئيسية</a></li>
                <li><a href="#services">خدمات</a></li>
                <li><a href="#r-meals">أصناف الطعام</a></li>
                <li><a href="#contact">اتصل بنا</a></li>
            </ul>
            <div class="social-media">
                <a href="https://www.facebook.com/AHmEDAlAsHiii/" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/ahmed_alashii" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://www.instagram.com/ahmed_alashii/" target="_blank"><i class="fa fa-instagram"></i></a>
                <a href="https://github.com/ahmedalashii" target="_blank"><i class="fa fa-github"></i></a>
                <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
            </div> <!-- ./social-media -->
        </nav> <!-- ./nav -->
    </header> <!-- /header -->
</body>