<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Root@123";
$dbname = "crud";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    echo "DB connection failed";
}
