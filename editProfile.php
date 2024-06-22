<?php
include 'connection.php';

$query = "SELECT * FROM info WHERE id=$userId";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$uname = $row['uname'];
$email = $row['email'];
$gender = $row['gender'];
$bio = $row['bio'];
$oldImage = $row['avatar'];
$avatar = isset($row['avatar']) ? 'profileImages/' . $row['avatar'] : 'images/cat.webp';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>StorySphere - Edit User Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sign.css">
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <style>
        body {
            background: rgb(192, 192, 192);
        }

        .form {
            width: 500px;
        }

        .form {
            background-color: rgba(255, 255, 255, 0.9);
        }

        #image-preview img {
            height: 250px;
            object-fit: cover;
            margin-top: 10px;
            width: 250px;

            width: 200px;
            height: 200px;
            border-radius: 50%;
            z-index: 1;
        }
    </style>
</head>

<body>
    <!-- navbar*********************************** -->
    <div class="navbar">
        <a href="read.php" class="nav">Read</a>
        <a href="write.php" class="nav">Write</a>
        <form action="search_result.php" method="POST">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search..." name="search_content">
                <button class="search-button">Search</button>
            </div>
        </form>
        <a href="profile.php" class="nav"><?php echo $uname; ?>&nbsp;
            <img src="<?php echo $avatar; ?>" alt='image' style='border-radius: 50%; width: 40px; height: 40px; object-fit: cover;'>
        </a>
        <a onclick="confirmLogout()" class="nav">Log out</a>
    </div>

    <!-- content*********************************** -->
    <center>
        <div class="form">
            <div class="loginHead">
                <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
                <h1>Edit your profile</h1>
            </div>

            <form method="POST" action="editProfile.php" enctype="multipart/form-data">
                <label for="image">Add Profile Image: <input type="file" name="profileImage" id="image" accept="image/*" onchange="previewImage(event)"></label>
                <div id="image-preview"></div><br><br>
                <div>
                    <label for="uname">Username:</label>
                    <input type="text" id="uname" class="form-control" name="uname" value="<?php echo $uname; ?>" required oninput="validateUname()">
                    <div id="uname-error" style="color: red;"></div>
                </div>

                <br>
                <div>
                    <label for="email">Email: </label>
                    <input type="email" id="email" class="form-control" name="email" value="<?php echo $email; ?>" oninput="validateEmail()" required>
                    <div id="email-error" style="color: red;"></div>
                </div>
                <br>
                <div>
                    <label for="gender">Gender: </label>
                    <?php
                    if ($gender == 'male') {
                        echo "<input type='radio' name='gender' value='male' checked> Male
                        <input type='radio' name='gender' value='female'> Female 
                        <input type='radio' name='gender' value='Not specified'> Rather not say";
                    } else if ($gender == 'female') {
                        echo "<input type='radio' name='gender' value='male'> Male
                        <input type='radio' name='gender' value='female' checked> Female 
                        <input type='radio' name='gender' value='Not specified'> Rather not say ";
                    } else {
                        echo "<input type='radio' name='gender' value='male'> Male
                        <input type='radio' name='gender' value='female'> Female 
                        <input type='radio' name='gender' value='Not specified' checked> Rather not say ";
                    }

                    ?>
                </div> <br>
                <div>
                    <label for="bio">Bio: </label>
                    <input type="text" id="bio" class="form-control" name="bio" value="<?php echo $bio; ?>" oninput="validateBio()">
                    <div id="bio-error" style="color: red;"></div>
                </div> <br>

                <div>
                    <button type="submit" class="submit" name="submit">Edit</button>
                </div>

            </form>
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

                $oldImageSrc = "profileImages/" . $oldImage;
                $uname = mysqli_real_escape_string($con, $_POST['uname']);

                $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

                $avatar = $_FILES['profileImage']['name'];
                $bio = mysqli_real_escape_string($con, $_POST['bio']);
                $gender = $_POST['gender'];

                $accCheck = "SELECT * FROM info WHERE (email = '$email' OR uname='$uname') AND id != $userId";
                $result_1 = $con->query($accCheck);

                if ($result_1->num_rows > 0) {
                    echo '<p style="color: red;">Username or email already exists! </p>';
                } else {
                    if (empty($email) || empty($uname)) {
                        echo '<p style="color: red;">Email and Name are required fields</p>';
                    } else if (!preg_match('/^(?![0-9])[a-zA-Z0-9\s]{0,50}$/', $uname)) {
                        echo '<p style="color: red;">Invalid Username! Only letters and numbers are allowed and name can not start with number </p>';
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo '<p style="color: red;">Invalid email format! </p>';
                    } else {

                        if (!empty($avatar)) {
                            $avatar_tmp = $_FILES['profileImage']['tmp_name'];
                            $avatar_path = 'profileImages/' . $avatar;
                            $query = "UPDATE info SET uname='$uname', email='$email', avatar='$avatar', bio='$bio', gender='$gender' WHERE id=$userId";
                            $result = mysqli_query($con, $query);

                            if ($result) {
                                if (isset($oldImage) && !empty($oldImage)) {
                                    unlink($oldImageSrc);
                                }
                                move_uploaded_file($avatar_tmp, $avatar_path);
                                header("Location: profile.php");
                                exit();
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }
                        } else {
                            $query = "UPDATE info SET uname='$uname', email='$email', bio='$bio', gender='$gender' WHERE id=$userId";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                                header("Location: profile.php");
                                exit();
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }
                        }
                    }
                }
            }

            ?>
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
                Error.textContent = "Usernames cannot contain special characters.";
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
            var pattern1 = /^(?![0-9#$%^*~<>{}()[;\n]).*$/;
            var pattern2 = /^.{0,50}$/;
            var pattern3 = /^(?:[a-zA-Z0-9._%+-]+@(?:gmail|yahoo)\.com)$/;
            if (!pattern.test(input.value)) {
                Error.textContent = "Email must not contain invalid characters.";
                input.setCustomValidity("Invalid Email");
            } else if (!pattern1.test(input.value)) {
                Error.textContent = "Email must begin with alphabets.";
                input.setCustomValidity("Invalid Email");
            } else if (!pattern2.test(input.value)) {
                Error.textContent = "Email must be at most 50 characters long.";
                input.setCustomValidity("Invalid Email");
            } else if (!pattern3.test(input.value)) {
                Error.textContent = "Invalid Email!";
                input.setCustomValidity("Invalid Email");
            } else {
                Error.textContent = "";
                input.setCustomValidity("");
            }
        }

        function validateBio() {
            var input = document.getElementById('bio');
            var Error = document.getElementById('bio-error');

            // Regular expression pattern for alphanumeric characters only
            var pattern = /^(?!.*[@$%^*~\n]).*$/;
            var pattern1 = /^(?![0-9@$%^*~\n]).*$/;
            var pattern2 = /^.{0,100}$/;

            if (!pattern.test(input.value)) {
                Error.textContent = "Bio cannot contain some special characters and one line spaces.";
                input.setCustomValidity("Invalid Bio");
            } else if (!pattern1.test(input.value)) {
                Error.textContent = "Bio cannot begin with a number.";
                input.setCustomValidity("Invalid Bio");
            } else if (!pattern2.test(input.value)) {
                Error.textContent = "Bio must be at most 50 characters long.";
                input.setCustomValidity("Invalid Bio");
            } else {
                Error.textContent = "";
                input.setCustomValidity("");
            }
        }

        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('image-preview');
            // Ensure that a file was selected
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Set the source of the image to the data URL
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Selected Image">';
                };
                // Read the selected file as a data URL
                reader.readAsDataURL(input.files[0]);
            } else {
                // Clear the preview if no file was selected
                preview.innerHTML = '';
            }
        }

        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</body>

</html>