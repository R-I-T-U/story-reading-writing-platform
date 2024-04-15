<?php
$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
    die(mysqli_error($con));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>StorySphere - Login here</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sign.css">
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <style>
        .form {
            background-color: rgba(255, 255, 255, 0.9);
        }

        #password {
            width: 64%;
        }

        #email {
            margin-left: 0%;
            width: 80%;
        }

        #confirm {
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="read.php" class="nav">Read</a>
        <a href="write.php" class="nav">Write</a>
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Search...">
            <button class="search-button">Search</button>
        </div>
        <a href="login.php" class="nav">Login</a>
        <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a>
    </div>

    <center>
        <div class="form">
            <div class="loginHead">
                <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
                <h1>StorySphere</h1>
            </div>
            <form method="POST" action="forgot.php">
                <div>
                    <label for="email">Email: </label>
                    <input type="email" id="email" class="form-control" placeholder="Email Address" name="email" oninput="validateEmail()">
                    <div id="email-error" style="color: red;"></div>
                </div><br>
                <div>
                    <label for="password">New Password: </label>
                    <input type="password" id="password" class="form-control" placeholder="Password" name="password1" oninput="validatePw()">
                </div><br>
                <div>
                    <label for="confirm">Confirm new Password: </label>
                    <input type="password" id="confirm" class="form-control" placeholder="Confirm Password" name="password2">
                    <div id="pw-error" style="color: red;"></div>
                </div>
                <div>
                    <div class="custom-control custom-checkbox"><br>
                        <input type="checkbox" class="custom-control-input" id="remember_me">
                        <label class="custom-control-label" for="remember_me">Remember me</label>
                    </div><br>
                </div>
                <div>
                    <button type="submit" class="submit" name="submit">Login</button>
                </div>
                <p>OR</p>
                <button class="create" formaction="login.php">Back</button>

          
                <?php
                if (isset($_POST['submit'])) {
                    $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
                    // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    // $password1 = $_POST['password1'];
                    $password1 = mysqli_real_escape_string($con, $_POST['password1']);
                    $password2 = mysqli_real_escape_string($con, $_POST['password2']);

                    $query1 = "SELECT * FROM info WHERE email = '$email'";
                    $result1 = mysqli_query($con, $query1);

                    $count = mysqli_num_rows($result1);
                    
                    if ($count > 0) {
                        if (strlen($password1) < 6 || !preg_match('/[A-Z]/', $password1) || !preg_match('/[0-9]/', $password1)) {
                            echo '<p style="color: red;">Password must be at least 6 characters long, contain at least one capital letter, and at least one number!!</p>';
                        } else if ($password1 != $password2) {
                            echo "<p style='color:red;'>Password mismatch!</p>";
                        } else {
                            // echo "<p style='color:green;'>Password changed! Login to continue...</p>";
                            $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                            $query2 = "UPDATE info SET password = '$hashedPassword' WHERE email = '$email'";
                            $result2 = mysqli_query($con, $query2);
                            if ($result2) {
                                header("Location: login.php");
                                exit();
                            } else {
                                echo "<p style='color:red;'>Error updating password!</p>";
                            }
                        }
                    } else {
                        if (empty($email) || empty($password) || empty($uname)) {
                            echo '<p style="color: red;">All of above are required fields</p>';
                          }else{
                            echo "<p style='color:red;'>Email not registered!</p>";
                          }
                        
                    }
                }
                mysqli_close($con);
                ?>
            </form>
        </div>
    </center>
    <script>
        function validateEmail() {
      var input = document.getElementById('email');
      var Error = document.getElementById('email-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /^(?!.*[#$%^*~<>{}()[;?/+=^~!',":&`\n]).*$/;
      var pattern1 = /^(?![0-9#$%^*~<>{}()[;\n]).*$/;
      var pattern2 = /^.{0,50}$/;

      if (!pattern.test(input.value)) {
        Error.textContent = "Email must not contain invalid characters.";
        input.setCustomValidity("Invalid Email");
      } else if (!pattern1.test(input.value)) {
        Error.textContent = "Email cannot begin with a number.";
        input.setCustomValidity("Invalid Email");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Email must be at most 50 characters long.";
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
