<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['add'])) {

$cmt = $_POST['cmt'];
$pid = $_SESSION['postId'] ;

$query = "INSERT INTO comment (cmt, post_id, user_id) VALUES ('$cmt', $pid, $userId)";

$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error: " . mysqli_error($con);
} else {
    echo "<script>alert('Comment added succesfully!'); 
            window.location='read.php';</script>";
}

}

mysqli_close($con);

?>