<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header("location: register.php");
  exit();
} else{
  $userId = $_SESSION['user_id'];
}
$con = mysqli_connect("localhost", "root", "", "users");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - User Profile</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
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
    <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a>
  </div>


  <!-- content*********************************** -->

  <div class="container">
    <div class="img-container"></div>
    <img id="profileImage" src="images/bg12.jpg" alt="Image">
    
    <img src="images/option.jpg" alt="" height="20px" style="margin-left:20px; cursor:pointer;" onclick="toggleLogoutOptions()">

    <div id="logoutOptions" style="display:none;">
    <a href="logout.php" class="logoutOption" style="margin-left:20px; color:black; position: absolute; ">Log out</a>
</div>    

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
            $description = $row['description'];
            $genre = $row['genre'];
            $language = $row['language'];
            $format = $row['format'];
            $created = $row['created_at'];
            $updated = $row['updated_at'];
            $id = $row['id'];
            $cvrImgPath = "img/ . {$row['cover_image']}";
            

            echo "
            <div class='stories'>

                <div class='left'>
                    <div class='ctitle'>".$storyTitle."</div>
                    <div class='cdescription'>".$description."
                    </div>
                    <div class='cgenre'>Genre: ".$genre."</div>
                    <div class='cformat'>Format: ".$format."</div>
                    <br>
                    <div style='display: flex;'>
               <a href='editCov.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Edit</button>
                   </div>
               </a> <br>
               <a href='delete.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Delete</button>
                   </div>
               </a>
               <a href='viewChap.php'>
                   <div><button>View Chapters</button>
                   </div>
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
    }
        ?>

    <center><p id="end">The end!!</p></center>

</div>  
<script>
    // JavaScript function to toggle the visibility of the logout options
    function toggleLogoutOptions() {
        var logoutOptions = document.getElementById("logoutOptions");
        if (logoutOptions.style.display === "none") {
            logoutOptions.style.display = "block";
        } else {
            logoutOptions.style.display = "none";
        }
    }
</script>
</body>
</html>
