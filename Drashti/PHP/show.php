<?php
include 'database.php';
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-UA-Compatible" content="ie=edge">
    <title>DataTable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</head>

<body>
    <div class="container my-5">
        <div class="alert alert-Success mt-3 text-center">
            All Record Show Using Datatable
        </div>
        <div class="text-center"><a href="register.php" class="btn btn-info">Add</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM register";
                $sql = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($sql)) {
                    echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["dob"] . "</td>
                                <td>" . $row["gender"] . "</td>
                                <td><img src=upload/" . $row["image"] . " widhth=100px height=100px ></td>
                                <td><a href=view1.php?id=" . $row["id"] . " class='btn btn-info'>View</a>
                                    <a href=edit.php?id=" . $row["id"] . " class='btn btn-success'>Edit</a>
                                    <a href=delete.php?id=" . $row["id"] . " onclick='myFunction()' class='btn btn-danger'>Delete</a>
                                </td>
                                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>