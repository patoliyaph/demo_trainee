<?php
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");
session_start();
if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}else{
    echo "connected successfully";
}
$result = mysqli_query($con,"SELECT*FROM users");
?>
 <?php
            if($_SESSION["email"]){
        ?>
        welcome <?php echo $_SESSION["email"];?>.click herer to <a href="logout.php" title ="Logout">Logout.</a>
            <?php
            }else "<h1>Please login first.<h1>";
            ?>

<!DOCTYPE html>
<html>
    <head>
        <title>All Users List</title>
        <link rel="stylesheet" href="datatable.css">
    </head>
    <body>
        <?php
        
           if(mysqli_num_rows($result)>0){
        ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Photo</th>
                <th>action</th>
            </tr>
            <?php
             $i = 0;
             while($row = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['DOB']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><img src ="<?php echo $row['photo'];?>" class="photo" ></td>
                <td>
                    <button><?php echo '<a href="view.php?id='.$row['id'].'" style="text-decoration:none;"/>'?>view</button>
                  
                    <button><?php echo '<a href="edit.php?id='.$row['id'].'" style="text-decoration:none;"/>'?>edit</button>
                    <button><?php echo '<a href="delete.php?id='.$row['id'].'" style="text-decoration:none;"/>'?>delete</button>
                </td>
            </tr>
            <?php
            $i++;
           }
            ?>
        </table>
        <?php
           }else{
            echo "no result found";
           }

        ?>
        
    </body>
</html>
