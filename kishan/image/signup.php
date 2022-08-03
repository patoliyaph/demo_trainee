<?php

session_start();
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}


if(isset($_POST['submit'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $DOB =trim($_POST['DOB']);
    $gender = trim($_POST['gender']);
    $photo = trim($_POST['photo']);
    $ConfirmPass = trim($_POST['Cpassword']);
    
    if($name ==""){
        $error_name = "<span class='error'>Please enter your name</span>";
    }
    elseif($email ==""){
        $error_email = "<span class='error'>Please enter your email</span>";
    }
    elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$email)){
        $error_email = "<span class='error'>Please enter valid email</span>";
    }
    elseif($DOB ==""){
        $error_DOB = "<span class='error'>Please enter your date of birth</span>";
    }
    elseif($gender ==""){
        $error_gender = "<span class='error'>choose your gender</span>";
    }
    elseif($photo =="default"){
        $error_photo = "<span class='error'>please enter your photo</span>";
    }
    elseif($password ==""){
        $error_name = "<span class='error'>Please enter your password</span>";
    }
    elseif($ConfirmPass ==""){
        $error_ConfirmPass = "<span class='error'>Please enter your name</span>";
    }
    elseif($password !=$ConfirmPass){
        $error_ConfirmPass = "<span class='error'>Password and confirm password does not match</span>";
    }
    else{
        
   
    if($_FILES['photo']['name']){
        move_uploaded_file($_FILES['photo']['tmp_name'],"image/".$_FILES['photo']['name']);

        // echo "Not uploaded because of error #".$_FILES["photo"]["error"];

        $check = "image/".$_FILES['photo']['name'];
    } else {
        echo "Not uploaded because of error #".$_FILES["photo"]["error"];
    }
    
        $insert = "insert into users(name,email,password,DOB,gender,photo) values ('$name','$email','$password','$DOB','$gender','$check')";
    // echo $i;
    // echo die();
    if(mysqli_query($con,$insert)){
        echo "record inserted sucessfully";
        header("Location:datatables.php");
    }else{
        echo "record not inserted";
    }
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
    <title>Sign Up Form</title>
</head>

<body style="background-color:#ecfab6;">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-1">Sign Up Form</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data" id="signupForm">
                        <div class="form-group row">
                            <label for="name" class="col-lg-2 col-form-label form-control-label">name:</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" placeholder="enter your name" class="input" id="name">
                                <?php echo $error_name;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-2 col-form-label form-control-label">email:</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" placeholder="enter your email address" class="input">
                                <?php echo $error_email;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-2 col-form-label form-control-label">pwd:</label>
                            <div class="col-lg-9">
                                <input type="password" name="password" placeholder="enter your password" class="input"
                                    onKeyUp="checkPasswordStrength();" id="password" />
                                <?php echo $error_password;?>
                                <div id="password-strength-status"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-2 col-form-label form-control-label"> c.pwd:</label>
                            <div class="col-lg-9">
                                <input type="password" name="Cpassword" placeholder="enter your password" class="input"
                                    id="Cpassword">
                                <?php echo $error_ConfirmPass;?>
                                <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-lg-2 col-form-label form-control-label">DOB:</label>
                            <div class="col-lg-9">
                                <input type="date" name="DOB" placeholder="enter your date of birth" class="input">
                                <?php echo $error_DOB;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-lg-2 col-form-label form-control-label">gender</label>
                            <div class="col-lg-9">
                                <select name="gender" id="gender">
                                    <option value="">Choose Gender</option>
                                    <option value="male" class="input">male</option>
                                    <option value="female">female</option>
                                </select>
                                <?php echo $error_gender;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-lg-2 col-form-label form-control-label">photo</label>
                            <div class="col-lg-9">
                                <input type="file" name="photo" class="input" accept="image/png, image/jpg, image/jpeg">
                                <?php echo $error_photo;?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9">
                                <input type="submit" name="submit" value="submit" class="btn btn-dark">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
    function checkPasswordStrength() {
        var number = /([0-9])/;
        var alphabets = /([a-zA-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        if ($('#password').val().length < 6) {
            $('#password-strength-status').removeClass();
            $('#password-strength-status').addClass('weak-password');
            $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
        } else {
            if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val()
                .match(special_characters)) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('strong-password');
                $('#password-strength-status').html("Strong");
            } else {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('medium-password');
                $('#password-strength-status').html(
                    "Medium (should include alphabets, numbers and special characters.)");
            }
        }
    }

    $(document).ready(function() {
        $("#Cpassword").on('keyup', function() {
            var password = $("#password").val();
            var Cpassword = $("#Cpassword").val();

            if (password != Cpassword) {
                $("#CheckPasswordMatch").html("password does not match !").css("color", "red");
            } else {
                $("#CheckPasswordMatch").html("password match !").css("color", "green");
            }
        });
    });

    $.validator.addMethod("minAge", function(value, element, min) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();

        if (age > min + 1) {
            return true;
        }

        var m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age >= min;
    }, "You must be at least 18 year!");

    $(document).ready(function() {
        $("#signupForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
                Cpassword: {
                    required: true,
                },
                DOB: {
                    required: true,
                    minAge: 18
                },
                gender: {
                    required: true,
                },
                photo: {
                    required: true,
                    extension: "jpg|jpeg|png"
                }

            },
            message: {
                name: {
                    minlength: "Name should be at least 3 Character"
                },
                email: {
                    email: "email should be format :abc@domain.tld"
                },

                DOB: {
                    required: "enter your birthdate",
                    minAge: "You must be at least 18 year"
                },
                photo: {
                    required: "please upload file",
                    extension: "please upload file in these format only (jpg,jpeg,png)"
                }
            }
        });
    });
    </script>
</body>

</html>