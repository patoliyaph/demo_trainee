<?php include 'database.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>CPass</title>
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
  $newpassErr = $cpassErr = "";
  $newpass = $cpass = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["npsw"] == $_POST["cpsw"]) {
      if (empty($_POST["npsw"])) {
        $newpassErr = "Your Password Must Contain At Least 8 Characters!";
      } else {
        $newpass = test_input($_POST["npsw"]);
        $cpass = test_input($_POST["cpsw"]);
        if (strlen($_POST["npsw"]) < '8') {
          $newpassErr = "Your Password Must Contain At Least 8 Characters!";
        } elseif (!preg_match("#[0-9]+#", $npsw)) {
          $newpassErr = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $npsw)) {
          $newpassErr = "Your Password Must Contain At Least 1 Capital Letter!";
        } elseif (!preg_match("#[a-z]+#", $npsw)) {
          $newpassErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } else {
        }
      }
    } else {
      $cpassErr = "Please Check You've Entered Or Confirmed Your Password!";
    }
  }
  if (isset($_POST['submit'])) {
    $oldpass = md5($_POST['opsw']);
    $newpass = md5($_POST['npsw']);
    $cpass = md5($_POST['cpsw']);
    if ($newpass == $cpass) {
      $query = "SELECT password FROM register WHERE password='$oldpass'";
      $result = mysqli_query($conn, $query);
      $total = mysqli_num_rows($result);
      if ($total > 0) {
        $query = "UPDATE register SET password = '$newpass'";
        mysqli_query($conn, $query);
        echo "Password Update Successfully";
        header("Location: login.php");
      } else {
        echo "Old Password Does Not Match";
      }
    } else {
      echo "New Password & Confirm Password Does Not Match";
    }
  }
  ?>
  <div class="container my-5">
    <div class="row">
      <div class="col-md-5 mx-auto">
        <div class="shadow-lg p-5 mb-4 bg-body rounded">
          <div class="cpass-form">
            <h2 class=text-center>Change Password</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
              <div class="form-group">
                <label>Old Password</label>
                <input type="password" class="form-control" name="opsw" placeholder="Old Password">
              </div><br>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="npsw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8}" placeholder="New Password"><span style="color:red"><?php echo $newpassErr; ?></span>
              </div><br>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="cpsw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8}" placeholder="Confirm Password"><span style="color:red"><?php echo $cpassErr; ?></span>
              </div><br>
              <div class="text-center">
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-success">ChangePassword</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>