<?php
include 'database.php';
$id = $_GET['id'];
$query = "SELECT * FROM register WHERE id=$id";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);
$name = $row['name'];
$email = $row['email'];
$dob = $row['dob'];
$gender = $row['gender'];
$image = $row['image'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <title>view record</title>
        <body>
        <div class="container my-5">
          <div class="col-md-5 mx-auto">
          <div class="shadow-lg p-4 mb-4 bg-body rounded">
              <h2 class="text-center">View Record</h2>
              <form method="post"  enctype="multipart/form-data">
                  <div class="form-group">
                    <label>ID :</label> 
                    <td><?php echo $row['id'];?></td>
                  </div><br>
                  <div class="form-group">
                    <label>Name :</label>
                    <td><?php echo $row['name'];?></td>
                  </div><br> 
                  <div class="form-group">
                    <label>Email :</label>
                    <td><?php echo $row['email'];?></td>
                  </div><br> 
                  <div class="form-group">
                    <label>DOB :</label>
                   <?php echo $row['dob'];?>
                  </div><br>
                  <div class="form-group">
                    <label>gender :</label>
                   <td><?php echo $row['gender'];?></td>
                  </div><br>         
                  <div class="form-group">
                    <label>image :</label>
                    <td><img src="upload/<?php echo $row['image'];?>"  name="image" width="100" height="100"></td>
                  </div> <br>
                  <div class="text-left">
                  <div class="form-group">
                  <a href="view.php" class='btn btn-dark'>back</a>
                </div> 
                  </div> 
                  </form>
          </div>
              </div>
            </div>
          </div>
        </div>  
          </div>
      </div>
  
        </body>
    </head>
</html>