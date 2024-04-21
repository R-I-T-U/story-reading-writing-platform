<?php
include 'connection.php';

$que1 = "SELECT uname, avatar, gender, bio FROM info WHERE id= $userId";
$res1 = mysqli_query($con, $que1);
$row = mysqli_fetch_assoc($res1);
$uname = $row['uname'];
$avatar = isset($row['avatar']) ? 'profileImages/' . $row['avatar'] : 'images/cat.webp';
$gender = !empty($row['gender']) ? $row['gender'] : 'Not specified';
$bio = !empty($row['bio']) ? $row['bio'] : 'Not specified';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - User Profile</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="style.css">
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
        <a href="profile.php" class="nav"><?php echo $uname; ?>&nbsp;
            <img src="<?php echo $avatar; ?>" alt='image' style='border-radius: 50%; width: 40px; height: 40px; object-fit: cover;'>
        </a>
        <a onclick="confirmLogout()" class="nav">Log out</a>

    </div>

    <!-- content*********************************** -->

    <div class="container">
        <div class="img-container"></div>
        <!-- profile -->
        <form id="profileForm" action="editProfile.php" method="POST">
            <img id="profileImage" src="<?php echo $avatar; ?>" alt="Image">

            <div>
                <div class="profile-info">
                    <p id="uname">Name: <?php echo $uname; ?></p>
                    <p id="gender">Gender: <?php echo $gender; ?></p>
                    <p id="bio">Bio: <?php echo $bio; ?></p>
                    <img src="images/edit.png" alt="editImage" height="30px" id="editp" name="editp" onclick="submitForm()">
                </div>
            </div>
        </form>

        <script>
            function submitForm() {
                document.getElementById("profileForm").submit();
            }
        </script>

        <!-- profile-end -->
        <hr width="40%">

        <div class="loginHead">
            <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="70px"></a>
            <h1>Your Stories</h1>
        </div>
        <?php

        $query = "SELECT * FROM posts WHERE user_id= $userId";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $storyTitle = $row['title'];
                $abstract = $row['abstract'];
                $genre = $row['genre'];
                $created = $row['created_at'];
                $updated = $row['updated_at'];
                $status = $row['status'];
                $state = $row['state'];
                $id = $row['id'];
                $cvrImgPath = "img/ . {$row['cover_image']}";


                echo "
            <div class='stories'>
            <div class='left'>
                    <div class='ctitle'>" . $storyTitle . "</div>
                    <div class='cdescription'>" . $abstract . "</div>
                    <div class='seemore'><a href='seemore.php?id=$id'>See full story</a></div>
                    <div class='cformat'>Genre: " . $genre . "</div>
                    <div class='cformat'>Status: " . $status . "</div>
                    <div class='cformat'>Created at: " . $created . "</div>
                    <div class='cformat'>Edited at: " . $updated . "</div>";
                if ($state == 0) {
                    echo "<div class='state' style='color:grey;'>Submission state: Being reviewed</div>";
                } else if ($state == 1) {
                    echo "<div class='state' style='color:green;'>Submission state: Approved!</div>";
                } else {
                    echo "<div class='state' style='color:red;'>Submission state: Rejected!</div>";
                }
                echo "
                    <br>
                <div style='display: flex;'>
               <a href='edit.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Edit</button></div>
               </a> <br>
               <a href='delete.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Delete</button></div>
               </a>
               </div>
            </div>

                <div class='right'>
                    <div class='cimage'>
                    <a href='$cvrImgPath' target='_blank'><img src='{$cvrImgPath}' alt='{$row['title']}' '></a>
                    </div>
                </div>
            </div>";
            }
        } else {
            echo "<div class='stories'><p style='height: 10rem; font-size: 2rem;'>Nothing to show</p></div>";
        }
        ?>

        <center>
            <p id="end">The end!!</p>
        </center>

    </div>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</body>

</html>