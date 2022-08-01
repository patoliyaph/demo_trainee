<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<style>

</style>

<body style="background-color: lavenderblush;">
    <div class="container my-5 d-flex justify-content-center w-50 border shadow p-5 rounded align-items-center" style="background-color: white;">

        <form action="<?php echo base_url() . 'index.php/pages/login' ?>" method="POST">
            <h2 style="color: brown;">Login</h2>
            <hr>
            <?php
            $msg = $this->session->flashdata('msg');
            if ($msg != "") {
                echo "<div class='alert alert-danger'>$msg</div>";
            }

            $msg = $this->session->flashdata('success');
            if ($msg != "") {
                echo "<div class='alert alert-success alert-dismissible'>$msg
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            }
            ?>

            <?php validation_errors(''); ?>
            <br>
            <div class="form-group">
                <label for="email" class="form-label"><b> Email:</b></label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Enter Email">
            </div>

            <br>
            <div class="form-group">
                <label for="password" class="form-label"><b>Password:</b></label>
                <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Enter Password">
            </div>
            <br>
            <input type="submit" name="submit" id="" class="btn btn-primary" value="LogIn">
        </form>
    </div>
</body>

</html>