<?php
session_start();
include 'config.php';
if(!$_SESSION["email"]){
    header("Location:signin.php");
 }
include 'helper.php';

?>
<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM users WHERE id = $id");

$userdata = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];
    $old_image = $_POST['old_image'];
    $photo = $_FILES['photo']['name'];

    if ($name == "") {
        $error_name = "<span class='error'>Please enter your name</span>";
    } else {
        $name;
    }
    if ($email == "") {
        $error_email = "<span class='error'>Please enter your email</span>";
    } elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
        $error_email = "<span class='error'>Please enter valid email</span>";
    } else {
        $email;
    }
    if ($DOB == "") {
        $error_DOB = "<span class='error'>Please enter your date of birth</span>";
    } else {
        $DOB;
    }
    if ($gender == "") {
        $error_gender = "<span class='error'>choose your gender</span>";
    } else {
        $gender;
    }
    if ($photo == "default") {
        $error_photo = "<span class='error'>please enter your photo</span>";
    } else {
        $photo;
    }
    if ($password == "") {
        $error_name = "<span class='error'>Please enter your password</span>";
    } else {
        $password;
    }
    if ($ConfirmPass == "default") {
        $error_ConfirmPass = "<span class='error'>Please enter your name</span>";
    } else {

        if ($photo != '') {

            $update_filename = "image/" . $_FILES['photo']['name'];
        } else {
            $update_filename = $old_image;
        }


        $update = "UPDATE users SET name = '$name',email = '$email',password = '$password',DOB ='$DOB',gender ='$gender',photo ='$update_filename' WHERE id = '$id'";
        $query_run = mysqli_query($con, $update);


        if ($query_run) {
            if ($_FILES['photo']['name'] != '') {
                $photo = "image/" . $_FILES["photo"]["name"];
                move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
                unlink("image/" . $old_image);
            }
            echo "updated sucessfully";
            header("Location:datatables.php");
        } else {
            echo  "Not updated ";
            header("Location:datatables.php");
        }
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style3.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update your Details</title>
</head>

<body style="background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-1">Update Form</h3>
                </div>
                
                <div class="card-body">
                    <div class="signupFrm">
                        <form method="post" enctype="multipart/form-data" action="" id="updateForm">
                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="form-group row">
                                <label for="name" class="col-lg-2 col-form-label form-control-label">name:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" value=<?php echo  $userdata['name']; ?> class="input form-control" id="name">
                                    <?php echo $error_name; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-lg-2 col-form-label form-control-label">email:</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" value=<?php echo  $userdata['email']; ?> class="input form-control" id="email">
                                    <?php echo $error_email; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-lg-2 col-form-label form-control-label">pwd:</label>
                                <div class="col-lg-9">
                                    <input type="password" name="password" value=<?php echo $userdata['password']; ?> class="input form-control" onKeyUp="checkPasswordStrength();" id="password">
                                    <div id="password-strength-status"></div>
                                    <?php echo $error_password; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-lg-2 col-form-label form-control-label">C.pwd:</label>
                                <div class="col-lg-9">
                                    <input type="password" name="Cpassword" value=<?php echo $userdata['password']; ?> class="input form-control" id="Cpassword">
                                    <?php echo $error_ConfirmPass; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-lg-2 col-form-label form-control-label">DOB:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="DOB" placeholder="enter your date of birth" class="input form-control" value=<?php echo $userdata['DOB']; ?>>
                                    <?php echo $error_DOB; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-lg-2 col-form-label form-control-label">gender</label>
                                <div class="col-lg-9">
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">select your gender!</option>
                                        <option class="input" <?php if ($userdata['gender'] == 'male') {
                                                                    echo 'selected="selected"';
                                                                } ?> value="male">male</option>
                                        <option <?php if ($userdata['gender'] == 'female') {
                                                    echo 'selected="selected"';
                                                } ?> value="female">female</option>
                                    </select>
                                    <?php echo $error_gender; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-lg-2 col-form-label form-control-label">photo</label>
                                <div class="col-lg-9">
                                    <input type="file" name="photo" class="input form-control" id="photo" accept="image/png, image/jpg, image/jpeg">
                                    <input type="hidden" name="old_image" value="<?php echo $userdata['photo']; ?>">
                                </div>
                            </div>
                            <img src="<?php echo $userdata['photo']; ?>" width="100px" height="100px">
                            <div class="form-group row">
                                <div class="col-lg-9">
                                    <input type="submit" name="update" class="btn btn-dark">
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
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


            function checkPasswordStrength() {
                var number = /([0-9])/;
                var alphabets = /([a-zA-Z])/;
                var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
                if ($('#password').val().length < 6) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('weak-password');
                    $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
                } else {
                    if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $(
                            '#password').val().match(special_characters)) {
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


        });

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




        $(document).ready(function() {
            $("#updateForm").validate({
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
                    DOB: {
                        required: true,
                        minAge: 18
                    },
                    gender: {
                        required: true
                    },
                    photo: {
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
                    password: {
                        password: "password should be atleast contain"
                    },
                    DOB: {
                        required: "enter your birthdate",
                        minAge: "You must be at least 18 year"
                    },
                    gender: {
                        required: "select your gender!"
                    },
                    photo: {
                        extension: "please upload file in these format only (jpg,jpeg,png)"
                    }
                }
            });
        });
    </script>

</body>

</html>