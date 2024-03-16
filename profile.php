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

    <div class="stories">
      
        <div class="left">
            <div class="ctitle">The title</div>
            <div class="cdescription">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum saepe dolores odio corporis non quas enim maiores, dolorem quasi quae ea temporibus necessitatibus excepturi deleniti, praesentium, recusandae soluta quibusdam aut.
            </div>
            <div class="cgenre">horror</div>
            <div class="cformat">poem</div>
            <div class="crate">Rating: OFF</div><br>
            <a href="next.php"><div><button>Edit</button></div></a>
        </div>
        
        <div class="right">
            <div class="cimage"><img src="images/bg12.jpg" alt="img"></div>
        </div>
    </div>
    

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
