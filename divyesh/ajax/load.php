<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php
echo $_SESSION['email'];
?>
<?php

session_start();
if (!isset($_SESSION['email'])) {
    header('location:signin.php');
}
include 'config.php';
$length = $_GET["length"];
$colname = $_GET['sort'];
$type = $_GET['type'];
$search = $_GET['search'];
$page = $_GET['page'] ?? 1;
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div id="log">
        <a class="btn btn-secondary" href="password.php">Change Password</a>
        <a class="btn btn-danger" href="logout.php">LOG OUT</a>
    </div>
    <hr>

    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="signup-form">
                    <form action="load.php" method="GET">
                        <input type="text" placeholder="Search.." name="search" id="search" value="<?php echo $search ?>" style="margin:auto;max-width:300px">
                        <i class="fas fa-search"></i>
                        <hr>

                        <label>Choose a records: </label>
                        <select onchange="selectId()" name="length" id="length" class="btn btn-primary dropdown-toggle">

                            <option class="bg-white text-black" value="5" <?php if ($length == 5) {
                                                                                echo "selected";
                                                                            } ?>>5</option>
                            <option class="bg-white text-black" value="10" <?php if ($length == 10) {
                                                                                echo "selected";
                                                                            } ?>>10</option>
                            <option class="bg-white text-black" value="20" <?php if ($length == 20) {
                                                                                echo "selected";
                                                                            } ?>>20</option>
                            <option class="bg-white text-black" value="50" <?php if ($length == 50) {
                                                                                echo "selected";
                                                                            } ?>>50</option>
                            <div class="dropdown-divider"></div>
                        </select>

                        <input type="hidden" id="length" value="<?php echo $length ?>">
                        <input type="hidden" id="colname" value="<?php echo $colname ?>">
                        <input type="hidden" id="type" value="<?php echo $type ?>">
                        <input type="hidden" id="page" value="<?php echo $page ?>">
                    </form>

                    <div id="main">

                        <div id="header">
                        </div>

                        <div id="table-data">
                        </div>

                        <div id="error-message">
                        </div>

                        <div id="success-message">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var length = document.getElementById("length").value;
        var search = document.getElementById("search").value;
        var page = document.getElementById("page").value;
        var colname = document.getElementById("colname").value;
        var type = document.getElementById("type").value;
        var data = {
            'length': length,
            'search': search,
            'page': page,
            'colname': colname,
            'type': type
        }
        $.ajax({
            url: "table.php",
            type: "POST",
            data: data,
            success: function(data) {
                $("#table-data").html(data);
            }
        });
    });

    function table() {
        $.ajax({
            url: "table.php",
            type: "POST",
            success: function(data) {
                $("#table-data").html(data);
            }
        });
    }
    $(document).on("click", ".delete-btn", function() {
        if (confirm("do you relly want to delete ")) {

            var userid = $(this).data("id");
            var element = this;

            $.ajax({
                url: "delete.php",
                type: "POST",
                data: {
                    user_id: userid
                },
                success: function(data) {
                    if (data == 1) {
                        $("#success-message").html(" deleted unsuccesfully.").slideDown();
                        $("#error-message").slideUp();
                        $(element).closest("tr").fadeOut();
                    } else {
                        $("#error-message").html("deleted succesfully.").slideDown();
                        $("#error-message").slideUp(3000);

                        table();
                    }
                }
            });
        }
    });

    function selectId() {
        var length = document.getElementById("length").value;
        var search = document.getElementById("search").value;
        var page = document.getElementById("page").value;
        var colname = document.getElementById("colname").value;
        var type = document.getElementById("type").value;

        var query = '';
        if (length) {
            query = query + '&length=' + length;
        }
        if (search) {
            query = query + '&search=' + search;
        }
        if (page) {
            query = query + '&page=' + page;
        }
        if (colname) {
            query = query + '&sort=' + colname;
        }
        if (type) {
            query = query + '&type=' + type;
        }
        window.location.href = 'load.php?' + query;
    }
</script>