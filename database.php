<?php
  // This Database Page is Completely By Ahmed Hesham Alashi 120191156 and Mohammed Abo Sido 120192308
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
    header("location: 404.php");
    // die("Connection failed: " . mysqli_connect_error());
}
?>