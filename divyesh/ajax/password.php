<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:signin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>password</title>
</head>

<body>
    <?php
    include 'config.php';

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $opassword = $_POST['opsw'];
        $npassword = $_POST['npsw'];
        $cpassword = $_POST['cpsw'];

        $sql = "SELECT user_email,user_password	FROM user_data WHERE user_email='$email' and user_password='$opassword'";
        $result = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($result);

        if ($total > 0) {
            $sql2 = "UPDATE user_data SET user_password='$npassword' WHERE user_email='$email'";
            $result1 = mysqli_query($conn, $sql2);
            echo '<script type="text/javascript">';
            echo ' alert("Password Change successfully")';
            echo '</script>';
            echo '<script>
            window.location.href = "signin.php";
            </script>';
        } else {
            echo '<script type="text/javascript">';
            echo ' alert("old password wrong")';
            echo '</script>';
            echo '<script>
            window.location.href = "password.php";
            </script>';
        }
    }
    ?>
    <div class="main">
        <div class="container-fluid">
            <div class="row shadow-lg">

                <div class="col-md-4 mx-auto">
                    <div class="form-style">
                        <form action="" id="form" enctype="multipart/form-data" class="form" method="post">
                            <div class="container-fluid">
                                <div class="signup-form">
                                    <h1 class="text-center"><b>Change Password</b></h1>
                                    <hr>
                                    <div class="form-group">
                                        <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="psw"><b>Old Password</b></label>
                                        <input type="password" placeholder="Old Password" class="form-control my-3 py-2" name="opsw" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="psw"><b> New Password</b></label>
                                        <input type="password" placeholder="New Password" class="form-control my-3 py-2" id="npsw" name="npsw" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="psw"><b>Confirm Password</b></label>
                                        <input type="password" placeholder="Confirm Password" id="cpsw" class="form-control my-3 py-2" name="cpsw" required>
                                    </div>

                                    <button type="submit" class="sign" name="submit" class="btn btn-infoform-control my-3 py-2"><b>update</b></button>
                                </div>
                                <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>


</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
    $.validator.addMethod("PASSWORD", function(value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
    }, "Passwords are 8-16 characters with uppercase letters, lowercase letters and at least one number.");



    $(document).ready(function() {
        $('#form').validate({
            rules: {
                npsw: {
                    required: true,
                    PASSWORD: true,
                    minlength: 8
                },
                cpsw: {
                    required: true,
                    equalTo: "#npsw"
                },
            },
            messages: {
                npsw: {
                    required: 'Please enter Password.',
                    minlength: 'Password must be at least 8  characters long.',
                },
                cpsw: {
                    required: 'Please enter Confirm Password.',
                    equalTo: 'Confirm Password do not match with Password.',
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>