<?php
include 'config.php';

$order = $_POST["order"];
if ($order == 'desc') {
    $order = 'asc';
} else {
    $order = 'desc';
}

$sql = "SELECT * FROM user_data ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";

$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
$output = "";
if (mysqli_num_rows($result) > 0) {
    $output .= '<table border="1" width="100%" cellspacing="0" cellpadding="10px" class="sort">
    <tr>
    <th><a class="column_sort" id="user_id" data-order="' . $order . '" href="#">ID</a></th>
    <th><a class="column_sort" id="user_name" data-order="' . $order . '" href="#">Name</a></th>
    <th><a class="column_sort" id="user_email" data-order="' . $order . '" href="#">email</a></th>
    <th><a class="column_sort" id="user_dob" data-order="' . $order . '" href="#">dob</a></th>
    <th><a class="column_sort" id="user_gender" data-order="' . $order . '"  href="#">Gender</a></th>
    <th>photo</th>
    <th width="100px">Edit</th>
    <th width="100px">Delete</th>
    </tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr><td> {$row["user_id"]}</td>
          <td>{$row["user_name"]}</td>
           <td>{$row["user_email"]}</td>
             <td>{$row["user_dob"]}</td>
              <td>{$row["user_gender"]}</td>
                <td><img src=" . $row['user_photo'] . " width='100px'></td>
                 <td><a href='edit.php?id={$row["user_id"]}' class='edit-btn' >edit</a></td>
                  <td><button class='delete-btn' data-id='{$row["user_id"]}'>Delete</button> </td></tr>";
    }
    $output .= "</table>";

    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
