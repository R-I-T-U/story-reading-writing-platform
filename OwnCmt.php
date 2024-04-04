<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {

    $cmtId = $_POST['cmtId'];
    $id = $_SESSION['postId'];

    $query = "DELETE FROM comment WHERE user_id = $userId AND post_id = $id AND cmt_id = $cmtId"; 

    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "Error deleting comment: " . mysqli_error($con);
    } else {
        header("location: seemore.php?id=$id");
    }
}

mysqli_close($con);
?>
