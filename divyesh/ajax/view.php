<?php
include 'config.php';
$user_id = $_GET['id'];

$sql = "SELECT * FROM  user_data WHERE user_id= '$user_id' ";
$result = mysqli_query($conn, $sql) or die("query unsuccessful");

$row = mysqli_fetch_assoc($result)
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

    <form action="load.php" id="form" enctype="multipart/form-data" method="post" >
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="view-form">
                        <h1 class="text-center"><b>View data</b></h1>
                        <hr>

                        <div class="form-group">
                            <label for="user_id"><b>user id: </b></label>
                            <label for="username"><?php echo $row['user_id']; ?></label>
                        </div>

                        <div class="form-group">

                            <label for="username"><b>user name:</b></label>
                            <label for="username"><?php echo $row['user_name']; ?></label>
                        </div>

                        <div class="form-group">

                            <label for="Email"><b>Email:</b></label>
                            <label for="email"><?php echo $row['user_email']; ?></label>
                        </div>

                        <div class="form-group">

                            <label for="dob"><b>Date of Birth:</b></label>
                            <label for="dob"><?php echo $row['user_dob']; ?></label>
                        </div>

                        <div class="form-group">
                            <label for="gender"><b>Gender:</b></label>
                            <label for="gender"><?php echo $row['user_gender']; ?></label>
                            <hr>
                        </div>

                        <div class="form-group">
                            <label for="file"><b>photo:</b></label>
                            <img src="<?php echo $row['user_photo']; ?>" width='150px'><br><br>
                        </div>

                        <button type="submit" name="update" id="submit" class="create btn btn-success">Back</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</body>

</html>