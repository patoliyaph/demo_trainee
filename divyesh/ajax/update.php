<?php
include 'config.php';

if (isset($_POST['update'])) {

    $user_id = $_POST["userid"];
    $user_name = $_POST["username"];
    $user_email = $_POST["email"];
    $password = $_POST['psw'];
    $cpassword = $_POST['pswrepeat'];
    $user_dob = $_POST['dob'];
    $user_gender = $_POST["gender"];
    $new_img = $_FILES['newfile']['name'];
    $old_img = $_POST["oldfile"];

    if ($new_img != '') {
        $update_file = "images/" . $_FILES['newfile']['name'];
    } else {
        $update_file = $old_img;
    }

    $sql = "UPDATE user_data SET user_name  = '$user_name', user_email = '$user_email',user_password = '$password', user_dob  = '$user_dob', user_gender = '$user_gender',user_photo  = '$update_file' WHERE user_id='$user_id'";

    $result = mysqli_query($conn, $sql) ;
    

    if ($result) {
        if ($_FILES['newfile']['name'] != '') {
            if (move_uploaded_file($_FILES['newfile']['tmp_name'], $update_file)) {
                unlink($old_img);
            }
        }
        echo 'update successfully';
        header("Location:load.php");

    } else {
        echo 'data can not be saved, please try again after some time';
    }
}
