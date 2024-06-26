<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("location: login.php");
  exit();
} else {
  $userId = $_SESSION['admin_id'];
}

$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin| Story Category</title>
  <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">

  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="adm.css">
</head>

<body>
  <div class="grid-container">

    <!-- Header -->
    <header class="header">
      <!-- <div class="menu-icon" onclick="openSidebar()">
    <span class="material-icons-outlined">menu</span>
  </div> -->
      <div class="header-left">
        <h2>STORY CATEGORY</h2>
      </div>
      <div class="header-right">
        <a onclick="confirmLogout()" class="nav">
          <span class="material-icons-outlined">logout</span></a>
      </div>
    </header>
    <!-- End Header -->

    <!-- Sidebar -->
    <aside id="sidebar">
      <div class="sidebar-title">
        <div class="sidebar-brand">
          <span class="material-icons-outlined"></span> StorySphere
        </div>
        <!-- <span class="material-icons-outlined" onclick="closeSidebar()">close</span> -->
      </div>

      <ul class="sidebar-list">
        <li class="sidebar-list-item">
          <a href="adm.php">
            <span class="material-icons-outlined">dashboard</span> Dashboard
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="category.php">
            <span class="material-icons-outlined">category</span> Categories
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="adpostReq.php">
            <span class="material-icons-outlined">groups</span> Post Request
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="admNotification.php">
            <span class="material-icons-outlined">notifications</span> Reported Comments
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="viewstoryBYAdmin.php">
            <span class="material-icons-outlined">groups</span> View all stories
          </a>
        </li>
      </ul>
    </aside>
    <main class="main-container">

      <div class="admin-panel">

        <!-- Category Form -->
        <div class="category-form">
          <h3>Add Category</h3>
          <form action="add_category.php" method="POST">
            <label for="category_name">Category Name: </label>
            <input type="text" id="category_name" name="category_name" required oninput="validateCategory()">
            <button type="submit" name="submit">Add Category</button><br><br>
            <div id="cat-error" style="color: red;"></div>
          </form>

        </div>
        <!-- End Category Form -->

        <!-- Display Existing Categories -->
        <div class="existing-categories">
          <h3>Existing Categories</h3>
          <ul>
            <?php
            $sql = "SELECT * FROM genre";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<form method ='POST' action='deleteCategory.php'>
                        <input type='number' name='g_id' value ='{$row['g_id']}' hidden>
                        <li>" . $row['g_name'] . "
                        <button type='submit' name='deleteCategory' id='removeBtn'> Remove</button>
                        </li><br>
                        </form>";
              }
            } else {
              echo "No categories found.";
            }
            ?>
          </ul>
        </div>
        <!-- End Display Existing Categories -->
      </div>

  </div>
  </main>
  <script>
    function confirmLogout() {
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = "logout.php";
      }
    }

    function validateCategory() {
      var input = document.getElementById('category_name');
      var Error = document.getElementById('cat-error');

      // Regular expression pattern for alphanumeric characters only
      var pattern = /^[a-zA-Z\s]*$/;
      var pattern2 = /^.{0,20}$/;

      if (!pattern.test(input.value)) {
        Error.textContent = "Genre should contain letters and white spaces only.";
        input.setCustomValidity("Invalid Genre");
      } else if (!pattern2.test(input.value)) {
        Error.textContent = "Genre cannot exceed 20 characters.";
        input.setCustomValidity("Invalid Genre");
      } else {
        Error.textContent = "";
        input.setCustomValidity("");
      }
    }
  </script>
</body>

</html>