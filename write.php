<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("location: register.php");
  exit();
} else {
  $userId = $_SESSION['user_id'];
}

$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
  die(mysqli_error($con));
}
$que1 = "SELECT uname, avatar, gender, bio FROM info WHERE id= $userId";
$res1 = mysqli_query($con, $que1);
$row = mysqli_fetch_assoc($res1);
$uname = $row['uname'];
$avatar = isset($row['avatar']) ? 'profileImages/' . $row['avatar'] : 'images/cat.webp';
// $gender = !empty($row['gender']) ? $row['gender'] : 'Not specified';
// $bio = !empty($row['bio']) ? $row['bio'] : 'Not specified';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>StorySphere - Add Story Info</title>
  <link rel="stylesheet" href="write.css">
  <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-image: url(images/bg.png);
    }

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
    <form action="search_result.php" method="POST">
      <div class="search-container">
        <input type="text" class="search-bar" placeholder="Search..." name="search_content">
        <button class="search-button">Search</button>
      </div>
    </form>

    <a href="profile.php" class="nav"><?php echo $uname; ?>&nbsp;
      <img src="<?php echo $avatar; ?>" alt='image' style='border-radius: 50%; width: 40px; height: 40px; object-fit: cover;'>
    </a>
    <a onclick="confirmLogout()" class="nav">Log out</a>

  </div>

  <!-- content*********************************** -->

  <center>
    <div class="story-info">
      <form method="POST" action="write.php" enctype="multipart/form-data">
        <div class="loginHead">
          <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
          <h1>Write your Story</h1>
        </div>

        <label for="image">Add cover Image: <input type="file" name="coverImage" id="image" accept="image/*" onchange="previewImage(event)" required></label>
        <div id="image-preview"></div><br><br>

        <label for="title">Title:
          <input type="text" id="title" name="storyTitle" class="form-control" required oninput="validateTitle()">
          <div id="title-error" style="color: red;"></div>
        </label><br>


        <label for="abstract">Synopsis: <textarea id="abstract" name="abstract" required class="form-control" oninput="validateAbstract()"></textarea>
          <div id="abstract-error" style="color: red;"></div>
        </label>
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

        <!-- <label for="Language">Choose Language: <select name="language" id="Language">
            <option value="English">English</option>
            <option value="Nepali">Nepali</option>

          </select></label>
        <br> -->
        <label for="description">Full Story: <textarea id="description" name="description" required class="form-control" oninput="validateDesc()"></textarea>
          <div id="desc-error" style="color: red;"></div>
        </label>
        <br>

        <label for="status">Status: <select name="status" id="status">
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>

          </select></label>
        <br>
        <p><i>Note: It can take up to 48 hours for a submission to be approved. If issues are found within the submission,<br> it will be rejected and can be submitted again after making corrections. </i></p>

        <br><br>
        <div class="button">
          <button class="cancel" formaction="profile.php">Cancel</button>
          <button class="next" name="next" style=" margin-left: 20px;">Submit</button>
        </div><br>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['next'])) {
          $coverImage = $_FILES['coverImage']['name'];
          $coverImage_temp_name = $_FILES['coverImage']['tmp_name'];
          $coverImage_Folder = "img/ . $coverImage";
          $storyTitle = mysqli_real_escape_string($con, $_POST['storyTitle']);
          $abstract = mysqli_real_escape_string($con, $_POST['abstract']);
          $description = mysqli_real_escape_string($con, nl2br($_POST['description']));
          // $abstract = $_POST['abstract'];
          $genre = $_POST['genre'];
          // $description = $_POST['description'];
          $status = $_POST['status'];
          $state = 0;
          if (empty($storyTitle) || empty($abstract) || empty($description) || empty($coverImage)) {
            echo '<p style="color: red;">All of above are required fields</p>';
            // } else if (!preg_match('/^(?![0-9])[a-zA-Z0-9\s]{0,50}$/', $storyTitle)) {
            //   echo '<p style="color: red;">Invalid story title! </p>';
            // } else if (!preg_match('/^(?!.*[@#$%^*~])(?![0-9@#$%^*~]).{300,800}$/', $abstract)) {
            //   echo '<p style="color: red;">Invalid sypnosis!</p>';
            // } else if (!preg_match('/^(?!.*[@#$%^*~])(?![0-9@#$%^*~]).{500,}$/', $description)) {
            //   echo '<p style="color: red;">Invalid description! </p>';
          } else {
            $query = "INSERT INTO posts (cover_image, title, abstract, genre, description, status, user_id, created_at, updated_at, state) VALUES ('$coverImage','$storyTitle' , '$abstract', '$genre', '$description', '$status', $userId, NOW(), NOW(), $state)";

            $result = mysqli_query($con, $query);
            if (!$result) {
              echo '<p style="color: red;">Sorry could not load! Try again later !</p>';
            } else {
              move_uploaded_file($coverImage_temp_name, $coverImage_Folder);
              header('location: profile.php');
            }
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
      //var pattern = /^[^@#$%^~`]*$/;
      var pattern1 = /^(?![0-9])[\s\S]*$/;
      var pattern2 = /^[\S\s]{800,}$/;

      // if (!pattern.test(input.value)) {
      //   Error.textContent = "Description cannot contain some special characters.";
      //   input.setCustomValidity("Invalid description");
      // } else
       if (!pattern1.test(input.value)) {
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