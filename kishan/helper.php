<?php

session_start();



$id = session_id();
$email = $_SESSION["email"];


if (!isset($_SESSION["email"]) && empty($id)) {
    "user not found";
}


