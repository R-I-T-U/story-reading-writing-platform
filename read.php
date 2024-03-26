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

        .stories {
            background-color: white;
            z-index: 1;
            margin-bottom: 20px;
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
        echo '<a href="logout.php" class="nav">Log out</a>';
    } else if(isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
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
            // $format = $row['format'];
            $created= $row['created_at'];
            $updated= $row['updated_at'];
            $cvrImgPath = "img/ . {$row['cover_image']}";
            $id = $row['id'];

        echo "
        <div class='stories'>

            <div class='left'>
                <div class='ctitle'>".$storyTitle."</div>
                <div class='cdescription'>".$description."
                </div>
                <div class='cgenre'>Genre: ".$genre."</div>
                
                <div class='cformat'>Created at: ".$created."</div>
                    <div class='cformat'>Edited at: ".$updated."</div>
                <br><br>";
                $q = "SELECT * FROM chapter WHERE post_id = $id";
               $r = mysqli_query($con, $q);
               if(mysqli_num_rows($r)>0){ echo "
               <a href='viewChap.php?id=$id '>
                   <div><button>View Chapters</button>
                   </div>
               </a>";
               }
               echo "
            </div>

            <div class='right'>
                <div class='cimage'><a href='$cvrImgPath' target='_blank'><img src='{$cvrImgPath}' alt='{$row['title']}' '></a></div>
            </div>
        </div>";

        }
        if(mysqli_num_rows($result) === 0){
            echo "<div class='stories'><p style='height: 10rem; font-size: 2rem;'>Nothing to show</p></div>";
           
        }
        ?>

        <center>
            <p id="end">The end!!</p>
        </center>

    </div>

</body>

</html>