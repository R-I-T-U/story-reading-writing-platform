<?php
include 'connection.php';
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $_SESSION['postId'] = $postId;

    if (isset($_SESSION['user_id'])) {

        $query = "SELECT * FROM posts WHERE id= $postId";
        $result = mysqli_query($con, $query);


        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $storyTitle = $row['title'];
            $description = $row['description'];
            $cvrImgPath = "img/ . {$row['cover_image']}";
            $status = $row['status'];
            $user_id = $row['user_id'];

            $query1 = "SELECT * FROM info where id= $user_id";
            $result1 = mysqli_query($con, $query1);
            $row1 = mysqli_fetch_assoc($result1);
            $profileImgPath = !empty($row1['avatar']) ? 'profileImages/' . $row1['avatar'] : 'images/ppp.png';
            $uname = $row1['uname'];
        } else {
            echo "Error fetching chapter: " . mysqli_error($con);
        }
    } else {
        echo "Please log in to view your chapters.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Read the books you like !!</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="seemore.css">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="profile.css"> -->


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

    <div class="con">

        <div class='story'>
            <div class='left'>
                <div class='image'><?php echo "<a href='$cvrImgPath' ><img src='{$cvrImgPath}' alt='{$storyTitle}'></a>" ?></div>
                <div class='pp'>
                    <a href='<?php echo $profileImgPath; ?>'><img src='<?php echo $profileImgPath; ?>' alt='image' style='border-radius: 50%; width: 40px; height: 40px; object-fit: cover;'></a>
                    <p>&nbsp <?php echo $uname; ?></p>
                    
                </div>
                
                <div class='ctitle'>
                    <h2><?php echo $storyTitle; ?></h2>
                </div>
                <div class='cdescription'><?php echo $description; ?></div>
                <br><br>
                
                <hr width="60%">
            </div>
            <div class="last">
                <form action="insertCmt.php" method="POST">
                    <input type="text" name="cmt" id="cmt">
                    <button type="submit" name='add'>Add comment</button>
                </form>
                <div class="cmt">
                    <?php
                    $pid = $_SESSION['postId'];
                    $query2 = "SELECT * FROM comment WHERE post_id = $pid";
                    $result2 = mysqli_query($con, $query2);
                    if(mysqli_num_rows($result2)==0){
                        echo "<div class='cpp' id='singleCmt'> <br><br>No comments available.</div>";
                    }
                    if ($result2) {
                        while ($row = mysqli_fetch_assoc($result2)) {
                            $user_id = $row['user_id'];
                            $query1 = "SELECT * FROM info where id= $user_id";
                            $result1 = mysqli_query($con, $query1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $profileImgPath = !empty($row1['avatar']) ? 'profileImages/' . $row1['avatar'] : 'images/ppp.png';
                            $uname = $row1['uname'];

                            if($user_id === $userId){
                                echo "<form method='POST' action='OwnCmt.php'>
                        <div class='cpp' id='singleCmt'>
                        <a href='$profileImgPath'><img src='$profileImgPath' alt='image' style='border-radius: 50%; width: 30px; height: 30px; object-fit: cover;'></a><p>&nbsp $uname
                        commented '" . $row['cmt'] . "'.
                        <input type = 'number' value = ".$row['cmt_id']." name = 'cmtId' hidden>
                        <button id='report' type='submit' name='delete'> delete</button>
                        <br></p></div>
                        </form>";

                            } else{
                                echo "<form method='POST' action='reportCmt.php'>
                        <input type='number' value = " . $row['cmt_id'] . "  hidden name='cmt_id'>
                        <div class='cpp' id='singleCmt'>
                        <a href='$profileImgPath'><img src='$profileImgPath' alt='image' style='border-radius: 50%; width: 30px; height: 30px; object-fit: cover;'></a><p>&nbsp $uname
                        commented '" . $row['cmt'] . "'.
                        <button id='report' type='submit' name='report'> report</button>
                        <br></p></div>
                        </form>";
                            }

                            
                        }
                    } 
                    ?>
                </div>

            </div>
            <center>
                <p id="end">The end!!</p>
            </center>

        </div>

    </div>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</body>

</html>