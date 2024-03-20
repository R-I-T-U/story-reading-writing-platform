<?php
include 'connection.php';

if (isset($_GET['post_id']) && isset($_GET['comment'])) {
    $postId = $_GET['post_id'];
    $comment = $_GET['comment'];
    echo $postId;
    // Sanitize input to prevent SQL injection
    $postId = mysqli_real_escape_string($con, $postId);
    $comment = mysqli_real_escape_string($con, $comment);

    // Insert comment into the database
    $insertQuery = "INSERT INTO comments (post_id, cmt, user_id) VALUES ($postId, '$comment',$userId)";
    mysqli_query($con, $insertQuery);
    
    // Redirect back to the page where the comment was made
    header("Location: read.php");
    exit();
} else {
    // Redirect to the home page if accessed directly
    header("Location: index.php");
    exit();
}
?>
