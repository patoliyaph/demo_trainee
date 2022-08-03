<!doctype html>
<html>

<head>
    <title>Change records</title>
    <script src="jquery-3.3.1.min.js" type="text/javascript"></script>
    <?php
include "config.php";

$row = 0;

$rowperpage = 5;
if (isset($_POST['num_rows'])) {
    $rowperpage = $_POST['num_rows'];
}

if (isset($_POST['but_prev'])) {
    $row = $_POST['row'];
    $row -= $rowperpage;
    if ($row < 0) {
        $row = 0;
    }
}

if (isset($_POST['but_next'])) {
    $row = $_POST['row'];
    $allcount = $_POST['allcount'];

    $val = $row + $rowperpage;
    if ($val < $allcount) {
        $row = $val;
    }
}
?>
</head>

<body>
    <div class="container">

        <table width="100%" id="emp_table" border="0">
            <tr class="tr_header">
                <th width="100px">ID</th>
                <th>Name</th>
                <th>email</th>
                <th>dob</th>
                <th>gender</th>
                <th>photo</th>
                <!-- <th width="100px">Edit</th>
   <th width="100px">Delete</th> -->
            </tr>
            <?php

$sql = "SELECT COUNT(*) AS cntrows FROM user_data";
$result = mysqli_query($conn, $sql);
$fetchresult = mysqli_fetch_array($result);
$allcount = $fetchresult['cntrows'];

$sql = "SELECT * FROM user_data  ORDER BY user_id ASC limit $row," . $rowperpage;
$result = mysqli_query($conn, $sql);
$sno = $row + 1;

while ($fetch = mysqli_fetch_array($result)) {
    $name = $fetch['user_name'];
    $email = $fetch['user_email'];
    $dob = $fetch['user_dob'];
    $gender = $fetch['user_gender'];
    $photo = $fetch['user_photo'];
    ?>
            <tr>
                <td align='center'><?php echo $sno; ?></td>
                <td align='center'><?php echo $name; ?></td>
                <td align='center'><?php echo $email; ?></td>
                <td align='center'><?php echo $dob; ?></td>
                <td align='center'><?php echo $gender; ?></td>
                <td align='center'><?php echo $photo; ?></td>
            </tr>
            <?php
$sno++;
}
?>
        </table>
        <form method="post" action="" id="form">
            <div id="div_pagination">
                <input type="hidden" name="row" value="<?php echo $row; ?>">
                <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                <input type="submit" class="button" name="but_prev" value="Previous">
                <input type="submit" class="button" name="but_next" value="Next">

                <div class="divnum_rows">
                    <span class="paginationtextfield">Number of rows:</span>&nbsp;
                    <select id="num_rows" name="num_rows">
                        <?php
$numrows_arr = array("5", "10", "25", "50", "100", "250");
foreach ($numrows_arr as $nrow) {
    if (isset($_POST['num_rows']) && $_POST['num_rows'] == $nrow) {
        echo '<option value="' . $nrow . '" selected="selected">' . $nrow . '</option>';
    } else {
        echo '<option value="' . $nrow . '">' . $nrow . '</option>';
    }
}
?>
                    </select>
                </div>
            </div>
        </form>

    </div>
</body>

</html>
<script>
$(document).ready(function() {
    $("#num_rows").change(function() {
        $("#form").submit();

    });
});
</script>