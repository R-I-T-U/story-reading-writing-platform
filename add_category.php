<?php
$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['submit'])){
    $category = mysqli_real_escape_string($con,$_POST['category_name']);

    $query1 = "SELECT * FROM genre WHERE g_name='$category'";
    $result1= mysqli_query($con, $query1);
    if(mysqli_num_rows($result1)>0){
        echo "<script>
        alert('This category already exist!');
        window.location='category.php';
        </script>";
    }else{
    $query = "INSERT INTO genre (g_name) VALUES('$category')";
    $result = mysqli_query($con, $query);

    if ($result) {
        header('location:category.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }
    }

    

    mysqli_close($con);
}
?>
