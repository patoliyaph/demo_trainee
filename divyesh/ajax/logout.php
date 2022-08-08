<?php

session_start();
$des = session_destroy();

if ($des) {
    echo '<script type="text/javascript">';
    echo ' alert("logout successfully")';
    echo '</script>';
    echo '<script>
    window.location.href = "signin.php";
    </script>';
}
