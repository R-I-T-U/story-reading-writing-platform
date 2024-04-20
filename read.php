<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Read the books you like !!</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="read.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <style>
        .navbar {
            overflow: hidden;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
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
    </div>

    <!-- content*********************************** -->


    <div class="container">

        <div class="loginHead">
            <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="70px"></a>
            <h1>Read Stories</h1>
        </div>

        <div class="filter">
            <h2>Filter by Genre:</h2>
            <div class="genre">
                <?php
                $con = mysqli_connect("localhost", "root", "", "users");
                if (!$con) {
                    die(mysqli_error($con));
                }
                $query4 = "SELECT * FROM genre";
                $result4 = mysqli_query($con, $query4);
                while ($row = mysqli_fetch_assoc($result4)) {
                    echo "<div>
                            <input type='checkbox' id='" . $row['g_name'] . "' name='genre' value='" . $row['g_name'] . "' onclick='filterPosts()'>
                            <label for='" . $row['g_name'] . "'>" . $row['g_name'] . "</label>
                        </div>";
                }
                ?>
            </div>
            <h2>Filter by Status:</h2>
            <div class="genre">

                <div>
                    <input type="checkbox" id="pending" name="status" value="pending" onclick="filterStatus()">
                    <label for="pending">Pending</label>
                </div>

                <div>
                    <input type="checkbox" id="completed" name="status" value="completed" onclick="filterStatus()">
                    <label for="completed">Completed</label>
                </div>

            </div>
        </div>

        <?php
        $query = "SELECT * FROM posts WHERE state = 1";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $storyTitle = $row['title'];
                $abstract = $row['abstract'];
                $genre = $row['genre'];
                // $language = $row['language'];
                $created = $row['created_at'];
                $updated = $row['updated_at'];
                $status = $row['status'];
                $id = $row['id'];
                $user_id = $row['user_id'];

                $cvrImgPath = "img/ . {$row['cover_image']}";

                $query1 = "SELECT * FROM info where id= $user_id";
                $result1 = mysqli_query($con, $query1);
                $row1 = mysqli_fetch_assoc($result1);
                $profileImgPath = !empty($row1['avatar']) ? 'profileImages/' . $row1['avatar'] : 'images/cat.webp';

                $uname = $row1['uname'];



                echo "
            <div class='storie' id='post_$id' style='display:block;'>
            <div class='pp'>
                <a href='othersProfile.php?user_id=$user_id'><img src='{$profileImgPath}' alt='image' style='border-radius: 50%; width: 40px; height: 40px; object-fit: cover;'></a>
                <p>&nbsp <a href='othersProfile.php?user_id=$user_id' class='noUnderline'>$uname</a> shared a story.</p>
            </div>
            <div class='stori'>
                <div class='left'>
                    <div class='ctitle'>$storyTitle</div>
                    <div class='cdescription'>$abstract</div>
                    <div class='seemore'><a href='seemore.php?id=$id'>See full story</a></div>
                    <div class='cgenre'>Genre: $genre</div> ";

                if ($status == 'pending') {
                    echo "<div style='color:red;' class='cstatus'>Status: $status</div>";
                } else {
                    echo "<div style='color:green;' class='cstatus'>Status: $status</div>";
                };

                echo "
                    <div class='ccreate'>Created at: $created</div>
                    <div class='cupdate'>Edited at: $updated</div>
                    <br><br>
                </div>
                <div class='right'>
                    <div class='cimage'><img src='{$cvrImgPath}' alt='$storyTitle'></div>
                </div>
            </div>
        </div>";
            }
        } else {
            echo "<div class='storie'><p style='height: 10rem; font-size: 2rem;'>Nothing to show</p></div>";
        }

        ?>
        <div class="nopostyet" id="nopostyet">
        </div>
        <center>
            <p id="end">The end!!</p>
        </center>

        <script>
            function confirmLogout() {
                if (confirm("Are you sure you want to log out?")) {
                    window.location.href = "logout.php";
                }
            }

            function filterPosts() {
                var checkboxes = document.getElementsByName('genre');
                var selectedGenres = [];
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selectedGenres.push(checkboxes[i].value);
                    }
                }

                var stories = document.getElementsByClassName('storie');
                var found = false;
                for (var i = 0; i < stories.length; i++) {
                    var genre = stories[i].querySelector('.cgenre').textContent.split(': ')[1].trim();
                    if (selectedGenres.length === 0 || selectedGenres.includes(genre)) {
                        stories[i].style.display = 'block';
                        found = true;
                    } else {
                        stories[i].style.display = 'none';
                    }
                }

                if (!found) {
                    var noStoriesDiv = document.createElement('div');
                    noStoriesDiv.className = 'storie';
                    noStoriesDiv.innerHTML = "<p style='height: 10rem; font-size: 2rem;'>No post yet!!</p>";
                    var nopostyetContainer = document.getElementById('nopostyet');
                    nopostyetContainer.appendChild(noStoriesDiv);

                    // Remove the child node after 10 seconds
                    setTimeout(function() {
                        nopostyetContainer.removeChild(noStoriesDiv);
                    }, 2000); // 10000 milliseconds = 10 seconds
                }
            }

            function filterStatus() {
                var checkboxes = document.getElementsByName('status');
                var selectedStatus = [];
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selectedStatus.push(checkboxes[i].value);
                    }
                }

                var stories = document.getElementsByClassName('storie');
                let found = false;
                for (var i = 0; i < stories.length; i++) {
                    var status = stories[i].querySelector('.cstatus').textContent.split(': ')[1].trim();
                    if (selectedStatus.length === 0 || selectedStatus.includes(status)) {
                        stories[i].style.display = 'block';
                        found = true;
                    } else {
                        stories[i].style.display = 'none';
                    }
                }

                if (!found) {
                    var noStoriesDiv = document.createElement('div');
                    noStoriesDiv.className = 'storie';
                    noStoriesDiv.innerHTML = "<p style='height: 10rem; font-size: 2rem;'>No post yet!!</p>";
                    var nopostyetContainer = document.getElementById('nopostyet');
                    nopostyetContainer.appendChild(noStoriesDiv);

                    // Remove the child node after 10 seconds
                    setTimeout(function() {
                        nopostyetContainer.removeChild(noStoriesDiv);
                    }, 2000); // 10000 milliseconds = 10 seconds
                }

            }
        </script>
</body>

</html>