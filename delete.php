<?php
if(isset($_GET['id'])) {
    $postId = $_GET['id'];

    $con = mysqli_connect("localhost", "root", "", "users");
    if(!$con) {
        die(mysqli_error($con));
    }
    $query = "DELETE FROM posts WHERE id = $postId";

    if(mysqli_query($con, $query)) {
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
