<?php
session_start();
$message = "";
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    if($email == "") {
        $error_email=  "<span class='error'>Please enter your email</span>"; 
        } 
        elseif($password == ""){
            $error_password=  "<span class='error'>Please enter password</span>";
     }else{

    $sql = "Select * from users where email = '$email' AND password = '$password'";
    $result = mysqli_query($con,$sql);
    $num = mysqli_fetch_array($result);
    if(is_array($num)){
        $_SESSION["email"]= $num['email'];
        $_SESSION["password"] = $num['password'];
    }else{
        $message = "<span class='error' style='margin: 130px;'>invalid Email or Password</span>";
    }
}
if(isset($_SESSION["password"])){
    header("Location:datatables.php");
   }  
}
?>


<html>

<head>
    <title>login form</title>
    <link rel="stylesheet" href="style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: #A9C9FF;background-image: linear-gradient(180deg, #A9C9FF 0%, #FFBBEC 100%);">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-1">Log In Form</h1>
                </div>
                <form method="POST" enctype="multipart/form-data" id="loginForm">
                    <div class="message"><?php if($message!="") { echo $message; }?></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-lg-3 col-form-label form-control-label">email:</label>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="enter your email address" class="input">
                                <?php echo $error_email?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-3 col-form-label form-control-label">pwd:</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" placeholder="enter your password" class="input">
                                <?php echo $error_password?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="sub" value="login" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            message: {
                email: {
                    required: "email should be format:abc@xyz.com"
                },
                password: {
                    required: "specify password"
                }
            }
        });
    });
    </script>
</body>

</html>