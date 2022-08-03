<?php
 include 'database.php';
 session_start();
    if(isset($_POST['submit']))
    {  
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $password = MD5($pwd);
        $sql="SELECT * FROM register WHERE Email='$email' AND Password='$password'";
        $result = mysqli_query($conn,$sql);
        if($result->num_rows > 0)
        {
          $row = mysqli_fetch_assoc($result);
          $_SESSION['email'] = $row['email'];
            header("Location:view.php"); 
        }
        else
        {
            $msg = "Invalid Email ID/Password";
        }
    }   
?>  
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <title>Login</title>
   </head>
  <body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
            <div class="shadow-lg p-5 mb-4 bg-body rounded">
                        <div class="login-form">
                            <h2 class="text-center">Login</h2>
                            <form action="" method="post" enctype="multipart/form-data" >
                            <span style="color:red" ><?php echo $msg; ?></span>
                            <div class="form-group">
                                <label>Email</label>
        	                    <input type="email" class="form-control" name="email" placeholder="Email"><br>
                            </div>
		                    <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password"><br>
                            </div>
                            <div class="text-center">
		                    <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success">Login</button>
                            </div><br>
                            </div>
                            <div class="text-center">Don't have an account? <a href="register.php">Register Here</a></div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
  </body>
</html>