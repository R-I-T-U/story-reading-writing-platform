<?php
if (isset($_POST['search_content'])) {
    $s_content = $_POST['search_content'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Read the books you like !!</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="read.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <style>
        .navbar {
            overflow: hidden;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
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
                <input type="text" class="search-bar" value="<?php echo $s_content; ?>" name="search_content">
                <button class="search-button">Search</button>
            </div>
        </form>
        <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $con = mysqli_connect("localhost", "root", "", "users");
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $que1 = "SELECT uname, avatar, gender, bio FROM info WHERE id= $userId";
            $res1 = mysqli_query($con, $que1);
            $row = mysqli_fetch_assoc($res1);
            $uname = $row['uname'];
            $avatar = isset($row['avatar']) ? 'profileImages/' . $row['avatar'] : 'images/cat.webp';

            echo '<a href="profile.php" class="nav">  ' . $uname . '&nbsp;
            <img src="' . $avatar . '" alt="image" style="border-radius: 50%; width: 40px; height: 40px; object-fit: cover;">
            </a>';
            echo '<a onclick="confirmLogout()" class="nav">Log out</a>';
        } else if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
            echo '<a href="login.php" class="nav">Login</a>';
        } else {
            echo '<a href="register.php" class="nav">Sign up</a>';
        }
        ?>
    </div>
    <!-- content*********************************** -->


    <div class="container">

        <!-- <div class="loginHead">
            <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="60px"></a>
            <h2>Your Search Results</h2>
        </div> -->




        <?php
        $con = mysqli_connect("localhost", "root", "", "users");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        

        $query = "SELECT * FROM posts WHERE state = 1 AND title LIKE '%$s_content%'";

        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $storyTitle = $row['title'];
                $abstract = $row['abstract'];
                $genre = $row['genre'];
                // $language = $row['language'];
                $created = $row['created_at'];
                $updated = $row['updated_at'];
                $status = $row['status'];
                $id = $row['id'];
                $user_id = $row['user_id'];

                $cvrImgPath = "img/ . {$row['cover_image']}";

                $query1 = "SELECT * FROM info where id= $user_id";
                $result1 = mysqli_query($con, $query1);
                $row1 = mysqli_fetch_assoc($result1);
                $profileImgPath = !empty($row1['avatar']) ? 'profileImages/' . $row1['avatar'] : 'images/cat.webp';

                $uname = $row1['uname'];



                echo "<br>
            <div class='storie' id='post_$id' style='display:block;'>
            <div class='pp'>
                <a href='othersProfile.php?user_id=$user_id'><img src='{$profileImgPath}' alt='image' style='border-radius: 50%; width: 40px; height: 40px; object-fit: cover;'></a>
                <p>&nbsp <a href='othersProfile.php?user_id=$user_id' class='noUnderline'>$uname</a> shared a story.</p>
            </div>
            <div class='stori'>
                <div class='left'>
                    <div class='ctitle'>$storyTitle</div>
                    <div class='cdescription'>$abstract</div>
                    <div class='seemore'><a href='seemore.php?id=$id'>See full story</a></div>
                    <div class='cgenre'>Genre: $genre</div> ";

                if ($status == 'pending') {
                    echo "<div style='color:red;' class='cstatus'>Status: $status</div>";
                } else {
                    echo "<div style='color:green;' class='cstatus'>Status: $status</div>";
                };

                echo "
                    <div class='ccreate'>Created at: $created</div>
                    <div class='cupdate'>Edited at: $updated</div>
                    <br><br>
                </div>
                <div class='right'>
                    <div class='cimage'><img src='{$cvrImgPath}' alt='$storyTitle'></div>
                </div>
            </div>
        </div>";
            }
            echo "<center>
            <p id='end'>The end!!</p>
        </center>";
        } else {
            echo "<div class='storie' style='height: 40rem; display: flex; flex-direction: column; justify-content: center; align-items: center;'>
        <img src='images/nothinToShow.gif' alt='Nothing to show' style='width: 50%; max-width: 400px; height: auto;'>
        <p style='margin-top: 2rem; font-size: 2rem; text-align: center;'>
            No results found
        </p>
      </div><br>";

        }

        ?>
        <script>
            function confirmLogout() {
                if (confirm("Are you sure you want to log out?")) {
                    window.location.href = "logout.php";
                }
            }
        </script>
</body>

</html>