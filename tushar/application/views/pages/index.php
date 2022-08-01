<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">

    <title>Document</title>
</head>
<style>
    body {
        background-color: #c9c9c9;
    }

    .container {
        background-color: white;
    }

    a {
        text-decoration: none;
        color: white;
    }

    button a:hover {
        color: #ffffff;
    }

    button {
        margin-left: 7px;
    }
</style>

<body>

    <!-- <?php echo form_open_multipart('pages/index'); ?> -->
    <form action="<?php echo base_url() . 'index.php/pages/index' ?>" enctype="multipart/form-data" method="POST" id="form">
        <div class="container my-5 border shadow p-4 rounded ">
            <?php
            $msg = $this->session->flashdata('success');
            if ($msg != "") {
                echo "<div class='alert alert-success alert-dismissible align-items-center' >$msg
       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>";
            }
            ?>
            <h1 align="center">All Record's Data Table <br> <button class="btn btn-secondary" style="padding-left: 0px;
            padding-right: 0px;"><a href="./logout" style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">Logout</a></button>
                <button class="btn btn-warning" style="padding-left: 0px;
                padding-right: 0px;"> <a href="./add" style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">Add</a></button>
            </h1>
            <table id="list" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Img</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <script>
                $(document).on('click', '.delete', function() {
                    var id = $(this).attr('id');
                    if (confirm("Are You sure you want to Delete This Record??")) {
                        //console.log("inside delete", id);
                        $.ajax({
                            url: "<?php base_url() . 'pages/delete' ?>",
                            method: "POST",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                // console.log(dataIn);
                                //alert(data);
                                dataTable.ajax.reload();
                            }
                        });
                    } else {
                        return false;
                    }
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#list').DataTable({
                        "ajax": {
                            url: "item",
                            type: "GET"
                        },
                    });
                });

                /* function delete_user(){
                   return confirm("Are You Sure? You Want to Delete This Record!");
                } */
            </script>
        </div>

    </form>

</body>

</html>