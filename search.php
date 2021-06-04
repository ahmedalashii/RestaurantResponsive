<?php
    include "database.php";
    if (!isset($_GET['search'])) {
        header("location: index.php");
    }
?>
<html>

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body dir="rtl">
    <div class='container'>
        <?php
    if(isset($_GET['search'])) {
        $input = $_GET['search-input'];
        $sql = "SELECT * FROM meals WHERE meal_keywords LIKE '%$input%'";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data)>0 && strlen($input)>0) {
            echo "<h2>نتائج البحث :</h2>";
            while ($row=mysqli_fetch_assoc($data)) {
                echo "
                <div class='restaurant show'>
                <div class ='restaurant-item' style='margin-bottom: 20px; float:right;'>
                                    <a href='#'><img src='images/".$row['meal_image']."' alt='Potato ! :D' draggable='false'></a>
                                    <div class='restaurant-item-description'>
                                    <div>
                                    <span class='meal-name'>اسم العصير : ".$row['meal_name']."</span>
                                        ";
                                if ($row['meal_discount']>0.00) {
                                    echo "<span class='meal-price'>السعر&nbsp;<del style='color:red;'>".$row['meal_price']."$</del>&nbsp;&nbsp;".($row['meal_price']-$row['meal_price']*$row['meal_discount']/100)."$</span>";
                                } else {
                                    echo "<span class='meal-price'>السعر&nbsp;".$row['meal_price']."$</span>";
                                }
                                echo "
                                    </div>
                                    <br>
                                    ";
                                if ($row['meal_discount']>0.00) {
                                    echo "<span class='availability'>يوجد خصم ".$row['meal_discount']."%</span>";
                                } else {
                                    echo "<span class='availability'>لا يوجد خصم</span>";
                                }
                                echo "
                                <div class='stars-rating'>
                                <span class='fa fa-star checked'></span>
                                <span class='fa fa-star checked'></span>
                                <span class='fa fa-star checked'></span>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                </div>
                                </div>
                                </div>
                                </div>
                                ";
            }
        }else{
            header('location: notFound.php');
        }
    }
?>
    </div>
</body>

</html>