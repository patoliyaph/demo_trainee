<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location:signin.php");
}
session_destroy();
header("Location:signin.php");
exit();
