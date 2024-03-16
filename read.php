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
    session_start();
    if (isset($_SESSION['user_id'])) {
        echo '<a href="profile.php" class="nav">Profile</a>'; 
    } else if(isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
        echo '<a href="login.php" class="nav">Login</a>';    
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
        <?php
        $con = mysqli_connect("localhost", "root","","users");
        if(!$con){
          die(mysqli_error($con));
        }
        $query= "SELECT * FROM posts";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($result)){
            $coverImage = $row['cover_image'];
            $storyTitle = $row['title']; 
            $description = $row['description'];
            $genre = $row['genre'];
            $language = $row['language'];
            $format = $row['format'];
            $created= $row['created_at'];
            $updated= $row['updated_at'];

        echo "
        <div class='stories'>

            <div class='left'>
                <div class='ctitle'>".$storyTitle."</div>
                <div class='cdescription'>".$description."
                </div>
                <div class='cgenre'>".$genre."</div>
                <div class='cformat'>".$format."</div>
                
                <br>
            </div>

            <div class='right'>
                <div class='cimage'>".$coverImage."</div>
            </div>
        </div>";

        }
        ?>

        <center>
            <p id="end">The end!!</p>
        </center>

    </div>

</body>

</html>