 <?php
    include 'config.php';
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM  user_data WHERE user_id= '$user_id' ";
    $result = mysqli_query($conn, $sql) or die("query unsuccessful");

    $row = mysqli_fetch_assoc($result)
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="style.css">
     <title>Document</title>
 </head>

 <body>

     <form action="update.php" id="form" enctype="multipart/form-data" method="post">
         <div class="container">
             <div class="row">
                 <div class="col-6 mx-auto">
                     <div class="signup-form">
                         <h1 class="text-center"><b>Edit data</b></h1>
                         <hr>

                         <div class="form-group">
                             <label for="username"><b>user name</b></label>
                             <input type="text" placeholder="Enter name" id="username" name="username" value="<?php echo $row['user_name']; ?>">
                             <input type="hidden" placeholder="Enter name" id="userid" name="userid" value="<?php echo $row['user_id']; ?>">
                         </div>


                         <div class="form-group">
                             <label for="email"><b>Email</b></label>
                             <input type="text" placeholder="Enter Email" id="email" name="email" value="<?php echo $row['user_email']; ?>">
                         </div>

                         <div class="form-group">
                             <label for="dob"><b>Date of Birth:</b></label><br>
                             <input type="date" id="Dob" name="dob" value="<?php echo $row['user_dob']; ?>"><br><br>
                         </div>

                         <label for="gender"><b>Gender</b></label><br>
                         <input type="radio" name="gender" value="male" <?php if ($row['user_gender'] == "male") {
                                                                            echo "checked";
                                                                        } ?> required> Male
                         <input type="radio" name="gender" value="female" <?php if ($row['user_gender'] == "female") {
                                                                                echo "checked";
                                                                            } ?> required> Female
                         <input type="radio" name="gender" value="other" <?php if ($gender == "other") {
                                                                                echo "checked";
                                                                            } ?> required> Other </br></br>

                         <div class="form-group">
                             <label for="file"><b>photo</b></label><br>
                             <input type="file" name="newfile" id="file" onchange="loadFile(event)">
                             <input type="hidden" name="oldfile" id="oldfile" value="<?php echo $row['user_photo']; ?>">
                             <img id="image" src="<?php echo $row['user_photo']; ?>" width='100px'><br><br>
                         </div>

                         <button type="submit" name="update" id="submit" class="create btn btn-secondary">Update</button>
                     </div>
                 </div>
             </div>
         </div>

     </form>

 </body>

 </html>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 <script type="text/javascript"></script>
 <script>
     var loadFile = function(event) {
         var reader = new FileReader();
         reader.onload = function() {
             var output = document.getElementById('image');
             output.src = reader.result;
         };
         reader.readAsDataURL(event.target.files[0]);
     };

     $(function() {
         jQuery('#username').on('input', function() {
             $("#username").removeClass();
             var username = $(this).val();
             var isValid = /^[a-zA-Z0-9]*$/.test(username);
             var length = username.length;
             if (isValid && (length > 4) && (length < 20))
                 $("#username").addClass("valid");
             else
                 $("#username").addClass("invalid");
             0.
         });
     });
     $.validator.addMethod("CheckDOB", function(value, element) {
         var minDate = Date.parse("01/01/1990");
         var today = Date.now();
         var DOB = Date.parse(value);
         if ((DOB >= today || DOB <= minDate)) {
             return false;
         }
         return true;
     }, "NotValid");

     jQuery.validator.addMethod("noSpace", function(value, element) {
         return value == '' || value.trim().length != 0;
     }, "No space please and don't leave it empty");

     jQuery.validator.addMethod("lettersonly", function(value, element) {
         return this.optional(element) || /^[a-z\s]+$/i.test(value);
     }, "Only alphabetical characters");

     $.validator.addMethod("PASSWORD", function(value, element) {
         return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$/i.test(value);
     }, "Passwords are 4-16 characters with uppercase letters, lowercase letters and at least one number.");

     $(document).ready(function() {
         $('#form').validate({
             rules: {
                 username: {
                     required: true,
                     lettersonly: true,
                     noSpace: true
                 },
                 email: {
                     required: true,
                     email: true
                 },
                 psw: {
                     required: true,
                     PASSWORD: true,
                     minlength: 4
                 },
                 pswrepeat: {
                     required: true,
                     equalTo: "#psw"
                 },
                 dob: {
                     required: true,
                     CheckDOB: true
                 },
                 gender: {
                     required: true

                 },
                 file: {
                     required: true
                 }
             },

             messages: {
                 username: {
                     required: 'Please enter Name.',
                     lettersonly: 'Only alphabetical characters',
                     noSpace: "No space please and don't leave it empty",
                 },
                 email: {
                     required: 'Please enter Email Address.',
                     remote: 'Email already exist',
                     email: 'Please enter a valid Email Address.',
                 },
                 psw: {
                     required: 'Please enter Password.',
                     minlength: 'Password must be at least 4  characters long.',
                 },
                 pswrepeat: {
                     required: 'Please enter Confirm Password.',
                     equalTo: 'Confirm Password do not match with Password.',
                 },
                 dob: {
                     required: 'Please enter Date of birh.',

                 },
                 gender: {
                     required: 'Please enter Gender.',

                 },
                 file: {
                     required: 'Please enter photo.',
                 },
             },
             submitHandler: function(form) {
                 form.submit();
             }
         });
     });
 </script>