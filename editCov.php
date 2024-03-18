<?php
if(isset($_GET['id'])) {
  $postId = $_GET['id'];

    $con = mysqli_connect("localhost", "root", "", "users");
    if(!$con) {
        die(mysqli_error($con));
    }

    $query = "SELECT * FROM posts WHERE id = $postId";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        $storyTitle = $post['title'];
        $description = $post['description'];
        $genre = $post['genre'];
        $format = $post['format'];

    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>StorySphere - Edit Story Info</title>
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

  <center>
    <div class="story-info">
      <form method="POST" action="conformEdit.php" enctype="multipart/form-data">
        <div class="loginHead">
          <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
          <h1>Edit Story Info</h1>
        </div>

        <label for="image">Add cover Image: <input type="file" name="coverImage" id="image" accept="image/*"
            onchange="previewImage(event)"></label>
        <div id="image-preview"></div><br><br>

        <label for="title">Title:
          <input type="text" id="title" name="storyTitle" class="form-control" value="<?php echo $storyTitle; ?>" required></label><br>

        <label for="description">Description: <textarea
            id="description" name="description" required class="form-control"><?php echo $description; ?></textarea></label>
        <br>

        <label for="genre">Choose Genre:
          <select name="genre" id="genre">
            <option value="Adventure">Adventure</option>
            <option value="Comedy">Comedy</option>
            <option value="Horror">Horror</option>
            <option value="Poetry">Poetry</option>
            <option value="Manga">Manga</option>
            <option value="Mystery">Mystery</option>
            <option value="Paranormal">Paranormal</option>
            <option value="Non Fiction">Non Fiction</option>
            <option value="Science Fiction">Science Fiction</option>
          </select></label><br>

        <br>

        <label for="format">Choose Story Format: <select name="format" id="format">
            <option value="long">Long Form Story</option>
            <option value="short">Short Form Story</option>
            <option value="poem">Poem</option>
            <!-- <option value="manga">Pictorial Style / Manga Style Story</option> -->

          </select></label>
        <br>
        <input type="number" hidden value="<?php echo $postId?>" name="postId">
        <!-- <label for="" id="r">Rating: 
          <label for="on"><input type="radio" id="on" name="rate">ON</label>
          <label for="off"><input type="radio" id="off" name="rate">OFF</label>
        </label> -->

        <br><br>
        <div class="buttom">
          <button class="cancel"><a href="read.php">Cancel</a></button>
          <button class="next" name="done" style=" margin-left: 20px;">Done</button>
        </div><br>
      </form>
    </div>
  </center>

  <script>
    function previewImage(event) {
      var input = event.target;
      var preview = document.getElementById('image-preview');
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.innerHTML = '<img src="' + e.target.result + '" alt="Selected Image">';
        };
        reader.readAsDataURL(input.files[0]);
      } else {
        preview.innerHTML = '';
      }
    }
  </script>
</body>
</html>