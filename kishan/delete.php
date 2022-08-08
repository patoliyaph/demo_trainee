<?php
include 'config.php';

$id = $_GET['id'];
$result = mysqli_query($con,"DELETE FROM users WHERE id = $id");
header("Location:datatables.php");
?>
