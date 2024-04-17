<?php
session_start();

if (isset($_COOKIE['user_id'])) {
  $_SESSION['user_id'] = $_COOKIE['user_id'];
}

if (isset($_SESSION["user_id"])) {
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
    <!-- <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a> -->
  </div>

  <!-- content*********************************** -->
  <center>
    <div class="form">
      <div class="loginHead">
        <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
        <h1>StorySphere</h1>
      </div>

      <form method="POST" action="register.php">
        <div>
          <label for="uname">Username:</label>
          <input type="text" id="uname" class="form-control" placeholder="Your name" name="uname" oninput="validateUname()">
          <div id="uname-error" style="color: red;"></div>
        </div> <br>
        <div>
          <label for="email">Email: </label>
          <input type="email" id="email" class="form-control" placeholder="Email Address" name="email" oninput="validateEmail()">
          <div id="email-error" style="color: red;"></div>
        </div> <br>
        <div> <label for="password">
            Password: </label>
          <input type="password" id="password" class="form-control" placeholder="Set Password" name="password" oninput="validatePw()">
          <div id="pw-error" style="color: red;"></div>
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
            $uname = mysqli_real_escape_string($con, $_POST['uname']);
            $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
            $password = mysqli_real_escape_string($con, $_POST['password']);

            $query1 = "SELECT * FROM info WHERE email = '$email'";
            $result1 = mysqli_query($con, $query1);

            $query2 = "SELECT * FROM info WHERE uname = '$uname'";
            $result2 = mysqli_query($con, $query2);
            if ($result1 && $result2) {
              $num = mysqli_num_rows($result1);
              $unum = mysqli_num_rows($result2);
              if ($num > 0) {
                echo '<p style="color: red;">User already exists! <br> Login to continue..</p>';
              } else {
                if (empty($email) || empty($password) || empty($uname)) {
                  echo '<p style="color: red;">All of above are required fields</p>';
                } else if ($unum > 0) {
                  echo '<p style="color: red;">Username must be unique</p>';
                } else if (!preg_match('/^(?![0-9])[a-zA-Z0-9\s]{0,50}$/', $uname)) {
                  echo '<p style="color: red;">Invalid Username! Only letters and numbers are allowed and name cannot start with number. </p>';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  echo '<p style="color: red;">Invalid email format! </p>';
                } else if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
                  echo '<p style="color: red;">Password must be at least 6 characters long, contain at least one capital letter, and at least one number!!</p>';
                } else {

                  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


                  $query = "INSERT INTO info (email, password, uname) VALUES ('$email', '$hashedPassword', '$uname')";
                  $result = mysqli_query($con, $query);

                  if ($result) {
                    $query1 = "SELECT * FROM info WHERE email= '$email'";
                    $result1 = mysqli_query($con, $query1);
                    $row = mysqli_fetch_assoc($result1);
                    $_SESSION['user_id'] = $row['id'];


                    if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
                      setcookie('user_id', $_SESSION['user_id'], time() + (7 * 24 * 60 * 60), '/');
                    }
                    header('location: index.php');
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
  <script>
    function validateUname() {
      var input = document.getElementById('uname');
      var Error = document.getElementById('uname-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /^(?!.*[@#$%^*~<>{}()[;.?/+=^~!',":&`\n]).*$/;
      var pattern1 = /^(?![0-9@#$%^*~<>{}()[;\n]).*$/;
      var pattern2 = /^.{0,50}$/;

      if (!pattern.test(input.value)) {
        Error.textContent = "Username cannot contain special characters.";
        input.setCustomValidity("Invalid Username");
      } else if (!pattern1.test(input.value)) {
        Error.textContent = "Username cannot begin with a number.";
        input.setCustomValidity("Invalid Username");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Username cannot exceed 50 characters.";
        input.setCustomValidity("Invalid Username");
      } else {
        Error.textContent = "";
        input.setCustomValidity("");
      }
    }

    function validateEmail() {
      var input = document.getElementById('email');
      var Error = document.getElementById('email-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /^(?!.*[#$%^*~<>{}()[;?/+=^~!',":&`\n]).*$/;
      var pattern1 = /^(?!^\.)[^0-9#$%^*~<>{}()[;\n].*$/;
      var pattern2 = /^.{0,50}$/;
      var pattern3 = /^(?:[a-zA-Z0-9._%+-]+@(?:gmail|yahoo|outlook|protonmail|icloud|aol|hotmail|mail|yandex|zoho)\.com)$/;

      if (!pattern.test(input.value)) {
        Error.textContent = "Email must not contain invalid characters.";
        input.setCustomValidity("Invalid Email");
      } else if (!pattern1.test(input.value)) {
        Error.textContent = "Email must begin with alphabets.";
        input.setCustomValidity("Invalid Email");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Email must be at most 50 characters long.";
        input.setCustomValidity("Invalid Email");
      } else if (!pattern3.test(input.value) ) {
        Error.textContent = "Invalid Email!";
        input.setCustomValidity("Invalid Email");
      } else {
        Error.textContent = "";
        input.setCustomValidity("");
      }
    }

    function validatePw() {
      var input = document.getElementById('password');
      var Error = document.getElementById('pw-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /[A-Z]/;
      var pattern1 = /[0-9]/;
      var pattern2 = /^.{6,}$/;

      if (!pattern.test(input.value)) {
        Error.textContent = "Password must contain at least 1 capital letter.";
        input.setCustomValidity("Invalid Password");
      } else if (!pattern1.test(input.value)) {
        Error.textContent = "Password must contain at least 1 number.";
        input.setCustomValidity("Invalid Password");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Password must be at least 6 characters long.";
        input.setCustomValidity("Invalid Password");
      } else {
        Error.textContent = "";
        input.setCustomValidity("");
      }
    }

  
  </script>
</body>

</html>