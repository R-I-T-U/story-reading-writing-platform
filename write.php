<!DOCTYPE html>
<html lang="en">

<head>
  <title>StorySphere - Add Story Info</title>
  <link rel="stylesheet" href="write.css">
  <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <style>
    .story-info{
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

  <center>
    <div class="story-info">
      <form>
        <div class="loginHead">
          <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
          <h1>Add Story Info</h1>
        </div>
        
        <label for="image">Add cover Image: <input type="file" name="image" id="image" accept="image/*"
            onchange="previewImage(event)"></label>
        <div id="image-preview"></div><br><br>

        <label for="title">Title:
        <input type="text" id="title" name="story-title" class="form-control" required></label><br>

        <label for="description">Description: <textarea id="description" name="description" required class="form-control"></textarea></label>
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

        <label for="Language">Choose Language: <select name="Language" id="Language">
          <option value="English">English</option>
          <option value="Nepali">Nepali</option>
          <option value="Hindi">Hindi</option>

        </select></label>
        <br>

        <label for="format">Choose Story Format: <select name="format" id="format">
          <option value="long">Long Form Story</option>
          <option value="short">Short Form Story</option>
          <option value="poem">Poem</option>
          <!-- <option value="manga">Pictorial Style / Manga Style Story</option> -->

        </select></label>
        <br>


        <!-- <label for="" id="r">Rating: 
          <label for="on"><input type="radio" id="on" name="rate">ON</label>
          <label for="off"><input type="radio" id="off" name="rate">OFF</label>
        </label> -->

        <br><br>
        <div class="buttom">
          <button class="cancel"><a href="read.php">Cancel</a></button>
          <button class="next"><a href="next.php">Next</a></button>
        </div>
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