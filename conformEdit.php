<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("location: register.php");
  exit();
} else {
  $userId = $_SESSION['user_id'];
}
$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
  die(mysqli_error($con));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['done'])) {

  $postId = $_POST['postId'];

  $query1 = "SELECT * FROM posts WHERE user_id=$userId AND id=$postId";
  $result1 = mysqli_query($con, $query1);
  $row = mysqli_fetch_assoc($result1);
  $oldImage = $row['cover_image'];
  $oldImageSrc = "img/ . $oldImage";
  $postid = $row['id'];


  $storyTitle = mysqli_real_escape_string($con, $_POST['storyTitle']);
  $abstract = mysqli_real_escape_string($con, $_POST['abstract']);
  $description = mysqli_real_escape_string($con, $_POST['description']);
  // $storyTitle = $_POST['storyTitle'];

  // $abstract = $_POST['abstract'];
  $genre = $_POST['genre'];
  // $language = $_POST['language'];
  $status = $_POST['status'];
  // $description = $_POST['description'];
  $postId = $_POST['postId'];

  if(!empty($_FILES['coverImage']['name'])){
    $newImage = $_FILES['coverImage']['name'];
    $newImage_temp_name = $_FILES['coverImage']['tmp_name'];
    $newImage_Folder = "img/ . $newImage";
    $state = 0;
    // $DestiPath = "img/ . $newImage";


    $query = "UPDATE posts SET cover_image='$newImage',title='$storyTitle',abstract='$abstract', description='$description',genre='$genre',status='$status', updated_at = NOW(), state = $state WHERE user_id=$userId AND id=$postId";

  $result = mysqli_query($con, $query);
  if (!$result) {
    echo '<p style="color: red;">Sorry could not load! Try again later !</p>';
  } else {
    unlink($oldImageSrc);
    move_uploaded_file($newImage_temp_name, $newImage_Folder);
    header('location: profile.php');
  }
  
  } else{
    $state = 0;
    $query = "UPDATE posts SET title='$storyTitle',abstract='$abstract', description='$description',genre='$genre',status='$status', updated_at = NOW(), state = $state WHERE user_id=$userId AND id=$postId";

  $result = mysqli_query($con, $query);
  if (!$result) {
    echo '<p style="color: red;">Sorry could not load! Try again later !</p>';
  } else{
    header('Location: profile.php');
  }
  }
  mysqli_close($con);
} else if (isset($_POST['cancel'])) {
  header('Location: profile.php');
  exit;
}
