<?php
if (isset($_GET['id'])) {
  $postId = $_GET['id'];

  $con = mysqli_connect("localhost", "root", "", "users");
  if (!$con) {
    die(mysqli_error($con));
  }

  $query = "SELECT * FROM posts WHERE id = $postId";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result);
    $storyTitle = $post['title'];
    $abstract = $post['abstract'];
    $genre = $post['genre'];
    $updated = $post['updated_at'];
    $status = $post['status'];
    $description = $post['description'];
    $genre = $post['genre'];
    $cvrImgPath = "img/ . {$post['cover_image']}";
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
      echo '<a onclick="confirmLogout()" class="nav">Log out</a>';
    } else if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
      echo '<a href="login.php" class="nav">Login</a>';
    } else {
      echo '<a href="register.php" class="nav">Sign up</a>';
    }
    ?>

  </div>

  <!-- content*********************************** -->

  <center>
    <div class="story-info">
      <form method="POST" action="conformEdit.php" enctype="multipart/form-data">
        <div class="loginHead">
          <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
          <h1>Edit your Story</h1>
        </div>

        <label for="image">Add cover Image: <input type="file" name="coverImage" id="image" accept="image/*" onchange="previewImage(event)"></label>
        <div id="image-preview"></div><br><br>

        <label for="title">Title:
          <input type="text" id="title" name="storyTitle" class="form-control" value="<?php echo $storyTitle; ?>" required oninput="validateTitle()">
          <div id="title-error" style="color: red;"></div></label><br>

        <label for="abstract">Synopsis: <textarea id="abstract" name="abstract" required class="form-control" oninput="validateAbstract()"><?php echo $abstract; ?></textarea>
        <div id="abstract-error" style="color: red;"></div></label>
        <br>
        <label for="genre">Choose Genre:
          <select name="genre" id="genre">
            <?php
            $query2 = "SELECT * FROM genre";
            $result2 = mysqli_query($con, $query2);

            if ($result2 && mysqli_num_rows($result2) > 0) {
              while ($row = mysqli_fetch_assoc($result2)) {
                $g_name = $row['g_name'];
                echo "<option value='$g_name'>$g_name</option>";
              }
            }
            ?>
          </select>
        </label>

        <br>
        <label for="description">Full Story: <textarea id="description" name="description" required class="form-control" oninput="validateDesc()"><?php echo $description; ?></textarea>
        <div id="desc-error" style="color: red;"></div></label>
        <br>

        <label for="status">Status: <select name="status" id="status">
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>

          </select></label>
        <br>

        <input type="number" hidden value="<?php echo $postId ?>" name="postId">

        <br><br>
        <div class="buttom">
          <button class="cancel" formaction="profile.php">Cancel</button>
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

    function confirmLogout() {
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = "logout.php";
      }
    }

    function validateTitle() {
      var input = document.getElementById('title');
      var Error = document.getElementById('title-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /^(?!.*[@#$%^*~<>{}()[;\n]).*$/;
      var pattern1 = /^(?![0-9@#$%^*~<>{}()[;\n]).*$/;
      var pattern2 = /^.{0,50}$/;

      if (!pattern.test(input.value)) {
        Error.textContent = "Title can only contain letters and numbers.";
        input.setCustomValidity("Invalid title");
      } else if (!pattern1.test(input.value)) {
        Error.textContent = "Title cannot begin with a number.";
        input.setCustomValidity("Invalid title");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Title cannot exceed 50 characters.";
        input.setCustomValidity("Invalid title");
      } else {
        Error.textContent = "";
        input.setCustomValidity("");
      }
    }

    function validateAbstract() {
      var input = document.getElementById('abstract');
      var Error = document.getElementById('abstract-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /^(?!.*[@#$%^*~\n]).*$/;
      var pattern1 = /^(?![0-9@#$%^*~\n]).*$/;
      var pattern2 = /^.{500,800}$/;



      if (!pattern.test(input.value)) {
        Error.textContent = "Synopsis cannot contain some special characters and one line spaces.";
        input.setCustomValidity("Invalid Synopsis");
      } else if (!pattern1.test(input.value)) {
        Error.textContent = "Synopsis cannot begin with a number.";
        input.setCustomValidity("Invalid Synopsis");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Synopsis must be between 100 and 800 characters long.";
        input.setCustomValidity("Invalid Synopsis");
      } else {
        Error.textContent = "";
        input.setCustomValidity("");
      }
    }

    function validateDesc() {
      var input = document.getElementById('description');
      var Error = document.getElementById('desc-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /^[^@#$%^~`]*$/;
      var pattern1 = /^(?![0-9])[\s\S]*$/;
      var pattern2 = /^[\S\s]{800,}$/;

      if (!pattern.test(input.value)) {
        Error.textContent = "Description cannot contain some special characters.";
        input.setCustomValidity("Invalid description");
      } else if (!pattern1.test(input.value)) {
        Error.textContent = "Description cannot begin with a number.";
        input.setCustomValidity("Invalid description");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Description should contain at least 800 characters.";
        input.setCustomValidity("Invalid description");
      } else {
        Error.textContent = "";
        input.setCustomValidity("");
      }
    }
  </script>
</body>

</html>