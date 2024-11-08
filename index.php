<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Welcome to StorySphere!! </title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
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
        <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $con = mysqli_connect("localhost", "root", "", "users");
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $que1 = "SELECT uname, avatar, gender, bio FROM info WHERE id= $userId";
            $res1 = mysqli_query($con, $que1);
            $row = mysqli_fetch_assoc($res1);
            $uname = $row['uname'];
            $avatar = isset($row['avatar']) ? 'profileImages/' . $row['avatar'] : 'images/cat.webp';

            echo '<a href="profile.php" class="nav">  '.$uname .'&nbsp;
            <img src="'. $avatar.'" alt="image" style="border-radius: 50%; width: 40px; height: 40px; object-fit: cover;">
            </a>';
            echo '<a onclick="confirmLogout()" class="nav">Log out</a>';
        } else if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
            echo '<a href="login.php" class="nav">Login</a>';
        } else {
            echo '<a href="register.php" class="nav">Sign up</a>';
        }
        ?>


        <!-- <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a> -->
    </div>

    <!-- content*********************************** -->

    <div class="container">
        <div class="first">
            <img src="images/ssLogo.jpg" alt="logo" height="200px">
            <h1>StorySphere</h1>
        </div>

        <center>
            <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ; font-size: larger; font-size: 25px;">"Where words meet worlds, stories unfold."</p>
        </center>

        <center>
            <div class="start">
                <a href="read.php"><button>Start Reading </button></a>
                <a href="write.php"><button>Start Writing </button></a>
            </div>
        </center>

        <div class="second">
            <img src="images/book.png" height="400px" alt="Magical Book">
            <p><span style="font-family:cursive; font-size: 20px;">"I do believe something very magical can happen, when you read a good book." </span><br><br> <br>Dive into the enchanting world of stories on our platform, where each page unfolds a new adventure and every word is a brushstroke on the canvas of imagination. From gripping tales to poetic expressions, our space is a sanctuary for both avid readers and aspiring writers. Join us on this literary journey where stories come to life, and creativity knows no bounds. Let your mind wander through the written realms, and discover the magic that lies within the art of storytelling.</p>
        </div>
    </div>

    <!-- footer*********************************** -->

    <footer>
        <p>Welcome to StorySphere, where stories unfold and imaginations soar. Dive into a diverse collection of tales from global storytellers, or unleash your creativity by sharing your own. Join our vibrant community and let the magic of storytelling connect us all.</p>
        <div class="copyright">
            <p>&copy; 2024 StorySphere.</p>
        </div>
    </footer>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</body>

</html>