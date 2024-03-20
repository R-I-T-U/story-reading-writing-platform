<?php
include 'connection.php'; 
        if(isset($_GET['id'])) {
            $postId = $_GET['id'];
            $_SESSION['postId'] = $postId;

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
                            
                    $query1 = "SELECT * FROM chapter WHERE post_id = $postId"; 
                    $result1 = mysqli_query($con, $query1);

                    if ($result1) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $chap_title = $row1['chap_title'];
                            $chap_description = $row1['chap_description'];                            
                        }
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <style>
        .navbar {
            overflow: hidden;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
        }

        main {
            margin: 20px;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .story {
            height: 60rem;
            width: 60rem;
            margin-left: 7rem;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            background-color: white;
            z-index: 1;
            margin-bottom: 20px;
            background: linear-gradient(120deg, #89a7cc 0%, rgb(50, 20, 100) 100%);
        }

        .ctitle {
            display: flex;
            justify-content: center;
            font-size: 30px;
            font-family: cursive;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .last {
            margin-left: 7rem;
            background-color: white;
            z-index: 1;
            margin-bottom: 20px;
            margin-right: 8rem;
            border-radius: 5px;
        }

        #cmt {
            margin-top: 5px;
            margin-bottom: 5px;
            height: 2rem;
            width: 45rem;
            margin-left: 20px;
        }

        #report {
            font-size: auto;
            padding: none;
            border: none;
            color: gray;
            border: none;
            box-shadow: none;
            background: none;
            border-radius: none;
            cursor: pointer;
            text-decoration: underline;
        }
        .cmt{
            margin-left: 20px;
            margin-right: 32px;
        }
        #singleCmt{
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
        if (isset($_SESSION['user_id'])) {
            echo '<a href="profile.php" class="nav">Profile</a>';
        } else if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
            echo '<a href="login.php" class="nav">Login</a>';
        } else {
            echo '<a href="register.php" class="nav">Sign up</a>';
        }
        ?>
        <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a>
    </div>

    <!-- content*********************************** -->

    <div class="container">

        <div class="loginHead">
            <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="70px"></a>
            <h1>Story Chapters</h1>
        </div>
        <div class='story'>
            <div class='left'>
                <div class='ctitle'><?php echo isset($chap_title) ? $chap_title : ''; ?></div>
                <div class='cdescription'><?php echo isset($chap_description) ? $chap_description : ''; ?></div>
                <br><br>
            </div>
        </div>

        <div class="last">
            <form action="insertCmt.php" method="POST">
                <input type="text" name="cmt" id="cmt">
                <button type="submit" name='add'>Add comment</button>
            </form>
            <div class="cmt">
                <?php
                $pid = $_SESSION['postId'] ;
                $query2 = "SELECT * FROM comment WHERE post_id = $pid";
                $result2 = mysqli_query($con, $query2);
                if($result2){
                    while($row = mysqli_fetch_assoc($result2)){
                        echo "<form method='POST' action='reportCmt.php'>
                        <input type='number' value = ".$row['cmt_id']."  hidden name='cmt_id'>
                        <p id='singleCmt'>" . $row['cmt'] . " 
                        <button id='report' type='submit' name='report'> report</button>
                        <br></p>
                        </form>";
                    }
                }else {
                    echo "No comments available.";
                }
                ?>
            </div>

        </div>

        </form>

        <center>
            <p id="end">The end!!</p>
        </center>
    </div>

</body>

</html>