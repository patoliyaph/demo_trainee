<?php

session_start();
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}


if(isset($_POST['sub'])){
    $k = $_POST['name'];
    $f = $_POST['email'];
    $g = $_POST['password'];
    $h =$_POST['DOB'];
    $r = $_POST['gender'];
    $w = $_POST['photo'];

    if($_FILES['photo']['name']){
        move_uploaded_file($_FILES['photo']['tmp_name'],"image/".$_FILES['photo']['name']);

        // echo "Not uploaded because of error #".$_FILES["photo"]["error"];

        $check = "image/".$_FILES['photo']['name'];
    } else {
        echo "Not uploaded because of error #".$_FILES["photo"]["error"];
    }
   
    

    $insert = "insert into users(name,email,password,DOB,gender,photo) values ('$k','$f','$g','$h','$r','$check')";
    // echo $i;
    // echo die();
    if(mysqli_query($con,$insert)){
        echo "record inserted sucessfully";
        header("Location:signin.php");
    }else{
        echo "record not inserted";
    }
    
}
?>





<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title >Sign Up Form</title>
  </head>
  <body style="background-color:#ecfab6;">
  <div class="row justify-content-center">
  <div class="col-md-4">
  <div class="card card-outline-secondary">
    <div class = "card-header">
    <form method="post" enctype="multipart/form-data" >
    <h3 class="mb-1">Sign Up Form</h3>
    </div>
    <div class ="card-body">
    <div class="form-group row">
     <label for="name" class="col-lg-2 col-form-label form-control-label">name:</label>
     <div class="col-lg-9">
     <input type="text" name="name" placeholder="enter your name" class="input">
</div>
</div>
    <div class="form-group row">
     <label for="email" class="col-lg-2 col-form-label form-control-label">email:</label>
     <div class="col-lg-9">
     <input type="email" name="email" placeholder="enter your email address" class="input" >
</div>
     </div>
     <div class="form-group row">
     <label for="password" class="col-lg-2 col-form-label form-control-label">pwd:</label>
     <div class="col-lg-9">
     <input type="password" name="password" placeholder="enter your password" class="input" >
</div>
     </div>
    <div class="form-group row">
     <label for="dob" class="col-lg-2 col-form-label form-control-label">DOB:</label>
     <div class="col-lg-9">
     <input type="text" name="DOB" placeholder="enter your date of birth" class="input">
</div>
     </div>
    <div class="form-group row">
     <label for="gender" class="col-lg-2 col-form-label form-control-label">gender</label>
     <div class="col-lg-9">
     <select name="gender" >
      <option value="male" class="input">male</option>
      <option value="female">female</option>
     </select>
</div>
     </div>
    <div class="form-group row">
            <label for="photo" class="col-lg-2 col-form-label form-control-label">photo</label>
            <div class="col-lg-9">
            <input type="file" name="photo" class="input">
</div>
            </div>
    <div class="form-group row">
    <div class="col-lg-9">
            <input type="submit" name="sub" value="submit" class="btn btn-dark">
</div>
            </div> 
</form>
</div>
</div>
</div>
</div>
</div>
  </body>
</html>