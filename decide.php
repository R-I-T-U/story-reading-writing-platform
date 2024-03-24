<?php

$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ignore'])){
    $cid = $_POST['cid'];
    $query = "DELETE FROM noti WHERE cmt_id = $cid";
    $result = mysqli_query($con, $query);
    if($result){
        header("location: admNotification.php");
    } else{
        echo "Error: " . mysqli_error($con); 
    }

} else{
    $cid = $_POST['cid'];
    $query = "DELETE FROM noti WHERE cmt_id = $cid";
    $result = mysqli_query($con, $query);

    if($result){
        header("location: admNotification.php");
    } else{
        echo "Error: " . mysqli_error($con);
    }

    $query1 = "DELETE FROM comment WHERE cmt_id = $cid";
    $result1 = mysqli_query($con, $query1);
    if($result1){
        header("location: admNotification.php");
    } else{
        echo "Error: " . mysqli_error($con);
    }

}
mysqli_close($con);
?>