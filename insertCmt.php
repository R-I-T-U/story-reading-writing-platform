<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['add'])) {

$cmt = $_POST['cmt'];
$id = $_SESSION['postId'] ;

$query = "INSERT INTO comment (cmt, post_id, user_id) VALUES ('$cmt', $id, $userId)";

$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error: " . mysqli_error($con);
} else {
   header("location: seemore.php?id=$id");
}

}

mysqli_close($con);

?>