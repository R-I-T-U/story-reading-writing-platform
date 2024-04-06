<?php
$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET['id'])) {
    $postId = $_GET['id'];
    $state = 2;
    $query = "UPDATE posts SET state = $state WHERE id=$postId";
    $result = mysqli_query($con, $query);
    if (!$result) {
      echo '<p style="color: red;">Sorry could not load! Try again later !</p>';
    } else {
      header('location: adpostReq.php');
    }
}