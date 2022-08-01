<?php
session_start();
$message = "";
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}else{
    echo "connected successfully";
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "Select * from users where email = '$email' AND password = '$password'";
    $result = mysqli_query($con,$sql);
    $num = mysqli_fetch_array($result);
    // if($num == 1){
    //     echo "you have logged in";
    // }else{
    //     echo "invalid credit";
    // }
    if(is_array($num)){
        $_SESSION["email"]= $num['email'];
        $_SESSION["password"] = $num['password'];
    }else{
        $message = "invalid Email or Password";
    }
}
if(isset($_SESSION["password"])){
    header("Location:datatables.php");
}
?>




<html>
    <head>
    <title>login form</title>
    <link rel="stylesheet" href="style2.css">
    </head>
    <body>
    <div class= "signupFrm">
    <form method="POST" enctype="multipart/form-data">
    <div class="message"><?php if($message!="") { echo $message; } ?></div>    
    <h1>Log In Form</h1>
    <div class="inputContainer">
     <label for="email" class="label">email:</label>
     <input type="email" name="email" placeholder="enter your email address" class="input">
     </div>
     <div class="inputContainer">
     <label for="password" class="label">pwd:</label>
     <input type="password" name="password" placeholder="enter your password" class="input">
     </div>
     <input type="submit" name="sub" value="submit" class="input">
    </div>
    </body>
</html>