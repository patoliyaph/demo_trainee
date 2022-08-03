<?php include 'database.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">              
   </head>
  <body>
    <?php
     function test_input($data)
     {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
    }
         $nameErr = $emailErr = $passwordErr = $cpasswordErr = $dobErr = $genderErr = "";
         $name = $email = $password = $cpassword = $dob = $gender =  "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
            $nameErr = "Name cannot be left blank.";
            } else {
                $name = test_input($_POST["name"]);
                if (!preg_match("/^[A-Za-z0-9 ]{3,64}$/", $name)) {
                    $nameErr = "Name must be 3 Character.";
                }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Enter Valid Email";
        } else {
            $email = test_input($_POST["email"]);
            if (!preg_match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/",$email,)) {
                $emailErr = "Invalid email format";
            }
        }
        // echo $_POST["password"];
        // echo $_POST["cpassword"];
        // die;
        if($_POST["password"] == $_POST["cpassword"]) {
            if(empty($_POST["password"])){
                $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            }
            else{
                $password = test_input($_POST["password"]);
                $cpassword = test_input($_POST["cpassword"]);
                if (strlen($_POST["password"]) < '8') {
                    $passwordErr = "Your Password Must Contain At Least 8 Characters!";
                }
                elseif(!preg_match("#[0-9]+#",$password)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Number!";
                }
                elseif(!preg_match("#[A-Z]+#",$password)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
                }
                elseif(!preg_match("#[a-z]+#",$password)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
                } else {
                    
                }
            }
        }
        else{
            $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
        }
        //  echo $_POST["dob"];
        //  die;
        if (isset($_POST['dob'])){
            $dob = $_POST['dob'];
            $age = (date("Y-m-d") - $dob);   
        }  
        if ($age < 18) {
            $dobErr = "Must 18 or older.";
        }
        else{
            if ($age > 50) {
                $dobErr = "Real age please.";
            }
            else{
                // echo "$age";
            }
        }  
        if(!isset($_POST["gender"])){
            $genderErr = "Select Gender";
            }
            else{
                $gender = $_POST["gender"];
                if ($gender == "Male"){
                    $Mchecked = "checked";
                }
                else if ($gender == "Female"){
                    $Fchecked = "checked";
                }
            }
    }
    ?>
<script>
    function validate(){
        var names =document.getElementById('names').value;
        var emails =document.getElementById('emails').value;
        var pass =document.getElementById('pass').value;
        var cpassword =document.getElementById('cpassword').value;
        var dob =document.getElementById('dob').value;
        var gender =document.getElementById('gender').value;
        if(names == ""){
            document.getElementById('name').innerHTML="Please Enter The Name";
            return false;
        }
        if(names.length > 3){
            document.getElementById('name').innerHTML="Must Be 3 Character";
            return false;
        }
        if(!isNaN(names)){
            document.getElementById('name').innerHTML="Enter only  Character";
            return false;
        }
        if(emails == ""){
            document.getElementById('emailids').innerHTML="Please Enter The Email";
            return false;
        }
        if(emails.indexOf('@')<= 0){
            document.getElementById('emailids').innerHTML="@ Invalid Position";
            return false;
        }
        if((emails.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.')){
            document.getElementById('emailids').innerHTML="Invalid Position";
            return false;
        }
        if(pass == ""){
            document.getElementById('password').innerHTML="Please Enter The Password";
            return false;
        }
        if(pass.length > 8){
            document.getElementById('password').innerHTML="Must Be Enter 8 Character";
            return false;
        }
        if(pass == cpassword){
            document.getElementById('cpassword').innerHTML="Do Not Match";
            return false;
        }
        if(dob == ""){
            document.getElementById('dob').innerHTML="Please Enter The DOB";
            return false;
        }
        if(gender == ""){
            document.getElementById('gender').innerHTML="Please Enter The Name";
            return false;
        }
    }
    function fileValidation()
    {
        var fileInput = document.getElementById('image');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if(!allowedExtensions.exec(filePath))
        {
            alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        }
    }
</script>
    <?php
    if (isset($_POST['submit']))
    {    
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $password = md5($pass);
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $image = $_FILES['image']['name'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
        $extensions= array("jpeg","jpg","png");
        move_uploaded_file($file_tmp,"upload/".$image);
        $query = mysqli_query($conn,"SELECT * FROM register WHERE email = '$email'");
            if(mysqli_num_rows($query) > 0)
            {
                $msg = "Email Already Exists";
            }
            else
            {
                if(in_array($file_ext,$extensions)== true)
                {
                $query = "INSERT INTO register (name,email,password,dob,gender,image) VALUES ('$name','$email','$password','$dob','$gender','$image')";
                if(mysqli_query($conn,$query)) 
                    {
                        // echo "Data Inserted";
                        header("Location:login.php");
                    } 
                    else
                    {
                    echo "Data Not Inserted";
                    }    
                }        
           }
        }
    ?>  
    <div class="container my-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
            <div class="shadow-lg p-5 mb-4 bg-body rounded">
              <div class="register-form">
                <h2 class=text-center>Registration Form</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  enctype="multipart/form-data">
                <span style="color:red"><?php echo $msg; ?></span>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name"  value="<?php echo $name;?>" placeholder="Name"><span style="color:red"><?php echo $nameErr; ?></span>
                  </div><br>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control"  name="email" value="<?php echo $email;?>" placeholder="Email" ><span style="color:red" ><?php echo $emailErr;  ?></span>
                  </div><br> 
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8}" placeholder="Password" ><span style="color:red"><?php echo $passwordErr; ?></span>     
                  </div><br>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" value="<?php echo $cpassword;?>"  placeholder="Confirm Password"><span style="color:red"><?php echo $cpasswordErr; ?></span>
                  </div><br> 
                  <div class="form-group">
                    <label>Date Of Birth</label>
                    <input type="date" class="form-control" name="dob"  min="1950-01-01" max="2030-12-31"  value="<?php echo $dob;?>" ><span style="color:red"><?php echo $dobErr; ?></span>
                  </div><br>
                  <fieldset class="form-group">
                  <div class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                            <input type="radio" id="male" name="gender" value="Male"<?php echo ($gender=='Male')? 'checked':'';?> >
                            <label class="form-check-label">Male</label>  
                            <input type="radio" id="Female" name="gender" value="Female"<?php echo ($gender=='Female')? 'checked':'';?>>
                            <label class="form-check-label">Female</label>  <span style="color:red"><?php echo $genderErr; ?></span>  
                            </div><br>
                        </div>
                    </div>  
                 </fieldset>                  
                  <div class="form-group">
                    <label>image   </label>
                    <input type="file" name="image" id="image" onchange="return fileValidation()">
                  </div>
                    </div> <br>
                  <div class="text-center">
                  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success">Register Now</button>
                </div> 
                  </div>
               </form>
              </div>
            </div>
            </div>
            </div>
        </div>
    </div> 
</body>
</html>             
    