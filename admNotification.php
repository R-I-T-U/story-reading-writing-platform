<?php
$con = mysqli_connect("localhost", "root", "", "users");
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * FROM noti";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin| Reported comments</title>
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
        <h2>REPORTED COMMENTS</h2>
      </div>
      <div class="header-right">

        <a onclick="confirmLogout()" class="nav">
          <span class="material-icons-outlined">logout</span>
        </a>
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
      </ul>
    </aside>
    <main class="main-container">

      <div class="admin-panel">
  <?php
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $cmtId = $row['cmt_id'];
      $cmt = $row['cmt'];
      $postId = $row['postId'];
      $userId = $row['userId'];

      $query1 = "SELECT * FROM info where id= $userId";
      $result1 = mysqli_query($con, $query1);
      $row1 = mysqli_fetch_assoc($result1);
      $uname = $row1['uname'];

  ?>
      <form action="decide.php" method="POST">
        <div class="comment-container">
          <div class="comment">
            <p class="comment-text">
              <input type="text" value="<?php echo $cmtId ?>" name="cid" hidden>
              <?php echo $uname . " reported a comment ' <span style='color: red;'>" . $cmt . "</span>' ."; ?>
            </p>
            <button class="delete-btn" type='submit' name="delete">Delete</button>
            <button class="ignore-btn" type='submit' name="ignore">Ignore</button>
          </div><br>
        </div>
      </form>
  <?php
    }
  } else {
    echo "<p style='display:flex; justify-content:center;'>No results.</p>";
  }
  ?>

      </div>
    </main>
    <script>
      function confirmLogout() {
        if (confirm("Are you sure you want to log out?")) {
          window.location.href = "logout.php";
        }
      }
    </script>
</body>

</html>