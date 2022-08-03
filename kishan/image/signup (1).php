<?php

session_start();
$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");

if($con->connect_error){
    die("conncetion failed".$con->connect_error);
}else{
    echo "connected successfully";
}


if(isset($_POST['sub'])){
    $k = $_POST['name'];
    $f = $_POST['email'];
    $g = $_POST['password'];
    $h =$_POST['DOB'];
    $r = $_POST['gender'];
    $w = $_POST['photo'];

    if($_FILES['photo']['name']){
        move_uploaded_file($_FILES['photo']['tmp_name'],"image/".$_FILES['photo']['name']);

        // echo "Not uploaded because of error #".$_FILES["photo"]["error"];

        $check = "image/".$_FILES['photo']['name'];
    } else {
        echo "Not uploaded because of error #".$_FILES["photo"]["error"];
    }
   
    

    $insert = "insert into users(name,email,password,DOB,gender,photo) values ('$k','$f','$g','$h','$r','$check')";
    // echo $i;
    // echo die();
    if(mysqli_query($con,$insert)){
        echo "record inserted sucessfully";
        header("Location:signin.php");
    }else{
        echo "record not inserted";
    }
    
}






?>





<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sign Up Form</title>
  </head>
  <body>
    <div class= "signupFrm">
    <form method="post" enctype="multipart/form-data">
    <h1>Sign Up Form</h1>
    <div class="inputContainer">
     <label for="name" class="label">name:</label>
     <input type="text" name="name" placeholder="enter your name" class="input">
</div>
    <div class="inputContainer">
     <label for="email" class="label">email:</label>
     <input type="email" name="email" placeholder="enter your email address" class="input">
     </div>
    <div class="inputContainer">
     <label for="password" class="label">pwd:</label>
     <input type="password" name="password" placeholder="enter your password" class="input">
     </div>
    <div class="inputContainer">
     <label for="dob" class="label">DOB:</label>
     <input type="text" name="DOB" placeholder="enter your date of birth" class="input">
     </div>
    <div class="inputContainer">
     <label for="gender" class="label">gender</label>
     <select name="gender" >
      <option value="male" class="input">male</option>
      <option value="female">female</option>
     </select>
     </div>
    <div class="inputContainer">
            <label for="photo" class="label">photo</label>
            <input type="file" name="photo" class="input">
            </div>
    <div class="inputContainer">
            <input type="submit" name="sub" value="submit" class="input">
            </div> 
</form>
</div>
  <!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script></body>
</html>