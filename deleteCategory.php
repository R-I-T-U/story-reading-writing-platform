<?php
$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['deleteCategory'])){
    $g_id = $_POST['g_id'];
    $query = "DELETE FROM genre WHERE g_id= $g_id";
    $result= mysqli_query($con, $query);
    if($result){
        header('location: category.php');
        exit();
    } else{
        echo "<script>
        alert('Unable to delete!');
        window.location='category.php';
        </script>";
    }

}