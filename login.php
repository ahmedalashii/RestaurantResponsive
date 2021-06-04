<?php
  // This Login Page is Completely By Ahmed Hesham Alashi 120191156 and Mohammed Abo Sido 120192308
  include "database.php";
  session_start();
  if (isset($_SESSION['admin'])) {
      header("location: admin/dashboard.php");
  } elseif (isset($_SESSION['user'])) {
      header("location: index.php");
  }
    if (isset($_POST['login'])) {
        if (!empty($_POST['username']) && !empty($_POST['password'])) { // all fields should be filled
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM admin_info WHERE username= '$username' AND pass= '$password'";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data)>0) { // if there's data inside the table >> then do somthing which is validation if the login status was for admin of for a normal user
                while ($row=mysqli_fetch_assoc($data)) {
                    $dbusername = $row['username'];
                    $dbpassword = $row['pass'];
                }
                if ($username == $dbusername && $password == $dbpassword) {
                    session_start();
                    $_SESSION['admin']= $username;
                    rememberingMe($username,$password);
                    /* Redirect Browser Page */
                    header("location: admin/dashboard.php");
                }
            }
            if (mysqli_num_rows($data) == 0 || ($username!=$dbusername && $password !=$dbpassword)) {
                $sql = "SELECT * FROM user_info WHERE username= '$username' AND pass= '$password'";
                $data = mysqli_query($conn,$sql);
                if (mysqli_num_rows($data)>0) {
                    while($row=mysqli_fetch_assoc($data)){
                        $dbusername = $row['username'];
                        $dbpassword = $row['pass'];
                    }
                    if ($username==$dbusername && $password==$dbpassword) {
                        session_start();
                        $_SESSION['user']= $username;
                        rememberingMe($username,$password);
                        /* Redirect Browser Page */
                        header("location: index.php");
                    }
                }else{
                    echo "Invalid username/password";
                }
            }
        } else {
            echo "All Fields are Required!";
        }
    }
    function rememberingMe($username,$password){
        if (isset($_POST['remember'])) {
            setcookie('username', $username, time()+7200); // for two hours >> just for example we can change it
            setcookie('password', $password, time()+86400); // for one day (24 hours * 60 * 60)
        }        
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/login.png">
    <title>مطعم الحنيذ التراثي</title>
    <!-- Arabic Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="images/login.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                            </div>
                            <p class="login-card-description"> دخول في مطعم الحنيذ التراثي</p>
                            <form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
                                <div class="form-group">
                                    <label for="username" class="sr-only">اسم المستخدم</label>
                                    <input type="username" name="username" id="username" class="form-control"
                                        placeholder="اسم المستخدم">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">كلمة المرور </label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="***********">
                                    <div class="custom-control custom-checkbox login-card-check-box">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                                        <label class="custom-control-label" for="customCheck1">تذكرني</label>
                                    </div>
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit"
                                    value="دخول">
                            </form>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>