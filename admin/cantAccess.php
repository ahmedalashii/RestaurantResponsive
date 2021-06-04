<?php
    session_start();
    include "../database.php";
    if (isset($_SESSION['admin'])) {
        header("location: dashboard.php");
    }else if (!isset($_SESSION['user'])){ // just show this page (cantAccess) if the logger is a normal user
        header("location: ../login.php"); 
    }
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/404.css">
    <!-- Arabic Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/404.css">
</head>

<body>
    <div class="mainbox">
        <div class="err">4</div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2">4</div>
        <div class="msg">لا يمكنك الدخول الى لوحة التحكم لأنك مستخدم عادي ولست آدمن<p style="font-size:35px;">يلا نروح عالـ <a href="../index.php" style="color: black;">الصفحة الرئيسية</a></p>
        </div>
    </div>

</html>