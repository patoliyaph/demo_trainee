<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Signup</title>
</head>
<style>

</style>

<body style="background-color: lavenderblush;">
    <div class="container my-5 d-flex justify-content-center w-50 border shadow p-4 rounded align-items-center" style="background-color: white;">
        <?php
        $msg = $this->session->flashdata('success');
        if ($msg != "") {
            echo "<div class='alert alert-success'>$msg</div>";
        }
        ?>
        <?php validation_errors(''); ?>
        <form action="<?php echo base_url() . 'index.php/pages/signup' ?>" enctype="multipart/form-data" method="POST" id="form">
            <h2 style="color: red;">SignUp</h2>
            <hr> <br>
            <div>
                <div class="form-group">
                    <label for="name" class="form-label"><b>Name:</b></label>
                    <input type="text" name="name" id="name" class="form-control <?php echo form_error('name') != '' ? 'is-invalid' : '' ?>" value="<?php echo set_value('name'); ?>" placeholder="Enter Name">
                    <div class="invalid-feedback">
                        <!-- <?php echo validation_errors('name'); ?> -->
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="email" class="form-label"><b>Email:</b></label>
                    <input type="email" name="email" id="email" class="form-control <?php echo form_error('email') != '' ? 'is-invalid' : '' ?>" value="<?php echo set_value('email'); ?>" placeholder="Enter Email">
                    <div class="invalid-feedback"><?php validation_errors('email'); ?></div>
                </div>

                <br>
                <div class="form-group">
                    <label for="dob" class="form-label"><b>Dob:</b></label>
                    <input type="date" name="dob" id="dob" class="form-control <?php echo form_error('dob') != '' ? 'is-invalid' : '' ?>" value="<?php echo set_value('dob'); ?>" placeholder="Enter Dob">
                    <div class="invalid-feedback"><?php validation_errors('dob'); ?></div>
                </div>

                <br>
                <div class="form-group">
                    <label for="gender" class="form-label"><b>Gender:</b></label>
                    Male:<input type="radio" name="r1" class="form-check-input <?php echo form_error('gender') != '' ? 'is-invalid' : '' ?>" value="male" <?php echo set_radio('r1', 'male') ?>>
                    Female:<input type="radio" name="r1" class="form-check-input <?php echo form_error('gender') != '' ? 'is-invalid' : '' ?>" value="female" <?php echo set_radio('r1', 'female') ?>>
                    <div class="invalid-feedback"><?php validation_errors('gender'); ?></div>
                </div>
                <br>
                <div class="form-group">
                    <label for="password" class="form-check-label"><b>Password:</b></label>
                    <input type="password" name="password" id="password" class="form-control <?php echo form_error('password') != '' ? 'is-invalid' : '' ?>" value="<?php echo set_value('password'); ?>" placeholder="Enter Password">
                    <div class="invalid-feedback"><?php validation_errors('password'); ?></div>
                </div>
                <br>
                <div class="form-group">
                    <label for="cpassword" class="form-label"><b>Confirmpassword:</b></label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control <?php echo form_error('cpassword') != '' ? 'is-invalid' : '' ?>" value="<?php echo set_value('cpassword'); ?>" placeholder="Enter Conferm Password">
                    <div class="invalid-feedback"><?php validation_errors('cpassword'); ?></div>
                </div>
                <br>
                <div class="form-group">
                    <label for="img" class="form-label"><b>Img:</b></label>
                    <input type="file" name="img" class="form-control <?php echo form_error('img') != '' ? 'is-invalid' : '' ?>" onchange="image()" value="<?php echo set_value('img') ?>" id="img">
                    <div class="invalid-feedback"><?php validation_errors('img'); ?></div>
                </div>
                <br>
                <input type="submit" class="btn btn-success" name="submit" id="submit">
            </div>
        </form>
    </div>
    <div id="dataa"></div>

    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                even.preventDefault();

                $.ajax({
                    url: "signup",
                    method: "POST",
                    //data: new FormData(this),
                    success: function() {
                        $('#dataa').html(data);
                    }
                });
            });
        });
    </script> -->
</body>

</html>