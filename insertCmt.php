<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $cmt = mysqli_real_escape_string($con, $_POST['cmt']);

    // $cmt = $_POST['cmt'];
    $id = $_SESSION['postId'];
    if (empty($cmt)) {
        echo '<script>alert("Empty comment!!");</script>';
        header("location: seemore.php?id=$id");
    } else {

        $query = "INSERT INTO comment (cmt, post_id, user_id) VALUES ('$cmt', $id, $userId)";

        $result = mysqli_query($con, $query);

        if (!$result) {
            echo "Error: " . mysqli_error($con);
        } else {
            header("location: seemore.php?id=$id");
        }
    }
}

mysqli_close($con);
