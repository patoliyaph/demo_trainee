<?php
include 'config.php';

$search_value = $_POST["search"];


$sql = "SELECT * FROM user_data WHERE user_id LIKE '%{$search_value}%' OR user_name LIKE '%{$search_value}%' OR user_email LIKE '%{$search_value}%' OR user_dob LIKE '%{$search_value}%' OR user_gender LIKE '%{$search_value}%'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";

if (mysqli_num_rows($result) > 0) {

    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px" class="search">
   <tr>
   <th width="100px">ID</th>
   <th>Name</th>
   <th>email</th>
   <th>dob</th>
   <th>gender</th>
   <th>photo</th>
   <th width="100px">Edit</th>
   <th width="100px">Delete</th>
   </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr><td> {$row["user_id"]}</td>  <td>{$row["user_name"]}</td>  <td>{$row["user_email"]}</td>   <td>{$row["user_dob"]}</td>  <td>{$row["user_gender"]}</td>  <td><img src=" . $row['user_photo'] . " width='100px'></td>
        <td><a href='edit.php?id={$row["user_id"]}' class='edit-btn' >edit</a></td>
        <td><button class='delete-btn' data-id='{$row["user_id"]}'>Delete</button> </td></tr>";
    }
    $output .= "</table>";

    mysqli_close($conn);

    echo $output;

} else {
    echo "<h2>record not found</h2>";
}