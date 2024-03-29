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
        <a href="logout.php" class="nav">Log out</a>

    </div>

    <!-- content*********************************** -->

    <div class="container">
      <?php
        
        $que1 = "SELECT uname FROM info WHERE id= $userId";
        $res1 = mysqli_query($con, $que1);
        $row1 = mysqli_fetch_assoc($res1);
        $uname = $row1['uname'];
        
        ?>
      <div class="img-container"></div>
<!-- profile -->
<form id="profileForm" action="editProfile.php" method="POST">
    <img id="profileImage" src="images/bg12.jpg" alt="Image">
    <div>
        <div class="profile-info">
            <p id="uname">Name: <?php echo $uname; ?></p>
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
            $description = $row['description'];
            $genre = $row['genre'];
            $language = $row['language'];
            // $format = $row['format'];
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
                    
                    <div class='cformat'>Created at: ".$created."</div>
                    <div class='cformat'>Edited at: ".$updated."</div>
                    <br>
                    <div style='display: flex;'>
               <a href='editCov.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Edit</button>
                   </div>
               </a> <br>
               <a href='delete.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Delete</button>
                   </div>
               </a>";

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
           </div>

                <div class='right'>
                    <div class='cimage'>
                    <a href='$cvrImgPath' target='_blank'><img src='{$cvrImgPath}' alt='{$row['title']}' '></a>
                    </div>
                </div>
            </div>";

        }
    } else{
        echo "<div class='stories'><p style='height: 10rem; font-size: 2rem;'>Nothing to show</p></div>";
    }
        ?>

        <center>
            <p id="end">The end!!</p>
        </center>

    </div>

</body>

</html>