<?php
// session_start();
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
        <div class="form" method="POST" action="forgot.php">
            <div class="loginHead">
                <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
                <h1>StorySphere</h1>
            </div>
            <form method="POST" action="forgot.php">
                <div>
                    <label for="email">Email: </label>
                    <input type="email" id="email" class="form-control" placeholder="Email Address" name="email">
                </div><br>
                <div>
                    <label for="password">New Password: </label>
                    <input type="password" id="password" class="form-control" placeholder="Password" name="password1">
                </div><br>
                <div>
                    <label for="confirm">Confirm new Password: </label>
                    <input type="password" id="confirm" class="form-control" placeholder="Confirm Password" name="password2">
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
                <a href="register.php"><button class="create">Back</button></a>





                
                <?php
                if (isset($_POST['submit'])) {
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $password1 = $_POST['password1'];
                    $password2 = $_POST['password2'];

                    $query1 = "SELECT * FROM info WHERE email = '$email'";
                    $result1 = mysqli_query($con, $query1);

                    $count = mysqli_num_rows($result1);

                    if ($count > 0) {
                        if (strlen($password1) < 6 || !preg_match('/[A-Z]/', $password1) || !preg_match('/[0-9]/', $password1)) {
                            echo '<p style="color: red;">Password must be at least 6 characters long, contain at least one capital letter, and at least one number!!</p>';
                        } else if ($password1 != $password2) {
                            echo "<p style='color:red;'>Password mismatch!</p>";
                        } else {
                            $query2 = "UPDATE info SET password = '$password1' WHERE email = '$email'";
                            $result2 = mysqli_query($con, $query2);
                            if ($result2) {
                                header("Location: index.php");
                                exit();
                            } else {
                                echo "<p style='color:red;'>Error updating password!</p>";
                            }
                        }
                    } else {
                        echo "<p style='color:red;'>Email not registered!</p>";
                    }
                }
                mysqli_close($con);
                ?>
            </form>
        </div>
    </center>
</body>
</html>
