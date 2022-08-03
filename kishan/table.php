<?php


$con = mysqli_connect("localhost","phpmyadmin","root","phpmyadmin");
if($con->connect_error){
    die("connnection failed".$con->connect_error);
}

$result = mysqli_query($con,"SELECT*FROM users");
$start = 0;
$current_page=1;
$per_page = 5;
if(isset($_GET['start'])){
     $start = $_GET['start'];
     if($start<=0){
        $start = 0;
        $current_page = 1;
     }else{
     $current_page=$start;
     $start--;
     $start = $start*$per_page;
     }
}

$record =mysqli_num_rows($result);
$pagi = ceil($record/$per_page);

$sql = "SELECT * FROM users LIMIT $start,$per_page";

$res = mysqli_query($con, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="table.css">
</head>

<body>
    <h3>Custom Table</h3>
    <input type="text" name="searchbar" id="searchbar" placeholder="search">
    <table class="table table-striped table-sm border-dark">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody id="name">
            <?php
            if(mysqli_num_rows($res)>0){
    while($row = mysqli_fetch_assoc($res)){        
    ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo date('d/m/y',strtotime($row['DOB']));?></td>
                <td><?php echo $row['gender'];?></td>
                <td><img src="<?php echo $row['photo'];?>" height="100px" width="100px"></td>
            </tr>
            <?php
    }
}else{
    echo '<tr>';
    echo '<td>no records</td>';
     echo '</tr>';
}
    ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
    <ul class="pagination">
 <a class="pagination-prev" href="#"><</a>
        <?php for ($i=1;$i<=$pagi; $i++) {
            $class = '';
            if($current_page == $i){
                $class = 'active';
            }
            ?>
            
        <li class="page-item <?php echo $class?>"><a class="page-link"
                href="?start=<?php echo $i?>"><?php echo $i ?></a></li>

        <?php }?>
        <a class="pagination-next" href="#">></a>
    </ul>
        </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#searchbar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#name tr").filter(function() {
                $(this).toggle($(this).text()
                    .toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
</body>

</html>