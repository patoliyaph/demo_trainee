<?php
include 'config.php';

error_reporting(0);

$user_id = $_POST["user_id"];

$sql = "DELETE FROM user_data WHERE user_id= '$user_id' ";

$result = mysqli_query($conn, $sql) or die("query unsuccessful");

if ($result) {

    echo "Record deleted successfully";
} else {
    echo "deleted unsuccessfully";
}
