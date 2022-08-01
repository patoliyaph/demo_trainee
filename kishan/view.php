<?php
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}else{
    echo "connected sucessfully";
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
    <link rel="stylesheet" href="view.css">
    <title>view User details</title>
</head>
<body>
<div class="form-popup" id="myform">
    <form action="#" method="get" class="form-container">
        <h1>View details</h1>
<?php
  while($userdata = mysqli_fetch_array($result))
  {
    //   print_r($userdata) ;
 

?>
      <table>
        <tr>
        <th><label for ="id" class="label">Id</label></th>
        <td><?php  echo $userdata['id']; ?></td>
       </tr>
       <tr>
        <th><label class="label">Name</label></th>
        <td><?php  echo $userdata['name']; ?></td>
        </tr>
        <tr>
        <th><label class="label">Email</label></th>
        <td><?php  echo $userdata['email']; ?></td>
        </tr>
        <tr>
        <th><label class="label">DOB</label></th>
        <td><?php  echo $userdata['DOB']; ?></td>
        </tr>
        <tr>
        <th><label class="label">Gender</label></th>
        <td><?php  echo $userdata['gender']; ?></td>
        </tr>
        <tr>
        <th><label class="label">Photo</label></th>
        <td><img src="<?php  echo $userdata['photo']; ?>" width ="40%"; height="40%";></td>
        </tr>
        </table>
        <br>
        <button><a href ="datatables.php" style = "text-decoration:none;">Close</button>
    </form>
</div>
<?php 
  }

?>
<script>
    function openForm(){
        document.getElementById("myform").style.display = "block";
    }
    function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</body>
</html>
