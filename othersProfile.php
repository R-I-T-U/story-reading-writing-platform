<?php
include 'connection.php';
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
        <a href="profile.php" class="nav">Profile</a>
        <a onclick="confirmLogout()" class="nav">Log out</a>

    </div>

    <!-- content*********************************** -->

    <div class="container">
        <?php
        if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];

            if($user_id == $userId){
                header('location:profile.php');
                exit();
            }
            $que1 = "SELECT uname, avatar, gender, bio FROM info WHERE id= $user_id";
        $res1 = mysqli_query($con, $que1);
        $row = mysqli_fetch_assoc($res1);
        $uname = $row['uname'];
        $avatar = isset($row['avatar']) ? 'profileImages/' . $row['avatar'] : 'images/ppp.png';
        $gender = !empty($row['gender']) ? $row['gender'] : 'Not specified';
        $bio = !empty($row['bio']) ? $row['bio'] : 'Not specified';



        }
        
        ?>
        <div class="img-container"></div>
        <!-- profile -->
            <a href="<?php echo $avatar; ?>"><img id="profileImage" src="<?php echo $avatar; ?>" alt="Image"></a>

            <div>
                <div class="profile-info">
                    <p id="uname">Name: <?php echo $uname; ?></p>
                    <p id="uname">Gender: <?php echo $gender; ?></p>
                    <p id="uname">Bio: <?php echo $bio; ?></p>
                </div>
            </div>

        

        <!-- profile-end -->
        <hr width="40%">

        <div class="loginHead">
            <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="70px"></a>
            <h1><?php echo $uname."'s"; ?> stories</h1>
        </div>
        <?php

        $query = "SELECT * FROM posts WHERE user_id= $user_id";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $storyTitle = $row['title'];
                $abstract = $row['abstract'];
                $genre = $row['genre'];
                $created = $row['created_at'];
                $updated = $row['updated_at'];
                $status = $row['status'];
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
                    <div class='cformat'>Edited at: " . $updated . "</div>

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