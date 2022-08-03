<?php
include 'config.php';
error_reporting(E_ALL);

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['psw'];
$cpassword = $_POST['pswrepeat'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$nameErr = $emailErr = $passwordErr = $cpasswordErr = $dobErr = $genderErr = "";
$username = $email = $gender = $password = $cpassword = $dob = $gender = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {

        $nameErr = "username is required";
        header("Location:signup.php?nameErr=username is required");
        $error = true;
    } else {

        $username = test_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $nameErr = "Only letters and white space allowed";
            header("Location:signup.php?nameErr=Only letters and white space allowed");
            $error = true;

        }
    }

    if (empty($_POST["email"])) {

        $emailErr = "Email is required";
        header("Location:signup.php?emailErr=email is required");
        $error = true;

    } else {
        $_POST["email"];

        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            header("Location:signup.php?emailErr=Invalid email format");
            $error = true;

        }
        $sql1 = "SELECT * FROM user_data WHERE user_email='$email'";
        $res = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($res) > 1) {
            echo mysqli_num_rows($res);
            echo $emailErr = "Sorry... email already taken";
            header("Location:signup.php?emailErr=Sorry... email already taken");
            $error = true;

        }

    }

    if (!empty($_POST["psw"]) && ($_POST["psw"] == $_POST["pswrepeat"])) {
        $password = test_input($_POST["psw"]);
        $cpassword = test_input($_POST["pswrepeat"]);
        if (strlen($_POST["psw"]) <= '8') {
            $passwordErr = "Your Password Must Contain At Least 8 Characters!";
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        } elseif (!preg_match("#[a-z]+#", $password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } else {
            $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
            header("Location:signup.php?cpasswordErr=Please Check You've Entered Or Confirmed Your Password!");
            $error = true;

        }
    }

    if (empty($_POST["dob"])) {
        $dobErr = "Birth Date is Required Please";
        header("Location:signup.php?dobErr=Invalid time format");
        $error = true;

    } else {
        $dob = $_POST['dob'];
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        header("Location:signup.php?genderErr=Gender is required");
        $error = true;

    } else {
        // $gender = $_POST['gender'];
        $gender = test_input($_POST["gender"]);
        // header("Location:signup.php?genderErr=ERROR IN Gender");
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_FILES['file']['name'] != '') {

    $filename = $_FILES['file']['name'];

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $valid_extension = array("jpg", "jpeg", "png", "gif");

    if (in_array($extension, $valid_extension)) {

        $new_name = rand() . "." . $extension;
        $path = "images/" . $new_name;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $path) && $error == false) {

            $sql = "INSERT INTO user_data (user_name, user_email, user_password,user_dob,user_gender,user_photo)
 				VALUES ('$username', '$email', '$password', '$dob', '$gender', '$path')";

            $result=mysqli_query($conn, $sql);

            if($result){
                echo '<script>alert("record added success fully!")</script>';
                echo '<script>window.location.href="load.php"</script>';

            }
            else{
            echo '<script>alert("Email alredy exist")</script>';
            echo '<script>window.location.href="signup.php"</script>';
            }
            // header("Location:load.php");   
           

        } else {
            echo "Not uploaded because of error #" . $_FILES["file"]["error"];
        }
    } else {
        echo '<script>alert("INVALIED FILE FORMAT")</script>';
    }
} else {
    echo '<script>alert("PLEASE SELECT MESSAGE")</script>';
    header("Location:signup.php");
}
