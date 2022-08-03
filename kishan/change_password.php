<?php

session_start();
$id=$_SESSION["id"];

$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");
if(!$con){
    echo "could not connect to database";
}else{
    echo "database connected";
};

if(count($_POST)>0){
    $result = mysqli_query($con,"SELECT*FROM users WHERE ='" .$id."'");
    // echo $result;
    // die();
    $row = mysqli_fetch_array($result);
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

<body>
    <div class="container" style="margin-top:40px;">
        <div class="form-row">
            <div class="form-group">
                <div class="header">
                    <p class="horizontal-heading">Change Password</p>
                </div>
                <div class="changePassword">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="Old-password">Old Password</label>
                                <input type="text" name="old-password" placehoder="enter your old password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="New-password">New Password</label>
                                <input type="text" name="new_password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="Retype-password">Retype password</label>
                                <input type="text" name="retype_password">
                            </div>
                            <div class="form-group">
                                <input type="button" value="submit" name="submit">
                            </div>
                        </div>
                        
                    </form>
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