<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header("location: register.php");
  exit();
} else{
  $userId = $_SESSION['user_id'];
}
$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>