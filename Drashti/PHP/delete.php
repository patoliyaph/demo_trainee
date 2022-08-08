<?php
include'database.php';
    if(isset($_GET['id']))
    {
        $id= $_GET['id'];
        $query="DELETE FROM register where id =$id";
        $sql=mysqli_query($conn,$query);
        header ("Location: view.php");
    }
?>