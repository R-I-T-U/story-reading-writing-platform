<?php
session_start();

if (isset($_COOKIE['user_id'])) {
  $_SESSION['user_id'] = $_COOKIE['user_id'];
}

if(isset($_SESSION["user_id"])){
  header("location: profile.php");
  exit();

}
$con = mysqli_connect("localhost", "root", "", "users");

if (!$con) {
    die(mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>StorySphere - Sign up here</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="sign.css">
  <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
  <style>
    .form {
      background-color: rgba(255, 255, 255, 0.9);
    }
  </style>
</head>

<body>
  <!-- navbar*********************************** -->
  <div class="navbar">
    <a href="read.php" class="nav">Read</a>
    <a href="write.php" class="nav">Write</a>
    <div class="search-container">
      <input type="text" class="search-bar" placeholder="Search...">
      <button class="search-button">Search</button>
    </div>
    <a href="register.php" class="nav">Sign up</a>
    <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a>
  </div>

  <!-- content*********************************** -->
  <center>
    <div class="form" action="register.php" method="POST">
      <div class="loginHead">
        <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
        <h1>StorySphere</h1>
      </div>

      <form method="POST" action="">
        <div>
          <label for="email">Email: </label>
          <input type="email" id="email" class="form-control" placeholder="Email Address" name="email">
        </div> <br>
        <div> <label for="password">
            Password: </label>
          <input type="password" id="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div>
          <div class="custom-control custom-checkbox"><br>
            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me">
            <label class="custom-control-label" for="remember_me">Remember me</label>
          </div>

        </div>
        <div>
          <button type="submit" class="submit" name="submit">Sign Up</button>
        </div>
        <div>
          <div class="or">
            <p>OR</p>
          </div>

          <!-- <button class="google">SIGN UP WITH GOOGLE</button>
          <button class="facebook">SIGN UP WITH FACEBOOK</button> -->
          <p>ALREADY HAVE AN ACCOUNT?</p>
          <button class="create" formaction="login.php">LOGIN HERE</button>
          
          <!-- ............................................................................php code  -->

          <?php

        if (isset($_POST['submit'])) {

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 

            $password = $_POST['password'];

            $query1= "SELECT * FROM info WHERE email = '$email'";
            $result1 = mysqli_query($con, $query1);
            if($result1){
              $num= mysqli_num_rows($result1);
              if($num>0){
                echo '<p style="color: red;">User already exists! <br> Login to continue..</p>';
              } else{
                if (empty($email) || empty($password)) {
                  echo '<p style="color: red;">Email and password are required fields</p>';
                
                  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  echo '<p style="color: red;">Invalid email format! </p>';
                  } else if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
                  echo '<p style="color: red;">Password must be at least 6 characters long, contain at least one capital letter, and at least one number!!</p>';
                  
                 } else {
                 
                 $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      
                 $query = "INSERT INTO info (email, password) VALUES ('$email', '$hashedPassword')";
      
                 $result = mysqli_query($con, $query);
      
                
                 if ($result) {
                  $row = mysqli_fetch_assoc($result1);                  
                  $_SESSION['user_id'] = $row['id'];
                  
            
                  if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
                    setcookie('user_id', $_SESSION['user_id'], time() + (7 * 24 * 60 * 60), '/');
                }
                header('location: login.php'); 
                exit();
              } else {
                echo "Error!! Please try again later" . mysqli_error($con);
          }
          }
      }
      }
 }
 mysqli_close($con);
      ?>
      </form>
      </p>
    </div>
  </center>

</body>

</html>