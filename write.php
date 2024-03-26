<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header("location: register.php");
  exit();
} else{
  $userId = $_SESSION['user_id'];
}

$con = mysqli_connect("localhost", "root","","users");
if(!$con){
  die(mysqli_error($con));
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>StorySphere - Add Story Info</title>
  <link rel="stylesheet" href="write.css">
  <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <style>
    .story-info {
      background-color: rgba(255, 255, 255, 0.9);
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
    if (isset($_SESSION['user_id'])) {
        echo '<a href="profile.php" class="nav">Profile</a>'; 
    } else if(isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
        echo '<a href="login.php" class="nav">Login</a>';    
    } else {
        echo '<a href="register.php" class="nav">Sign up</a>';
    }
    ?>
    <a href="logout.php" class="logout" class="nav">Log out</a>

    <!-- <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a> -->
  </div>

  <!-- content*********************************** -->

  <center>
    <div class="story-info">
      <form method="POST" action="write.php" enctype="multipart/form-data">
        <div class="loginHead">
          <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
          <h1>Add Story Info</h1>
        </div>

        <label for="image">Add cover Image: <input type="file" name="coverImage" id="image" accept="image/*"
            onchange="previewImage(event)" required></label>
        <div id="image-preview"></div><br><br>

        <label for="title">Title:
          <input type="text" id="title" name="storyTitle" class="form-control" required></label><br>

        <label for="description">Description: <textarea id="description" name="description" required
            class="form-control"></textarea></label>
        <br>
        <label for="genre">Choose Genre:
          <select name="genre" id="genre">
            <?php  
    $query2 = "SELECT * FROM genre";
    $result2 = mysqli_query($con, $query2);

    if($result2 && mysqli_num_rows($result2) > 0) {
      while($row = mysqli_fetch_assoc($result2)) {
        $g_name = $row['g_name'];
        echo "<option value='$g_name'>$g_name</option>";
      }
    }
    ?>
          </select>
        </label>

        <br>

        <label for="Language">Choose Language: <select name="Language" id="Language">
            <option value="English">English</option>
            <option value="Nepali">Nepali</option>

          </select></label>
        <br>

        <!-- <label for="format">Choose Story Format: <select name="format" id="format">
            <option value="long">Long Form Story</option>
            <option value="short">Short Form Story</option>
            <option value="poem">Poem</option>
            <option value="manga">Pictorial Style / Manga Style Story</option>

          </select></label> -->
        <br>

        <!-- <label for="" id="r">Rating: 
          <label for="on"><input type="radio" id="on" name="rate">ON</label>
          <label for="off"><input type="radio" id="off" name="rate">OFF</label>
        </label> -->

        <br><br>
        <div class="button">
          <button class="cancel"><a href="read.php">Cancel</a></button>
          <button class="next" name="next" style=" margin-left: 20px;">Next</button>
        </div><br>

        <?php
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['next'])) {
$coverImage = $_FILES['coverImage']['name'];
$coverImage_temp_name = $_FILES['coverImage']['tmp_name'];
$coverImage_Folder = "img/ . $coverImage";
$storyTitle = $_POST['storyTitle'];
$description = $_POST['description'];
$genre = $_POST['genre'];
$language = $_POST['Language'];
// $format = $_POST['format'];

 $query1 = "SELECT * FROM info WHERE id= $userId";
 $result1 = mysqli_query($con, $query1);

  $row= mysqli_fetch_assoc($result1);
  $user_id= $row['id'];


$query = "INSERT INTO posts (cover_image, title, description, genre, language, user_id, created_at, updated_at) VALUES ('$coverImage','$storyTitle' , '$description', '$genre', '$language', $user_id, NOW(), NOW())";

$result = mysqli_query($con, $query);
if(!$result){
  echo '<p style="color: red;">Sorry could not load! Try again later !</p>';
} else{
  move_uploaded_file($coverImage_temp_name,$coverImage_Folder);
  header('location: next.php');
}

}

mysqli_close($con);
?>
      </form>
    </div>
  </center>

  <script>
    function previewImage(event) {
      var input = event.target;
      var preview = document.getElementById('image-preview');
      // Ensure that a file was selected
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          // Set the source of the image to the data URL
          preview.innerHTML = '<img src="' + e.target.result + '" alt="Selected Image">';
        };
        // Read the selected file as a data URL
        reader.readAsDataURL(input.files[0]);
      } else {
        // Clear the preview if no file was selected
        preview.innerHTML = '';
      }
    }
  </script>
</body>

</html>