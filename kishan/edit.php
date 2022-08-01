<?php


$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");
if($con->connect_error){
    die("connection failed".$con->connect_error);
}else{
    echo "connected sucessfully";
}
?>
<?php
$id = $_GET['id'];
$result =mysqli_query($con,"SELECT * FROM users WHERE id = $id");

while($userdata = mysqli_fetch_array($result))
{
    $name = $userdata['name'];
    $email = $userdata['email'];
    $password = $userdata['password'];
    $DOB = $userdata['DOB'];
    $gender= $userdata['gender'];
    $photo = $userdata['photo'];
}

   if(isset($_POST['update']))
   {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];
    $old_image = $_POST['old_image'];
    $photo =$_FILES['photo']['name'];
    
    // die();

    if($photo != '')
    {
        $update_filename = "image/".$_FILES['photo']['name'];
    }else{
      $update_filename = $old_image;
    }

   
        $k = "UPDATE users SET name = '$name',email = '$email',password = '$password',DOB ='$DOB',gender ='$gender',photo ='$update_filename' WHERE id = '$id'";
        $query_run = mysqli_query($con,$k);
        echo $query_run;
        
        if($query_run)
        {
            if($_FILES['photo']['name'] !='')
            {
              $photo = "image/".$_FILES["photo"]["name"];
                move_uploaded_file($_FILES["photo"]["tmp_name"],$photo);  
                unlink("image/".$old_image);  
            }
            echo "updated sucessfully";
            header("Location:datatables.php");
        }else{
          echo  "Not updated ";
          header("Location:datatables.php");
        }
   }


?>



<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Update your Details</title>
  </head>
  <body>
    <div class= "signupFrm">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $id?>">
    <h1>Update Form</h1>
    <div class="inputContainer">
     <label for="name" class="label">name:</label>
     <input type="text" name="name" value=<?php echo $name?> class="input">
</div>
    <div class="inputContainer">
     <label for="email" class="label">email:</label>
     <input type="email" name="email" value=<?php echo $email?> class="input">
     </div>
    <div class="inputContainer">
     <label for="password" class="label">pwd:</label>
     <input type="password" name="password" value = <?php echo $password?> class="input">
     </div>
    <div class="inputContainer">
     <label for="dob" class="label">DOB:</label>
     <input type="text" name="DOB" placeholder="enter your date of birth" class="input" value=<?php echo $DOB?>>
     </div>
    <div class="inputContainer">
     <label for="gender" class="label">gender</label>
     <select name="gender">
      <option  class="input" <?php if($gender == 'male'){echo 'selected="selected"';}?> value="male">male</option>
      <option  <?php if($gender == 'female'){echo 'selected="selected"';}?> value="female">female</option>
     </select>
     </div>
     <?php echo $photo; ?>
    <div class="inputContainer">
            <label for="photo" class="label">photo</label>
            <input type="file" name="photo" class="input" >
            <input type="hidden" name="old_image" value="<?php echo $photo?>">
            </div>
            <img src="<?php echo $photo; ?>" width = "100px" height ="100px">
    <div class="inputContainer">
            <input type="submit" name="update"  class="input">
            </div> 
</form>
</div>
  </body>
</html>
