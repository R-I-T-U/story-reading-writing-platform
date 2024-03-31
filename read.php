<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Read the books you like !!</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <style>
        .navbar {
            overflow: hidden;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);

        }

        main {
            margin: 20px;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .storie {
            background-color: white;
            z-index: 1;
            margin-bottom: 20px;
            margin-left: 20px;
            margin-right: 20px;
            padding: 10px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);

        }

        .storie img {
            height: 250px;
            width: 250px;
            display: block;
            position: relative;
            z-index: 1;

        }

        .stori {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pp{
            display: flex;
            justify-content: flex-start;
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
        session_start();
        if (isset($_SESSION['user_id'])) {
            echo '<a href="profile.php" class="nav">Profile</a>';
            echo '<a onclick="confirmLogout()" class="nav">Log out</a>';
        } else if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
            echo '<a href="login.php" class="nav">Login</a>';
        } else {
            echo '<a href="register.php" class="nav">Sign up</a>';
        }
        ?>
        <!-- <a href="" class="nav" >Log out</a> -->
    </div>

    <!-- content*********************************** -->


    <div class="container">

        <div class="loginHead">
            <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="70px"></a>
            <h1>Read Stories</h1>
        </div>
        <?php
        $con = mysqli_connect("localhost", "root", "", "users");
        if (!$con) {
            die(mysqli_error($con));
        }


        $query = "SELECT * FROM posts";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $storyTitle = $row['title'];
            $abstract = $row['abstract'];
            $genre = $row['genre'];
            $language = $row['language'];
            $created = $row['created_at'];
            $updated = $row['updated_at'];
            $status = $row['status'];
            $id = $row['id'];
            $user_id = $row['user_id'];
            $cvrImgPath = "img/ . {$row['cover_image']}";


            $query1 = "SELECT * FROM info where id= $user_id";
            $result1 = mysqli_query($con, $query1);
            $row1 = mysqli_fetch_assoc($result1);
            $profileImgPath = "profileImages/{$row1['avatar']}";

            $uname = $row1['uname'];


            echo "
        <div class='storie'>
        <div class='pp'>
        <a href='$profileImgPath'><img src='{$profileImgPath}' alt='image' style='border-radius: 50%; width: 40px; height: 40px;'></a>
        <p>&nbsp $uname</P>
        </div>
        <div class='stori'>
            <div class='left'>
                <div class='ctitle'>" . $storyTitle . "</div>
                <div class='cdescription'>" . $abstract . "</div>
                <div class='seemore'><a href='seemore.php?id=$id'>See full story</a></div>
                <div class='cformat'>Genre: " . $genre . "</div>
                <div class='cformat'>Status: " . $status . "</div>
                <div class='cformat'>Created at: " . $created . "</div>
                    <div class='cformat'>Edited at: " . $updated . "</div>
                <br><br>
            </div>

            <div class='right'>
                <div class='cimage'><a href='$cvrImgPath' target='_blank'><img src='{$cvrImgPath}' alt='{$row['title']}' '></a></div>
            </div>
        </div>
        </div>";
        }
        if (mysqli_num_rows($result) === 0) {
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