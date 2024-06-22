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
  <title>Admin| Dashboard</title>
  <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="ad.css">
  <link rel="stylesheet" href="adm.css">
</head>

<body>
  <div class="grid-container">
    <!-- Header -->
    <header class="header">
      <div class="header-left">
        <h2>DASHBOARD</h2>
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
    <!--End Sidebar -->
    <main>

      <!-- here goes inner content -->
      <div class="admin-panel">
        <?php
        $query1 = "SELECT * from info WHERE email NOT IN ('ritukhwalapala@gmail.com', 'rajanbhandari@gmail.com')";
        $result1 = mysqli_query($con, $query1);
        if ($result1) {
          $count = mysqli_num_rows($result1);
          echo "Total number of users = " . $count;
        }

        $query3 = "SELECT * FROM posts WHERE state = 0";
        $result3 = mysqli_query($con, $query3);
        if ($result3) {
          $count = mysqli_num_rows($result3);
          echo "<br><br>Total post request = " . $count;
        }

        $query2 = "SELECT * FROM noti";
        $result2 = mysqli_query($con, $query2);
        if ($result2) {
          $count = mysqli_num_rows($result2);
          echo "<br><br>Total reported comments = " . $count;
        }
        ?>
        <center>
          <h3>Users Data</h3>
        </center>
        <table border='1'>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>AP</th>
            <th>PP</th>
            <th>TP</th>
          </tr>

          <?php

          while ($row = mysqli_fetch_assoc($result1)) {
            $idd = $row['id'];

            $query4 = "SELECT * FROM posts WHERE user_id = $idd";
            $result4 = mysqli_query($con, $query4);
            $countT = mysqli_num_rows($result4);

            $query5 = "SELECT * FROM posts WHERE user_id = $idd AND state = 1";
            $result5 = mysqli_query($con, $query5);
            $countA = mysqli_num_rows($result5);

            $query6 = "SELECT * FROM posts WHERE user_id = $idd AND state = 0";
            $result6 = mysqli_query($con, $query6);
            $countP = mysqli_num_rows($result6);


            echo "<tr>
                <td style='height:40px'>" . $row['id'] . "</td>
                <td style='height:40px'>" . $row['uname'] . "</td>
                <td style='height:40px'>" . $row['email'] . "</td>
                <td style='height:40px'> $countA </td>
                <td style='height:40px'> $countP </td>
                <td style='height:40px'> $countT </td>
                </tr>";
          }
          ?>


        </table>
        <p>Note: AP= Approved Post, PP= Pending Post, TP= Total Post </p>
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