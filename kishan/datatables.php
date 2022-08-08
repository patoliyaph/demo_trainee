<?php
include 'config.php';
session_start();
if(!$_SESSION["email"]){
   header("Location:signin.php");
}
include 'helper.php';



$result = mysqli_query($con, "SELECT*FROM users");
?>
<?php
if ($_SESSION["email"]) {
?>
    welcome <?php echo $_SESSION["email"]; ?>.click herer to <a href="logout.php" title="Logout" class="btn btn-warning ms-2">Logout.</a>
    <a href="change_password.php" class="btn btn-warning ms-2">change password</a>
<?php
} else {
    "<h1>Please login first.<h1>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Users List</title>
    <link rel="stylesheet" href="datatable.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
</head>

<body>




    <?php

    if (mysqli_num_rows($result) > 0) {
    ?>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-1 pb-1">User Details</h3>
                        </div>
                        <table class="table " id="myTable" style="color:#6666ff;">
                            <thead style="background:#b9efb9;">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Photo</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr style="background-color:#f2f2f2;">
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo date('d/m/y', strtotime($row['DOB'])); ?></td>
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><img src="<?php echo $row['photo']; ?>" class="photo" width="100px" height="100px">
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-warning"><?php echo '<a href="view.php?id=' . $row['id'] . '" style="text-decoration:none;"/>' ?>view</button>
                                            <button class="btn btn-outline-warning"><?php echo '<a href="edit.php?id=' . $row['id'] . '" style="text-decoration:none;"/>' ?>edit</button>
                                            <button class="btn btn-outline-warning" onclick="return confirm('Are you want to delete?')"><?php echo '<a href="delete.php?id=' . $row['id'] . '" style="text-decoration:none;"/>' ?>delete</button>
                                          
                                        </td>
                                    </tr>
                                    
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
        echo "no result found";
    }

    ?>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js">
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>


</body>

</html>