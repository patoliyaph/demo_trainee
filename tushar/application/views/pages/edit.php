<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>edit</title>
</head>
<style>
    body{
        background-color: #fff1f1;
    }
    .container{
        background-color:white;
    }
    a{
        text-decoration: none;
        color: #fbfbfb;
    }
    .clearfix button a:hover {
        color: #ffffff;
    }
</style>
<body>
    <div class="container my-5 d-flex justify-content-center w-50 border shadow p-4 rounded align-items-center">
        <?php
        $msg = $this->session->flashdata('msg');
        if ($msg != "") {
            echo "<div class='alert alert-success'>$msg</div>";
        }
        ?>
        <?php validation_errors(''); ?>

         <form action="<?php echo base_url().'index.php/pages/update/'.$user->id?>" enctype="multipart/form-data" method="POST" id="form">     
            <h2 style="color: #ff7b7b;">Edit Record's</h2>
            <hr> <br>
            <div></div>
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control"  value="<?php echo $user->name;?>" placeholder="Enter Name">
            </div>
            <br>
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $user->email;?>"  placeholder="Enter Email">
            </div>
            <div class="error"><?php echo form_error('name');?></div>
            <br>
            <div class="form-group">
                <label for="dob" class="form-label">Dob:</label>
                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $user->dob; ?>" placeholder="Enter Dob">
            </div>

            <br>
            <div class="form-group">
                <label for="gender" class="form-label">Gender:</label>
                Male:<input type="radio" name="r1" class="form-check-input" value="male" <?php if ($user->gender == "male") {echo "checked";} ?>>
                Female:<input type="radio" name="r1" class="form-check-input" value="female" <?php if ($user->gender == "female") {echo "checked";} ?>>
            </div>
            <br>
            <div  class="form-group">
                <label for="img" class="form-label">Img:</label>
                <td><img src='/codeigniter/uploads/<?php echo $user->img; ?>' alt='image' width='100px'></td>
            </div>
            <br>
            <div class="form-group">
                <label for="img" class="form-label">Img:</label>
                <input type="hidden" name="old_img" value="<?php echo $user->img;?>">
                <input type="file" name="img" class="form-control" value="<?php echo set_value('img'); ?>" id="img">
                
            </div>
            <br>
            <div>
            <button type="submit" name="edit" id="edit" class="btn btn btn-primary">Update</button>
            </div>
                </div>
        </form>
    </div>
    <div id="dataa"></div>
</body>
</html>