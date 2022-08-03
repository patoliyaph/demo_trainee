<?php
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}
$id = $_GET['id'];
$result = mysqli_query($con,"SELECT * FROM users where id= $id");

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>view User details</title>
</head>

<body>
    <div class="form-popup" id="myform">
        <form action="#" method="get" class="form-container">

            <?php
  while($userdata = mysqli_fetch_array($result))
  {
    //   print_r($userdata) ;
 

?>
            <section class="vh-100" style="background-color: #f4f5f7;">
                <h1 class="title">View details</h1>
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-lg-6 mb-4 mb-lg-0">
                            <div class="card mb-3" style="border-radius: .5rem;">
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white"
                                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                        <img src="<?php  echo $userdata['photo']; ?>" width="70%" ; height="70%"
                                            class="img-fluid my-5" ;>
                                        <h5><?php  echo $userdata['name']; ?></h5>
                                        <i class="far fa-edit mb-5"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-4">
                                            <h6>User Details</h6>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-6 mb-3">
                                                    <h6>id</h6>
                                                    <p class="text-muted"><?php  echo $userdata['id']; ?></p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <h6>Email</h6>
                                                    <p class="text-muted"><?php  echo $userdata['email']; ?></p>
                                                </div>
                                            </div>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-6 mb-3">
                                                    <h6>Gender</h6>
                                                    <p class="text-muted"><?php  echo $userdata['gender']; ?></p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <h6>Dob</h6>
                                                    <p class="text-muted"><?php  echo $userdata['DOB']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="datatables.php" style="text-decoration:none;" class="btn btn-primary">Close</a>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <?php 
  }

?>
</body>

</html>