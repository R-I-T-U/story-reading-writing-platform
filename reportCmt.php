<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['report'])) {
    include 'connection.php';

    $cmtId = $_POST['cmt_id'];
    $userId = $_SESSION['user_id'];
    $pid = $_SESSION['postId'];

    $query1 = "SELECT * FROM comment WHERE cmt_id = $cmtId";
    $result1 = mysqli_query($con, $query1);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $cmt = $row['cmt'];

        $que = "INSERT INTO noti (cmt_id, cmt, postId, userId) VALUES ('$cmtId', '$cmt', '$pid', '$userId')";
        $res = mysqli_query($con, $que);

        if (!$res) {
            echo "Error: " . mysqli_error($con);
        } else {
            echo "<script>alert('Comment reported succesfully!'); 
            window.location='viewChap.php';</script>";
        }
    } else {
        echo "Error: Comment not found.";
    }
} else {
    echo "Invalid request.";
}
?>