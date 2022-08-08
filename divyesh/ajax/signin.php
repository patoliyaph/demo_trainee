<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $sql = "SELECT * FROM user_data WHERE user_email='$email' and user_password='$password'";
    $result = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($result);

    if ($total == 1) {
        $_SESSION['email'] = $email;
        echo '<script type="text/javascript">';
        echo ' alert("sign in successfully")';
        echo '</script>';
        echo '<script>
        window.location.href = "load.php";
        </script>';
    } else {
        echo '<script type="text/javascript">';
        echo ' alert("Login Falied")';
        echo '</script>';
    }
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
    <title>Document</title>
</head>

<body>

    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 mx-auto" style=" box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 17%);">
                    <div class="row  shadow-lg">
                        <div class="col-md-6 d-none d-md-block p-0">
                            <div class="form-img">
                                <img src="images/4.jpg" class="img-fluid" />
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-style">
                                <form action="" enctype="multipart/form-data" class="form" method="post">
                                    <div class="container-fluid">
                                        <h1 class="text-center font-italic"><b>Sign in</b></h1>
                                        <hr>

                                        <div class="form-group">
                                            <label for="email"><b>Email</b></label>
                                            <input type="text" placeholder="Enter Email" class="form-control my-3 py-2" name="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="psw"><b>Password</b></label>
                                            <input type="password" placeholder="Enter Password" class="form-control my-3 py-2" name="psw" required>
                                        </div>

                                        <button type="submit" class="sign btn btn-dark" name="submit" class="form-control my-3 py-2"><b>Sign in</b></button>
                                    </div>
                                    <br>

                                    <br>
                                    <a class="btn btn-success " href="signup.php">Create New Account </a>
                                    <hr>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>


</html>