<?php
session_start();
?>
<html>
    <head>
        <title>User login</title>
    </head>
    <body>
        <?php
            if($_SESSION["email"]){
        ?>
        welcome <?php echo $_SESSION["email"];?>.click herer to <a href="logout.php" title ="Logout">Logout.</a>
            <?php
            }else "<h1>Please login first.<h1>";
            ?>
    </body>
</html>