<?php
include 'connection.php';

    $query = "SELECT * FROM info WHERE id=$userId";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $uname = $row['uname'];
    $email = $row['email'];
    $gender = $row['gender'];
    $bio = $row['bio'];

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
            ;
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
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Search...">
            <button class="search-button">Search</button>
        </div>
        <a href="profile.php" class="nav">Profile</a>
        <a onclick="confirmLogout()" class="nav">Log out</a>
    </div>

    <!-- content*********************************** -->
    <center>
        <div class="form">
            <div class="loginHead">
                <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
                <h1>Edit your profile</h1>
            </div>
            
            <form method="POST" action="confromProfile.php" enctype="multipart/form-data">
                <label for="image">Add Profile Image: <input type="file" name="profileImage" id="image" accept="image/*" onchange="previewImage(event)" ></label>
                <div id="image-preview"></div><br><br>
                <div>
                    <label for="uname">Username:</label>
                    <input type="text" id="uname" class="form-control" name="uname" value="<?php echo $uname; ?>" required>
                </div> <br>
                <div>
                    <label for="email">Email: </label>
                    <input type="email" id="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div> <br>
                <div>
                    <label for="gender">Gender: </label>
                    <?php
                    if($gender == 'male'){
                        echo "<input type='radio' name='gender' value='male' checked> Male
                        <input type='radio' name='gender' value='female'> Female 
                        <input type='radio' name='gender' value='Not specified'> Rather not say";
                    } else if($gender == 'female'){
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
                    <input type="text" id="email" class="form-control" name="bio" value="<?php echo $bio; ?>">
                </div> <br>

                <div>
                    <button type="submit" class="submit" name="submit">Edit</button>
                </div>

            </form>

        </div>
    </center>

    <script>
        
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