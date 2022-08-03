<?php
include 'database.php';
$id = $_GET['id'];
$query = "SELECT * FROM register WHERE id=$id";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);
$name = $row['name'];
$email = $row['email'];
$dob = $row['dob'];
$gender = $row['gender'];
$image = $row['image'];

if (isset($_POST['update'])) 
{
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $image = $_FILES['image']['name'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));   
       move_uploaded_file($file_tmp,"upload/".$image);
       $query = "UPDATE register SET name ='$name', email  ='$email', dob  ='$dob',gender  ='$gender', image ='$image' WHERE id = '$id'"; 
       $sql = mysqli_query($conn,$query);
       if ($sql)
        {
            echo "data updated";
            header("Location:view.php");
        }
       else
        {
        echo "Not updated";
        }
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>update</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
   </head>
  <body>
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
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $name = $email =  $dob = $gender =  "";
    $nameErr = $emailErr = $dobErr = $genderErr = "";

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
    <div class="container my-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
            <div class="shadow-lg p-5 mb-4 bg-body rounded">
                        <div class="update-form">
                            <h2 class="text-center">Update Data</h2>
                            <form action="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
                            <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" ><span style="color:red"><?php echo $nameErr; ?></span>
                  </div><br> 
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control"  name="email" value="<?php echo $row['email'];?>" ><span style="color:red" ><?php echo $emailErr; ?></span>
                  </div><br> 
                  <div class="form-group">
                    <label>Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" min="1950-01-01" max="2000-12-31"   value="<?php echo $row['dob'];?>"><span style="color:red"><?php echo $dobErr; ?></span>
                  </div><br>
                  <fieldset class="form-group">
                  <div class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                            <input type="radio" id="male" name="gender" value="male"  <?php if ($gender!="Male") echo "checked"; ?>>
                            <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                            <input type="radio" id="Female" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>>
                            <label class="form-check-label">Female</label><br><span style="color:red"><?php echo $genderErr; ?></span><br>   
                            </div>
                        </div>
                    </div>  
                 </fieldset>                  
                  <div class="form-group">
                    <label>image</label>
                    <img src="upload/<?php echo $row['image'];?>"  width="100" height="100">
                    <input type="file" name="image" onchange="return fileValidation()">
                    <!-- <input type="hidden" value="upload/<?php echo $row['image'];?>" > -->
                  </div> <br>
                  <div class="text-center">
                  <div class="form-group">
                    <button type="submit" name="update" class="btn btn-success">Edit</button>
                </div> 
                  </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </form>
</body> 
</html>