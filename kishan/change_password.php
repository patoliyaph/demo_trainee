<?php

session_start();
$id = session_id();
$email = $_SESSION['email'];


include 'config.php';
if (!isset($_SESSION['email'])) {
    header('location:signin.php');
}

if ($_POST['submit']) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];
    $password_query = mysqli_query($con, "SELECT*FROM users where email = '$email'");
    $password_row = mysqli_fetch_array($password_query);
    $database_password = $password_row['password'];

    if ($database_password == $old_password) {
        if ($new_password == $retype_password) {
            $update_pwd = mysqli_query($con, "UPDATE users set password='$new_password' where email='$email'");
            echo "<script>alert('Update Sucessfully'); window.location='datatables.php'</script>";
        } else {
            echo "<script>alert('Your new and Retype Password is not match'); window.location='datatables.php'</script>";
        }
    } else {
        echo "<script>alert('Your old password is wrong'); window.location='datatables.php'</script>";
    }
}


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="change.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Change Password</title>
</head>

<body style="background-color:#c5e9ff;">
    <div class="container" style="margin-top:40px;">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="mb-1">Change Password</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="form-row">
                                <div class="form-group row">
                                    <label for="Old-password" class="col-lg-4 col-form-label form-control-label"
                                        style="text-align: center;">Old Password</label>
                                    <div class="col-lg-12">
                                        <input type="password" name="old_password" placehoder="enter your old password"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group row">
                                    <label for="New-password" class="col-lg-4 col-form-label form-control-label"
                                        style="text-align: center;">New Password</label>
                                    <div class="col-lg-12">
                                        <input type="password" name="new_password" placeholder="enter your new password"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group row">
                                    <label for="Retype-password"
                                        class="col-lg-6 col-form-label form-control-label">Retype password</label>
                                    <div class="col-lg-12">
                                        <input type="password" name="retype_password"
                                            placeholder="re-enter your password" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-lg-9">
                                        <input type="submit" value="submit" name="submit" class="btn btn-warning">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>