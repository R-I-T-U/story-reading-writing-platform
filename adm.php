<?php
session_start();
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
    <a href="admNotification.php">
    <span class="material-icons-outlined">notifications</span>
      </a>
    <!-- <span class="material-icons-outlined">email</span> -->
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
    <main>
      <div>
        <h2>DASHBOARD</h2>
      </div>
      <!-- here goes inner content -->
      <div class="admin-panel">
        <?php
        $query1 = "SELECT * from info WHERE email NOT IN ('ritukhwalapala@gmail.com', 'rajanbhandari@gmail.com')";
        $result1 = mysqli_query($con, $query1);
        if($result1){
          $count = mysqli_num_rows($result1);
          echo "Total number of users = ".$count;
        }

        $query2 = "SELECT * FROM noti";
        $result2 = mysqli_query($con, $query2);
        if($result2){
          $count = mysqli_num_rows($result2);
          echo "<br><br>Reported comments = ".$count;
        }
        ?>
        <center><h3>Users Data</h3></center>
        <table border='1'>
          <tr>
            <th>id</th>
            <th>Email</th>
          </tr>
            
              <?php
              while($row = mysqli_fetch_assoc($result1)){
                echo "<tr>
                <td style='height:40px'>".$row['id']."</td>
                <td style='height:40px'>".$row['email']."</td>
                </tr>";
              }
              ?>
            
          
        </table>
      </div>
      <!-- ends content -->
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