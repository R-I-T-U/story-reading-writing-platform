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
    <title>Admin| Post Request</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="ad.css">
    <link rel="stylesheet" href="profile.css">
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
                <li class="sidebar-list-item">
                    <a href="adpostReq.php">
                        <span class="material-icons-outlined">groups</span> Post Request
                    </a>
                </li>

            </ul>
        </aside>
        <main class="main-container">
            <div class="main-title">
                <h2>POST REQUEST</h2>
            </div>
            <div class="admin-panel">


                <?php
                $query = "SELECT * FROM posts WHERE state = 0";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $storyTitle = $row['title'];
                    $abstract = $row['abstract'];
                    $genre = $row['genre'];
                    $description = $row['description'];
                    $status = $row['status'];
                    $id = $row['id'];
                    $user_id = $row['user_id'];
                    $state = $row['state'];
                    $cvrImgPath = "img/ . {$row['cover_image']}";

                    $query1 = "SELECT * FROM info where id= $user_id";
                    $result1 = mysqli_query($con, $query1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $profileImgPath = !empty($row1['avatar']) ? 'profileImages/' . $row1['avatar'] : 'images/ppp.png';

                    $uname = $row1['uname'];

                   
                        echo "
            <div class='storie' id='post_$id' style='display:block;'>
            <div class='pp'>
                <a href='$profileImgPath'><img src='{$profileImgPath}' alt='image' style='border-radius: 50%; width: 40px; height: 40px; object-fit: cover;'></a>
                <p>&nbsp $uname shared a story.</p>
            </div>
            <div class='stori'>
                <div class='left'>
                    <div class='ctitle'>Title: $storyTitle</div>
                    <div class='cgenre'><b>Genre:</b> $genre</div>
                    <div class='cstatus'><b>Status:</b> $status</div>
                    <div class='cdescription'><b>Sypnosis:</b><br> $abstract</div>
                    
                    <br>
                </div>
                <div class='right'>
                    <div class='cimage'><img src='{$cvrImgPath}' alt='$storyTitle' style='width: 250px; height: 250px; object-fit: cover;'></div><br>
                   
                </div>
                <div class='cdescription'><b>Descrition:</b><br> $description</div><br>
                <div style='display: flex;'>
                <a href='adaccept.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Accept</button>
                   </div>
               </a> <br>
               <a href='adreject.php?id=$id '>
                   <div><button style='margin-right: 20px;'>Reject</button>
                   </div>
               </a>
               </div>
            </div><hr>";
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