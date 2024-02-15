<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Read the books you like !!</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="read.css">
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

        .story-card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);

        }

        .stories {
            background-color: white;
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

        <?php
    // Check if the user is logged in (session or cookie exists)
    if (isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
        echo '<a href="profile.php" class="nav">Profile</a>';
    } else {
        echo '<a href="register.php" class="nav">Sign up</a>';
    }
    ?>

        <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a>
    </div>

    <!-- content*********************************** -->
    <div class="container">

        <div class="loginHead">
            <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="70px"></a>
            <h1>Read Stories</h1>
        </div>

        <div class="stories">

            <div class="left">
                <div class="ctitle">The title</div>
                <div class="cdescription">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum saepe dolores
                    odio corporis non quas enim maiores, dolorem quasi quae ea temporibus necessitatibus excepturi
                    deleniti, praesentium, recusandae soluta quibusdam aut.
                </div>
                <div class="cgenre">horror</div>
                <div class="cformat">poem</div>
                <div class="crate">Rating: OFF</div><br>
            </div>

            <div class="right">
                <div class="cimage"><img src="images/bg12.jpg" alt="img"></div>
            </div>
        </div>

        <center>
            <p id="end">The end!!</p>
        </center>

    </div>

</body>

</html>