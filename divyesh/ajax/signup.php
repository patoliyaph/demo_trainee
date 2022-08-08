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

    <form action="insert.php" id="form" enctype="multipart/form-data" method="post" style="border:1px solid #ccc">
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="signup-form">
                        <h1 class="text-center"><b>Sign Up</b></h1>
                        <hr>
                        <div class="form-group">
                            <label for="username"><b>user name</b></label>
                            <input type="text" class="form-control" placeholder="Enter name" id="username" name="username" value="">
                            <span class="error">* <?php echo $nameErr ?? $_GET['nameErr']; ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="email"><b>Email</b></label>
                            <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email">
                            <span class="error">* <?php echo $emailErr ?? $_GET['emailErr']; ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="psw"><b>Password</b></label>
                            <input type="password" class="form-control" placeholder="Enter Password" id="psw" name="psw" value="">
                            <span class="error">* <?php echo $passwordErr ?? $_GET['cpasswordErr']; ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="pswrepeat"><b>confirm Password</b></label>
                            <input type="password" class="form-control" placeholder="confirm Password" id="pswrepeat" name="pswrepeat" value="">
                            <span class="error">* <?php echo $cpasswordErr ?? $_GET['cpasswordErr']; ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="dob"><b>Date of Birth:</b></label><br>
                            <input type="date" class="form-control" id="Dob" name="dob"><br><br>
                            <span class="error">* <?php echo $dobErr ?? $_GET['dobErr']; ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="gender"><b>Gender</b></label><br>
                            <input type="radio" id="gender" name="gender" value="male"> Male
                            <input type="radio" name="gender" id="gender" value="female"> Female
                            <input type="radio" name="gender" id="gender" value="other"> Other<br><br>
                            <span class="error">* <?php echo $genderErr ?? $_GET['genderErr']; ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="file"><b>photo</b></label>
                            <input type="file" class="form-control" name="file" id="file" onchange="loadFile(event)"><br>
                            <img id="image" src="" width='100px'>
                            <span class="error">* <?php echo $photoErr ?? $_GET['photoErr']; ?> </span>
                        </div>

                        <button type="submit" class="btn btn-success create" id="submit">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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
        var minDate = Date.parse("01/01/1960");
        var maxDate = Date.parse("01/01/2002");
        var DOB = Date.parse(value);
        if ((DOB >= maxDate || DOB <= minDate)) {
            return false;
        }
        return true;
    }, "use mustbe max 50 years and min 18 years old");


    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value == '' || value.trim().length != 0;
    }, "No space please and don't leave it empty");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");

    $.validator.addMethod("PASSWORD", function(value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
    }, "Passwords are 8-16 characters with uppercase letters, lowercase letters and at least one number.");



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
                    minlength: 8
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
                    required: true,
                },
                file: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: 'Please enter Name.',
                    lettersonly: 'Only alphabetical characters',
                    noSpace: "No space please and don't leave it empty"
                },
                email: {
                    required: 'Please enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                    remote: 'Email already exist',
                },
                psw: {
                    required: 'Please enter Password.',
                    minlength: 'Password must be at least 8  characters long.',
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