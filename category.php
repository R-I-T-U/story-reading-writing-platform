<?php
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
    <title>Story Category</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="ad.css">
  </head>
  <body>
  <div class="grid-container">

<!-- Header -->
<header class="header">
  <div class="menu-icon" onclick="openSidebar()">
    <span class="material-icons-outlined">menu</span>
  </div>
  <div class="header-left">
    <span class="material-icons-outlined">search</span>
  </div>
  <div class="header-right">
    <span class="material-icons-outlined">notifications</span>
    <span class="material-icons-outlined">email</span>
    <span class="material-icons-outlined">account_circle</span>
  </div>
</header>
<!-- End Header -->

<!-- Sidebar -->
<aside id="sidebar">
  <div class="sidebar-title">
    <div class="sidebar-brand">
      <span class="material-icons-outlined"></span> StorySphere
    </div>
    <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
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
    <!-- <li class="sidebar-list-item">
      <a href="#">
        <span class="material-icons-outlined">groups</span> Authors
      </a>
    </li>
    <li class="sidebar-list-item">
      <a href="#">
        <span class="material-icons-outlined">settings</span> Settings
      </a>
    </li> -->
  </ul>
</aside>
    <main class="main-container">
      <div class="main-title">
        <h2>STORY CATEGORY</h2>
      </div>
      <div class="admin-panel">

       <!-- Category Form -->
       <div class="category-form">
            <h3>Add Category</h3>
            <form action="add_category.php" method="POST">
                <label for="category_name">Category Name:</label>
                <input type="text" id="category_name" name="category_name" required>
                <button type="submit">Add Category</button>
            </form>
        </div>
        <!-- End Category Form -->

        <!-- Display Existing Categories -->
        <div class="existing-categories">
            <h3>Existing Categories</h3>
            <ul>
                <?php
                // Fetch existing categories from the database
                $sql = "SELECT * FROM genre";
                $result = mysqli_query($con, $sql);

                // Check if categories exist
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row and display category names
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>" . $row['category_name'] . "</li>";
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
    <script src="as.js"></script>
  </body>
</html>
