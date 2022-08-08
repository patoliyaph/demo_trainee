<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">

<?php
include 'config.php';
$search_value = $_POST["search"];
$colname = $_POST["colname"];
$type = $_POST["type"];
$DESC = "DESC";
$limit_per_page = $_POST['length'] ?? 5;

$page = "";
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit_per_page;
$list = $_POST["length"];

$sql = "SELECT * FROM user_data ";

$sql_count = "SELECT * FROM user_data ";
if (isset($search_value) && !empty($search_value)) {
    $sql .= "WHERE user_id LIKE '%{$search_value}%' OR user_name LIKE '%{$search_value}%' OR user_email LIKE '%{$search_value}%' OR user_dob LIKE '%{$search_value}%' OR user_gender LIKE '%{$search_value}%' ";

    $sql_count .= "WHERE user_id LIKE '%{$search_value}%' OR user_name LIKE '%{$search_value}%' OR user_email LIKE '%{$search_value}%' OR user_dob LIKE '%{$search_value}%' OR user_gender LIKE '%{$search_value}%' ";
}

if (isset($colname) && !empty($colname)) {
    $sql .= "ORDER BY {$colname} {$DESC} ";
}
$sql .= "LIMIT {$offset},{$limit_per_page}";

$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
$output = "";

if (mysqli_num_rows($result) > 0) {
    $output = '<table class=" demo-table table table-striped" border="1" width="100%" cellspacing="0" cellpadding="10px">
   <tr>
   <thead class="thead-dark">
   <th><a class="column_sort" id="user_id"  href="load.php?sort=user_id&type=asc">ID</a></th>
   <th><a class="column_sort" id="user_name"  href="load.php?sort=user_name&type=asc">Name</a></th>
   <th><a class="column_sort" id="user_email" href="load.php?sort=user_email&type=asc">email</a></th>
   <th><a class="column_sort" id="user_dob" href="load.php?sort=user_dob&type=asc">dob</a></th>
   <th><a class="column_sort" id="user_gender" href="load.php?sort=user_gender&type=asc">Gender</a></th>
   <th><a class="column_sort" id="user_photo" href="load.php?sort=user_photo&type=asc">photo</a></th>
   <th><a class="column_sort" id="View" >View</a></th>
   <th><a class="column_sort" id="Edit" >Edit</a></th>
   <th><a class="column_sort" id="Delete">Delete</a></th>
   </thead>
   </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr><td> {$row["user_id"]}</td>
         <td>{$row["user_name"]}</td>
         <td>{$row["user_email"]}</td>
         <td>{$row["user_dob"]}</td>
         <td>{$row["user_gender"]}</td>
         <td><img src=" . $row['user_photo'] . " width='100px' ></td>
         <td><a href='view.php?id={$row["user_id"]}' class='view-btn btn btn-info' >View</a></td>
         <td><a href='edit.php?id={$row["user_id"]}' class='edit-btn btn btn-success' >edit</a></td>
         <td><button style='margin-top:0px; margin-bottom:0px' class='delete-btn btn btn-danger' data-id='{$row["user_id"]}'>Delete</button> </td></tr>";
    }
    $output .= "</table>";
    $records = mysqli_query($conn, $sql_count) or die("Query Unsuccessful2.");
    $total_record = mysqli_num_rows($records);
    $total_pages = ceil($total_record / $limit_per_page);

    $output .= '<div id="pagination">';

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            $class_name = "active";
        } else {
            $class_name = "";
        }
        $output .= "<a class='{$class_name}' id='{$i}' href='load.php?page=" . $_POST['page_no'] . $i . '&sort=' . $_POST['colname'] . '&type=' . $_POST['type'] . '&length=' . $_POST['length'] . "'>{$i}</a>";
    }

    $output .= '</div>';

    echo $output;
    mysqli_close($conn);
} else {
    echo "<h2>record not found</h2>";
}
