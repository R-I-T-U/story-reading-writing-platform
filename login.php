<?php
// session_start();
$con = mysqli_connect("localhost", "root", "", "users");

if (!$con) {
    die(mysqli_error($con));
}
// if (isset($_COOKIE['user_id'])) {
//   $_SESSION['user_id'] = $_COOKIE['user_id'];
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>StorySphere - Login here</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="sign.css">
  <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
  <style>
    .form{
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

    <?php
    // Check if the user is logged in (session or cookie exists)
    if (isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
        echo '<a href="profile.php" class="nav">Profile</a>';
    } else {
        echo '<a href="register.php" class="nav">Login</a>';
    }
    ?>

    <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a>
  </div>


  <!-- content*********************************** -->
  <center>
    <div class="form" method="POST" action="login.php">
      <div class="loginHead">
        <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
        <h1>StorySphere</h1>
      </div>
      <form method="POST" action="login.php">
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
          <button type="submit" class="submit" name="submit">Login</button>
        </div>
        <div>
          <p><a href="forgot.php">Forgot your password ?</a>
            <div class="or">
              <p>OR</p>
            </div>
            <p>DON'T HAVE AN ACCOUNT?</p>
            <button class="create"><a href="register.php">CREATE NEW ACCOUNT</a></button>
          </p>

          <?php
          if(isset($_POST['submit'])){
            $email= filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $password= $_POST['password'];

            $query1 = "SELECT * FROM info WHERE email= '$email' AND password= '$password'";
            $result1 = mysqli_query($con , $query1);
            $count =  mysqli_num_rows($result1);
            
            if($count > 0){
              header("location: index.php");
            } else {
              echo "<p style='color: red'> Invalid email or Incorrect password!!!</p>";
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
