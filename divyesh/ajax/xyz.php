<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>



    <title>Document</title>
</head>

<body>
    <div class="container my-5">

        <form action="" method="POST">

            <h1 align="center">All Records</h1>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th width="100px">ID</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>dob</th>
                        <th>gender</th>
                        <th>photo</th>
                        <th width="100px">Edit</th>
                        <th width="100px">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

$sql = "SELECT * FROM user_data ";
$result = mysqli_query($conn, $sql) or die("query unsuccessful");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td> {$row["user_id"]}</td>
            <td>{$row["user_name"]}</td>
            <td>{$row["user_email"]}</td>
            <td>{$row["user_dob"]}</td>
            <td>{$row["user_gender"]}</td>
            <td><img src=" . $row['user_photo'] . " width='100px'></td>
            <td><a href='edit.php?id={$row["user_id"]}' class='edit-btn btn btn-success' >edit</a></td>
            <td><button class='delete-btn btn btn-danger' data-id='{$row["user_id"]}'>Delete</button> </td>
            </tr>";
}
?>
                </tbody>
            </table>
        </form>
    </div>
</body>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
$(document).on("click", ".delete-btn", function() {
        if (confirm("do you relly want to delete ")) {

            var userid = $(this).data("id");
            var element = this;

            $.ajax({
                url: "delete.php",
                type: "POST",
                data: {
                    user_id: userid
                },
                success: function(data) {
                    if (data == 1) {
                        $("#success-message").html(" deleted unsuccesfully.").slideDown();
                        $("#error-message").slideUp();
                        $(element).closest("tr").fadeOut();
                    } else {
                        $("#error-message").html("deleted succesfully.").slideDown();
                        $("#success-message").slideUp();
                        table();

                    }
                }
            });
        }
    });
</script>

</html>