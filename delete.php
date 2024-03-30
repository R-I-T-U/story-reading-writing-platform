<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header("location: register.php");
  exit();
} else{
  $userId = $_SESSION['user_id'];
}


if(isset($_GET['id'])) {
    $postId = $_GET['id'];

    $con = mysqli_connect("localhost", "root", "", "users");
    if(!$con) {
        die(mysqli_error($con));
    }
    $query1 = "SELECT * FROM posts WHERE user_id= $userId and id = $postId";
    $result1=mysqli_query($con, $query1);
    $row = mysqli_fetch_assoc($result1);

    $query = "DELETE FROM posts WHERE id = $postId";
    // $query2 = "DELETE FROM chapter WHERE post_id = $postId";
    // $result2 = mysqli_query($con, $query2);
    $query4 = "DELETE FROM noti WHERE postId = $postId";
    $result4 = mysqli_query($con, $query4);
    $query3 = "DELETE FROM comment WHERE post_id = $postId";
    $result3 = mysqli_query($con, $query3);
    
    
    
    if(mysqli_query($con, $query)) {
        $cvrImgPath = "img/ . {$row['cover_image']}";
        unlink($cvrImgPath);
        header("Location: profile.php");

        exit();
    } else {
        echo "Error deleting post: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "Post ID not specified";
}

?>
