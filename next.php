<?php
session_start();
$con = mysqli_connect("localhost", "root","","users");
if(!$con){
  die(mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Start writing...</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="write.css">
    <style>
        body {
            background-image: url(images/bg7.jpg);
            background-size: cover;
        }
        #description {
            height: 500px;
        }

        #title{
            margin-left: 69px;
        }
        .container {
            margin-top: 30px;
            border-radius: 20px;
            padding: 16px;
            background-color: rgba(255, 255, 255, 0.9);
        }
        .buttom .next{
            margin-left: 150px;
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
    } else if(isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
        echo '<a href="login.php" class="nav">Login</a>';    
    } else {
        echo '<a href="register.php" class="nav">Sign up</a>';
    }
    ?>
    <a href="" class="nav"><img src="images/noti.jpeg" height="20px"></a>
  </div>

  <!-- content*********************************** -->

    <center>
        <div class="container">
            <form action="" method="POST">
                <div class="loginHead">
                    <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
                    <h1>Start Writing</h1>
                </div>

                <label for="title">Title:
                    <input type="text" id="title" name="story_title" class="form-control" placeholder="E.g.: Episode 1: The sunrise" required></label><br>

                <label for="description">Add your Text: <textarea id="description" name="description" required
                        class="form-control"></textarea></label>
                

                <p><i>Note: you can publish only one chapter or title at a time and it should be completed. <br> For publishing next chapter of the story you have to click on edit button after publishing this one. </i></p>


                <br>
                <div class="buttom">
                <button class="cancel"><a href="read.php">Cancel</a></button>
                <button class="next" name="next">Publish</button>

                <?php
                if (isset($_POST['next'])) {
                    $ctitle = $_POST['story_title'];
                    $cdescription = $_POST['description'];
                    echo $ctitle;
                    
                    
                    $query = "INSERT INTO chapter(chap_title, chap_description) VALUES ('$ctitle', '$cdescription')";
                    $result = mysqli_query($con, $query);
                    
                    if(!$result){
                        echo '<p style="color: red;">Sorry could not publish! Try again later !</p>';
                    } else{
                        header('location: profile.php');
                    }
                }

                mysqli_close($con);
                ?>
            </form>
        </div>
    </center>
</body>

</html>