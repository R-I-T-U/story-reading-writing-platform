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
    <title>Admin Dashboard</title>

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
      <a href="#">
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
        <h2>DASHBOARD</h2>
      </div>
      <div class="admin-panel">
        <?php
        while($row = mysqli_fetch_assoc($result)) {
          $cmtId = $row['cmt_id'];
          $cmt = $row['cmt'];
          $postId= $row['postId'];
          $user = $row['userId'];
          ?>
          <form action="decide.php" method="POST">
          <div class="comment-container">
            <div class="comment">
              <p class="comment-text">
                <input type="text" value="<?php echo $cmtId ?>" name="cid" hidden>
                <?php echo "user ".$user." reported a comment ' <span style='color: red;'>".$cmt."</span> ."; ?>
              </p>
              <button class="delete-btn" type='submit' name ="delete">Delete</button>
              <button class="ignore-btn" type='submit' name ="ignore">Ignore</button>
            </div><br>
          </div>
          </form>
        <?php } ?>
      </div>
    </main> 
    
  </body>
</html>