<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Serach Data </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    </head>
    <body>
<?php
include 'database.php'; 

 if(empty($_POST["search"])){
 $id=$_GET["id"];
 $result_set = mysqli_query($conn, "SELECT * FROM register WHERE id = $id");
  $row = mysqli_num_rows($result_set); 
  if($row>0){
     $data = mysqli_fetch_assoc($result_set);
    //   print_r($data);
    ?>
    <div>
    <div class="div-container">
    <table class="table table-bordred">
        <thead>
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Dob</th>
		<th>Gender</th>     
        <th>Image</th>
      </tr>
        </thead>
        <tbody>
		<tr>
			<td><?php echo $data['id'];?></td>
			<td><?php echo $data['name'];?></td>
			<td><?php echo $data['email'];?></td>
            <td><?php echo $data['dob'];?></td>
			<td><?php echo $data['gender'];?></td>
			<td><img src="upload/<?php  echo $data['image'];?>" width="100" height="100"></td>        
		</tr>
        </tbody>
            
            <?php	
                }

            else{
                echo "<div class='container alert alert-danger'> No Record Found......</div>";
            }
            }

            ?>
    </table>
    </div>
    </div>
</body>
</html>
