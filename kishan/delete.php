<?php
$con =mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");
if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}else{
    echo "connected successfully";
}

$id = $_GET['id'];
$result = mysqli_query($con,"DELETE FROM users WHERE id = $id");
header("Location:datatables.php");
?>
