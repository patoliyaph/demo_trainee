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
    a {
        text-decoration: none;
        color: white;
    }

    .clearfix button a:hover {
        color: #ffffff;
    }
</style>

<body>
    <div class="container my-5 d-flex justify-content-center w-50 border shadow p-4 rounded align-items-center" style="background: aliceblue;">
        <form action="<?php echo base_url() . 'index.php/pages/view/' . $user->id ?>" method="POST" enctype="multipart/form-data" style="background-color: lavenderblush;" class="my-4 border shadow p-4 rounded">
            <div class="px-4 mb-3">
                <h1 style="color: brown;">View Record</h1>
                <hr>
                <div class="col">
                    <div class="p-3 border bg-light">
                        <label for="id" class="float-start"><b>ID :-</b></label>
                        <label class="text-center">
                            <td><?php echo $user->id; ?></td>
                        </label>
                    </div>
                    <br>
                    <div class="p-3 border bg-light">
                        <label for="name" class="float-start"><b>Name :-</b></label>
                        <label class="text-center">
                            <td><?php echo $user->name; ?></td>
                        </label>
                    </div>
                    <br>
                    <div class="p-3 border bg-light">
                        <label for="email" class="float-start"><b>Email :-</b></label>
                        <td><?php echo $user->email; ?></td>
                    </div>
                    <br>
                    <div class="p-3 border bg-light">
                        <label for="dob" class="float-start"><b>DoB :-</b></label>
                        <td><?php echo $user->dob; ?></td>
                    </div>
                    <br>
                    <div class="p-3 border bg-light">
                        <label for="gender" class="float-start"><b>Gender :-</b></label>
                        <td><?php echo $user->gender; ?></td>
                    </div>
                    <br>
                    <div class="p-3 border bg-light">
                        <label for="img" class="float-start"> <b>image :-</b></label>
                        <td><img src='/codeigniter/uploads/<?php echo $user->img; ?>' width="100px" class="img-thumbnail" /></td>
                    </div>
                    <br>
                    <div class="p-3 border bg-light">
                        <label for="dt" class="float-start"><b>Created-Date :-</b></label>
                        <td><?php echo $user->creat_dt; ?></td>
                    </div>
                    <br>
                </div>
                <!-- <div class="clearfix" >
                    <button type="submit" name="btnsub" class="btn btn-secondary" style="padding-right: 0px;
        padding-left: 0px;"><a href="./index" style="padding-top: 10px;padding-right: 15px;padding-bottom: 10px;padding-left: 15px;">Back</a></button>
                </div>
             -->
            </div>
        </form>
    </div>
</body>

</html>