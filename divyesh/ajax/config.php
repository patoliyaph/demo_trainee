<?php
session_start();

$server = "localhost";
$user = "root";
$pass = "root";
$database = "user";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}
