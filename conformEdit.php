<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("location: register.php");
    exit();
  } else{
    $userId = $_SESSION['user_id'];
  }
$con = mysqli_connect("localhost", "root", "", "users");
if(!$con) {
    die(mysqli_error($con));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['done'])) {
  $postid = $row['id'];

    $newImage = $_FILES['coverImage']['name'];
    $newImage_temp_name = $_FILES['coverImage']['tmp_name'];
    $newImage_Folder = "img/ . $newImage";

    $DestiPath = "img/ . $newImage";
$storyTitle = $_POST['storyTitle'];
$description = $_POST['description'];
$postId=$_POST['postId'];
$genre = $_POST['genre'];
$format = $_POST['format'];

    $query1 = "SELECT * FROM posts WHERE user_id=$userId AND id=$postId";
    $result1 = mysqli_query($con, $query1);
    $row= mysqli_fetch_assoc($result1);
    $oldImage= $row['cover_image'];
    $oldImageSrc = "img/ . $oldImage";

    

$query = "UPDATE posts SET cover_image='$newImage',title='$storyTitle', description='$description',genre='$genre',format='$format', updated_at = NOW() WHERE user_id=$userId AND id=$postId";

$result = mysqli_query($con, $query);
if(!$result){
  echo '<p style="color: red;">Sorry could not load! Try again later !</p>';
} else{
    unlink($oldImageSrc);
    move_uploaded_file($newImage_temp_name,$newImage_Folder);
  header('location: profile.php');
}

    mysqli_close($con);
} 
else if (isset($_POST['cancel'])) {
    header('Location: profile.php');
    exit;
}

