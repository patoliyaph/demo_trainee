<?php
session_start();
include 'helper.php';
session_destroy();
header("Location:signin.php");
exit();
