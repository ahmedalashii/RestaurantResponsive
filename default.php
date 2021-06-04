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
    <link rel="stylesheet" href="css/style1.css"> <!-- General Styling -->
    <link rel="stylesheet" href="css/header.css"> <!-- 1- Header Section -->
    <link rel="stylesheet" href="css/home.css"> <!-- 2- Home Section -->
    <link rel="stylesheet" href="css/meals.css"> <!-- 3- Meals Section -->
    <link rel="stylesheet" href="css/services.css"> <!-- 4- Services Section -->
    <link rel="stylesheet" href="css/r-meals.css"> <!-- 5- Restaurant Meals Section -->
    <link rel="stylesheet" href="css/r-meals.css"> <!-- 6- Contact Section -->
    <link rel="stylesheet" href="css/footer.css"> <!-- 7- Footer Section -->
    <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Font Awesome -->
</head>
<script type="text/javascript">
window.addEventListener("scroll", function() {
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
})
</script>

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
                             echo "<a href ='logout.php'class='user'>تسجيل الخروج</a>";
                         } elseif (isset($_SESSION['user'])) { // user
                             $sql = "SELECT name from  user_info WHERE username= '$_SESSION[user]'";
                             $data = mysqli_query($conn, $sql);
                             $row = mysqli_fetch_array($data);
                             echo "<span>مرحباً $row[name]</span>";
                             echo "<a href ='logout.php' class='user'>تسجيل الخروج</a>";
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

    <!-- Home Section -->
    <section class="home">
        <div class="overlay">
            <div class="home-content">
                <div class="home-description">
                    <img src="images/lable2.gif" alt="This is Home Logo !">
                    <h2>لأشهى المأكولات البحرية والشعبية</h2>
                    <form action="search.php" method="GET">
                        <input type="text" placeholder="ابحث" name="search-input">
                        <br>
                        <button class="btn" type="submit" name="search">
                            ابحث
                            <span></span><span></span><span></span><span></span>
                        </button>
                    </form>
                </div> <!-- ./home-description -->
            </div> <!-- ./home-content -->
        </div> <!-- ./overlay -->
    </section> <!-- ./home -->

    <!-- Meals Section -->
    <section class="meals" id="meals">
        <div class="container">
            <h2>الوجبات الرئيسية</h2>
            <div class="meals-choices">
                <button class="lunch-btn" onclick="toLunchMeal()">مأكولات بحرية</button>
                <button class="brfast" onclick="toBreakfastMeal()">وجبات اللحوم</button>
                <button class="rest active" onclick="toRestaurantMeal()">عصائر طبيعية</button>
            </div> <!-- ./meals-choices -->
            <div class="meals-menu pd-y">
                <div class="restaurant show">
                    <?php
                        $sql = "SELECT * FROM meals WHERE meal_category=3";
                        $data = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($data)>0) {
                            while ($row=mysqli_fetch_assoc($data)) {
                                echo "<div class ='restaurant-item' style='margin-bottom: 20px; float:right;'>
                                    <a href='#'><img src='images/".$row['meal_image']."' alt='Potato ! :D' draggable='false'></a>
                                    <div class='restaurant-item-description'>
                                    <div>
                                        <span class='meal-name'>اسم العصير : ".$row['meal_name']."</span>
                                        ";
                                if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
                                    echo "<span class='meal-price'>السعر&nbsp;<del style='color:red;'>".$row['meal_price']."$</del>&nbsp;&nbsp;".($row['meal_price']-$row['meal_price']*$row['meal_discount']/100)."$</span>";
                                } else {
                                    echo "<span class='meal-price'>السعر&nbsp;".$row['meal_price']."$</span>";
                                }
                                echo "
                                    </div>
                                    <br>
                                    ";
                                if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
                                    echo "<span class='availability'>يوجد خصم ".$row['meal_discount']."%</span>";
                                } else { // normal meal
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
                                </div>";
                            }
                        }
                    ?>

                </div> <!-- restaurant show -->
                <div class="breakfast">
                    <?php
                        $sql = "SELECT * FROM meals WHERE meal_category=2";
                        $data = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($data)>0) {
                            while ($row=mysqli_fetch_assoc($data)) {
                                echo "<div class ='breakfast-item' style='margin-bottom: 20px; float:right;'>
                                    <a href='#'><img src='images/".$row['meal_image']."' alt='Potato ! :D' draggable='false'></a>
                                    <div class='breakfast-item-description'>
                                    <div>
                                        <span class='meal-name'>اسم الوجبة : ".$row['meal_name']."</span>
                                        ";
                                if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
                                    echo "<span class='meal-price'>السعر&nbsp;<del style='color:red;'>".$row['meal_price']."$</del>&nbsp;&nbsp;".($row['meal_price']-$row['meal_price']*$row['meal_discount']/100)."$</span>";
                                } else {
                                    echo "<span class='meal-price'>السعر&nbsp;".$row['meal_price']."$</span>";
                                }
                                echo "
                                    </div>
                                    <br>
                                    ";
                                if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
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
                                </div>";
                            }
                        }
                    ?>

                </div> <!-- breakfast -->
                <div class="lunch">
                    <?php
                        $sql = "SELECT * FROM meals WHERE meal_category=1";
                        $data = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($data)>0) {
                            while ($row=mysqli_fetch_assoc($data)) {
                                echo "<div class ='lunch-item' style='margin-bottom: 20px; float:right;'>
                                    <a href='#'><img src='images/".$row['meal_image']."' alt='Potato ! :D' draggable='false'></a>
                                    <div class='lunch-item-description'>
                                    <div>
                                        <span class='meal-name'>اسم الوجبة : ".$row['meal_name']."</span>
                                        ";
                                if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
                                    echo "<span class='meal-price'>السعر&nbsp;<del style='color:red;'>".$row['meal_price']."$</del>&nbsp;&nbsp;".($row['meal_price']-$row['meal_price']*$row['meal_discount']/100)."$</span>";
                                } else {
                                    echo "<span class='meal-price'>السعر&nbsp;".$row['meal_price']."$</span>";
                                }
                                echo "
                                    </div>
                                    <br>
                                    ";
                                if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
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
                                </div>";
                            }
                        }
                    ?>
                </div> <!-- lunch -->
            </div> <!-- ./meals-menu -->
        </div> <!-- ./container-->
    </section> <!-- ./meals -->


    <!-- Services Section -->
    <section class="services pd-y" id="services">
        <div class="overlay">
            <div class="container">
                <div class="services-content">
                    <h2>خدمات</h2>
                    <div class="services-item">
                        <img src="images/new.gif" alt="New !">
                        <h3>عروض متجددة</h3>
                        <p>المطعم هو مكان تقدم فيه الماكولات والمشروبات للزبائن. تم تشغيل المطاعم في بداية الأمر على
                            جوانب طرق السفر ليتمكن المسافرون من التوقف للراحة واستعادة حيويتهم. أما اليوم فإن المطاعم
                            تكاد تكون في كل مكان في الشوارع الهادئة والطرق المزدحمة وفي الفنادق والمطارات ومحطات الحافات
                            والقطارات.</p>
                    </div> <!-- ./services-item -->
                    <div class="services-item">
                        <img src="images/gift.gif" alt="Gift !">
                        <h3>هدايا</h3>
                        <p>المطعم هو مكان تقدم فيه الماكولات والمشروبات للزبائن. تم تشغيل المطاعم في بداية الأمر على
                            جوانب طرق السفر ليتمكن المسافرون من التوقف للراحة واستعادة حيويتهم. أما اليوم فإن المطاعم
                            تكاد تكون في كل مكان في الشوارع الهادئة والطرق المزدحمة وفي الفنادق والمطارات ومحطات الحافات
                            والقطارات.</p>
                    </div> <!-- ./services-item -->
                    <div class="services-item">
                        <img src="images/delever.gif" alt="Deliever !">
                        <h3>خدمة التوصيل</h3>
                        <p>المطعم هو مكان تقدم فيه الماكولات والمشروبات للزبائن. تم تشغيل المطاعم في بداية الأمر على
                            جوانب طرق السفر ليتمكن المسافرون من التوقف للراحة واستعادة حيويتهم. أما اليوم فإن المطاعم
                            تكاد تكون في كل مكان في الشوارع الهادئة والطرق المزدحمة وفي الفنادق والمطارات ومحطات الحافات
                            والقطارات.</p>
                    </div> <!-- ./services-item -->
                </div> <!-- ./services-content -->
            </div> <!-- ./container -->
        </div> <!-- ./overlay -->
    </section> <!-- ./services -->

    <!-- Meal Categories Section -->
    <section class="meal-categories pd-y" style="padding-bottom: 0px;">
        <div class="container" style="width: 90%;">
            <aside class="categories">
                <!-- aside widget (categories) -->
                <div class="get-category">
                    <h3 class="category-title" style="font-size: 30px; margin-top:-10px;">أصناف الطعام</h3>
                    <div>
                        <?php
                                $sqlCategories = "SELECT * FROM categories";
                                $dataCategories = mysqli_query($conn, $sqlCategories);
                                
                                $sqlCountMeals = "SELECT count(id),meal_category FROM meals,categories WHERE meals.meal_category=categories.id GROUP BY meal_category";
                                $dataCountMeals = mysqli_query($conn, $sqlCountMeals);
                                if (mysqli_num_rows($dataCategories)>0) { // if there're categories then go ahead >>
                                    for ($i=0; $i < mysqli_num_rows($dataCategories); $i++) {
                                        $rowCategories=mysqli_fetch_assoc($dataCategories); // 1,2,3,4,5,6,7
                                        $sqlMeals = "SELECT * FROM meals WHERE meal_category = $rowCategories[id]"; // sql Statement will be changed depending on category id
                                        $dataMeals = mysqli_query($conn, $sqlMeals); // 1,2,3,4,5,7
                                        if (mysqli_num_rows($dataMeals)>0) { // if there're meals in each category >> print the category otherwise we don't want to print the category which doesn't have meals and that's very logical ^_^
                                            $numOfMeals = mysqli_fetch_array($dataCountMeals);
                                            // echo "<button class='category category-btn".$rowCategories['id']."' onclick='category".$rowCategories['id']."()'>$rowCategories[name]&nbsp;<span class = 'numMeals'>(";
                                            // if ($rowCategories['id'] == $numOfMeals['meal_category']) {
                                            //     echo "$numOfMeals[0])</span></button>";
                                            // }
                                            echo "<button class='category category-btn".$rowCategories['id']."' onclick='category".$rowCategories['id']."()'>$rowCategories[name]&nbsp;<span class = 'numMeals'>(".($numOfMeals[0]).")</span></button>"; // $numOfMeals[$i][0] >> [0] is the column number one in the database table which is count(id) >> this is just to count number of meals in each category
                                        }
                                    }
                                }
                            ?>
                    </div>
                </div> <!-- ./get-category -->
            </aside> <!-- ./categories -->
            <main id="main">
                <div class="lunch category1 show">
                    <?php
                            $sql = "SELECT * FROM meals WHERE meal_category = 1"; // the default category to be shown (fish and seafood)
                            $data = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($data)>0) {
                                while ($row=mysqli_fetch_assoc($data)) {
                                    echo "<div class ='lunch-item' style='margin-bottom: 20px; float:right;'>
                                    <a href='#'><img src='images/".$row['meal_image']."' alt='Potato ! :D' draggable='false'></a>
                                    <div class='lunch-item-description'>
                                    <div>
                                        <span class='meal-name'>اسم الوجبة : ".$row['meal_name']."</span>
                                        ";
                                    if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
                                        echo "<span class='meal-price'>السعر&nbsp;<del style='color:red;'>".$row['meal_price']."$</del>&nbsp;&nbsp;".($row['meal_price']-$row['meal_price']*$row['meal_discount']/100)."$</span>";
                                    } else {
                                        echo "<span class='meal-price'>السعر&nbsp;".$row['meal_price']."$</span>";
                                    }
                                    echo "
                                    </div>
                                    <br>
                                    ";
                                    if ($row['meal_type']=="discount" && $row['meal_discount']>0.00) {
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
                                </div>";
                                }
                            }
                    ?>
                </div> <!-- ./lunch -->
                <?php
                    $sqlCategories = "SELECT * FROM categories WHERE id !=1";
                    $dataCategories = mysqli_query($conn, $sqlCategories);
                    while ($rowCategories=mysqli_fetch_assoc($dataCategories)) { // 2
                        $sqlMeals = "SELECT * FROM meals WHERE meal_category = $rowCategories[id]"; // sql Statemrny will be changed depending on category id
                        $dataMeals = mysqli_query($conn, $sqlMeals);
                        if (mysqli_num_rows($dataMeals)>0) {
                            echo "<div class ='lunch category$rowCategories[id]'>";
                            while ($rowMeals=mysqli_fetch_assoc($dataMeals)) {
                                echo "<div class ='lunch-item' style='margin-bottom: 20px; float:right;'>
                                <a href='#'><img src='images/".$rowMeals['meal_image']."' alt='Potato ! :D' draggable='false'></a>
                                <div class='lunch-item-description'>
                                <div>";
                                if ($rowCategories['id']== 3) { // عصائر
                                    echo "<span class='meal-name'>اسم العصير : ".$rowMeals['meal_name']."</span>
                                    ";
                                } else {
                                    echo "<span class='meal-name'>اسم الوجبة : ".$rowMeals['meal_name']."</span>
                                    ";
                                }
                                if ($rowMeals['meal_type']=="discount" && $rowMeals['meal_discount']>0.00) {
                                    echo "<span class='meal-price'>السعر&nbsp;<del style='color:red;'>".$rowMeals['meal_price']."$</del>&nbsp;&nbsp;".($rowMeals['meal_price']-$rowMeals['meal_price']*$rowMeals['meal_discount']/100)."$</span>";
                                } else {
                                    echo "<span class='meal-price'>السعر&nbsp;".$rowMeals['meal_price']."$</span>";
                                }
                                echo "</div><br>";
                                if ($rowMeals['meal_type']=="discount" && $rowMeals['meal_discount']>0.00) {
                                    echo "<span class='availability'>يوجد خصم ".$rowMeals['meal_discount']."%</span>";
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
                                </div>";
                            }
                            echo "</div>";
                        }
                    }
                ?>
            </main>

        </div> <!-- ./container -->
    </section> <!-- ./meal-categories -->
    <!-- Map Section -->
    <section class="map">
        <span><i class="fa fa-map"></i> &nbsp; الخريطة</span>
        <div class="overlay">
            <div class="mapouter">
                <div class="gmap-canvas">
                    <iframe width="100%" height="96%" id="gmap_canvas"
                        src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <a href="https://embedgooglemap.net/124/"></a>
                </div> <!-- gmap-canvas -->
            </div> <!-- ./mapouter -->
        </div> <!-- ./overlay -->
    </section> <!-- ./map -->

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <span><i class="fa fa-phone"></i>&nbsp; اتصل بنا</span>
        <div class="container">
            <div class="contact-info">
                <h3>بيانات التواصل</h3>
                <div class="contact-item">
                    <a href="mailto:ahmedalasher22@gmail.com" target="_blank">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <a href="mailto:ahmedalasher22@gmail.com" target="_blank">ahmedalasher22@gmail.com</a>
                </div> <!-- ./contact-item -->
                <div class="contact-item">
                    <a href="tel:970-592-195200" target="_blank">
                        <i class="fa fa-phone"></i>
                    </a>
                    <a href="tel:00972-592-2195200" target="_blank">00972-59-2195200</a>
                </div> <!-- ./contact-item -->
                <div class="contact-item">
                    <a href="tel:08-2644037" target="_blank">
                        <i class="fa fa-mobile"></i>
                    </a>
                    <a href="tel:08-2644037" target="_blank">08-2644037</a>
                </div> <!-- ./contact-item -->
                <div class="contact-item">
                    <a href="https://www.instagram.com/ahmed_alashii/" target="_blank">
                        <i class="fa fa-globe"></i>
                    </a>
                    <a href="https://www.instagram.com/ahmed_alashii/"
                        target="_blank">www.instagram.com/ahmed_alashii</a>
                </div> <!-- ./contact-item -->
            </div> <!-- ./contact-info -->

            <div class="quick-links">
                <h3>روابط سريعة</h3>
                <a href="index.php"><i class="fa fa-check-circle"></i>&nbsp;الرئيسية</a>
                <a href="#services"><i class="fa fa-check-circle"></i>&nbsp;الخدمات</a>
                <a href="#meals"><i class="fa fa-check-circle"></i>&nbsp;عرض الأصناف</a>
                <a href="#r-meals"><i class="fa fa-check-circle"></i>&nbsp;الوجبات</a>
                <a href="#contact"><i class="fa fa-check-circle"></i>&nbsp;اتصل بنا</a>
            </div> <!-- ./quick-links -->
        </div> <!-- ./container -->
    </section> <!-- ./contact -->

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="footer-logo">
                <img src="images/lable3.gif" alt="This is Logo !">
                <span>جميع الحقوق محفوظة 2021.</span>
            </div> <!-- ./footer-logo -->
            <div class="social-media">
                <a href="https://www.facebook.com/AHmEDAlAsHiii/" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/ahmed_alashii" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://www.instagram.com/ahmed_alashii/" target="_blank"><i class="fa fa-instagram"></i></a>
                <a href="https://github.com/ahmedalashii" target="_blank"><i class="fa fa-github"></i></a>
                <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
            </div> <!-- ./social-media -->
        </div> <!-- ./container -->
    </footer> <!-- /footer -->
    <!-- Scroll To Top -->
    <main>
        <button class="scrollToTopBtn">☝</button>
        <!-- <button class="scrollToTopBtn"><i class="fa fa-arrow-up"></i></button> -->
    </main>
    <?php
                 $sqlCategories = "SELECT * FROM categories"; // 1,2,3,4,5,6,7
                 $dataCategories = mysqli_query($conn, $sqlCategories);
                 if (mysqli_num_rows($dataCategories)>0) { // if there're categories then go ahead >>
                     for ($i=0; $i < mysqli_num_rows($dataCategories); $i++) {
                        $rowCategories=mysqli_fetch_assoc($dataCategories); // 1 ,2 ,3, 4,5,6,7
                        $sqlMeals = "SELECT * FROM meals WHERE meal_category = $rowCategories[id]"; // sql Statement will be changed depending on category id
                        $dataMeals = mysqli_query($conn, $sqlMeals);
                         //  if (mysqli_num_rows($dataMeals)>0) {
                         echo "
                                <script>
                                    function category$rowCategories[id](){
                                        ";
                         if (mysqli_num_rows($dataMeals)!=0) {
                             $sqlCategories1 = "SELECT * FROM categories WHERE id !=$rowCategories[id]"; // 2 ,3 ,4 ,5,6, 7
                             $dataCategories1 = mysqli_query($conn, $sqlCategories1);
                             while ($rowCategories1 = mysqli_fetch_assoc($dataCategories1)) {
                                 $sqlMeals1 = "SELECT * FROM meals WHERE meal_category = $rowCategories1[id]"; // sql Statement will be changed depending on category id
                                 $dataMeals1 = mysqli_query($conn, $sqlMeals1);
                                 if (mysqli_num_rows($dataMeals1) > 0) {
                                     echo "
                                                       document.querySelector('.category$rowCategories1[id]').classList.remove('show');
                                                       document.querySelector('.category-btn$rowCategories1[id]').style.removeProperty('color');
                                                       ";
                                 }
                             }
                             echo "
                                           document.querySelector('.category$rowCategories[id]').classList.add('show');
                                           document.querySelector('.category-btn$rowCategories[id]').style.color='#821517';
                                                   }
                                               </script>
                                           ";
                         } else {
                             echo "}</script>";
                         }
                         //  }
                    //  }
                     }
                 }
            ?>
    <!-- JavaScript File -->
    <script src="../FP2/js/script.js"></script>
</body>

</html>