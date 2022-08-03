<?php
include 'config.php';
$limit_per_page = 5;

$page = "";
if (isset($_POST["page_no"])) {
    $page = $_POST["page_no"];
} else {
    $page = 1;
}

$offset = ($page - 1) * $limit_per_page;

$sql = "SELECT * FROM user_data LIMIT {$offset},{$limit_per_page}";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
$output = "";
if (mysqli_num_rows($result) > 0) {
    $output .= '<table border="1" width="100%" cellspacing="0" cellpadding="10px" class="pagi">
        <tr>
       <th><a class="column_sort" id="user_id" data-order="desc" href="#">ID</a></th>
       <th><a class="column_sort" id="user_name" data-order="desc" href="#">Name</a></th>
       <th><a class="column_sort" id="user_email" data-order="desc" href="#">email</a></th>
       <th><a class="column_sort" id="user_dob" data-order="desc" href="#">dob</a></th>
       <th><a class="column_sort" id="user_gender" data-order="desc" href="#">Gender</a></th>
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

    $sql_total = "SELECT * FROM user_data ";
    $records = mysqli_query($conn, $sql_total) or die("Query Unsuccessful.");
    $total_record = mysqli_num_rows($records);
    $total_pages = ceil($total_record / $limit_per_page);

    $output .= '<div id="pagination">';

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            $class_name = "active";
        } else {
            $class_name = "";
        }
        $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
    }
    $output .= '</div>';

    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}