<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $oldImage = $row['avatar'];
    $oldImageSrc = "profileImages/ . $oldImage";

    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $avatar = $_FILES['profileImage']['name'];

    $bio = $_POST['bio'];
    $gender = $_POST['gender'];

    if (!empty($avatar)) {
        $avatar_tmp = $_FILES['profileImage']['tmp_name'];
        $avatar_path = 'profileImages/' . $avatar;
        $query = "UPDATE info SET uname='$uname', email='$email', avatar='$avatar', bio='$bio', gender='$gender' WHERE id=$userId";
        $result = mysqli_query($con, $query);

        if ($result) {
            unlink($oldImageSrc);
            move_uploaded_file($avatar_tmp, $avatar_path);
            header("Location: profile.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        $query = "UPDATE info SET uname='$uname', email='$email', bio='$bio', gender='$gender' WHERE id=$userId";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
