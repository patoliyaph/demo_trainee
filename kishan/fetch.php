<?php

 $con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

 $result = "SELECT*FROM users";
 $query = mysqli_query($con,$result);
$result_array =[];
 if(mysqli_num_rows($query)>0)
 {
    foreach($query as $row)
    {
        array_push($result_array,$row);
    }
      header('Content-type:application/json');
      echo json_encode($result_array);
 }else{
    $return = "<h4>No record found</h4>";
 }
?>