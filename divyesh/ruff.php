<!-- <?php

/// ajax edit update

// $(document).on("click", ".edit-btn", function() {
//     // $("#modal").show();
//     var userid = $(this).data("eid");

//     $.ajax({
//         url: "edit.php",
//         type: "POST",
//         data: {
//             "userid": userid,
//         },
//         success: function(data) {
//             console.log(data);
//             $("#modal-form table").html(data)

//         }
//     });
// });
// $("#close-btn").on("click", function() {
//     $("#modal").hide();
// });

// $(document).on("click", "#edit-submit", function() {
//     var userid = $("#edit-id").val();
//     var name = $("#edit-name").val();
//     var email = $("#edit-email").val();
//     var dob = $("#edit-dob").val();
//     var gender = $("#edit-gender").val();
//     var file_data = $("#edit-photo").prop('files')[0];

//     var formData = new FormData();
//     formData.append("user_id", userid);
//     formData.append("user_name", name);
//     formData.append("user_email", email);
//     formData.append("user_dob", dob);
//     formData.append("user_gender", gender);
//     formData.append("file", file_data);

//     $.ajax({
//         url: "update.php",
//         type: "POST",
//         data: formData,
//         cache: false,
//         contentType: false,
//         processData: false,

//         success: function(data) {
//             if (data == 1) {
//                 $("#modal").hide();
//             }
//         }
//     });
//     $("#edit-submit").on("click", function() {
//         $("#modal").hide();
//         table();

//     });
// });
// modal form

//     <!--
// <div id="table-data12">
//     <div id="modal">
//         <div id="modal-form">

//             <h1>Edit form</h1>

//             <table cellpadding="0" width="100%">

//             </table>

//             <div id="close-btn">X</div>

//         </div>
//     </div> -->

// update <code></code>

// <?php
// include 'config.php';

// if (isset($_POST['update'])) {

//     $user_id = $_POST["userid"];
//     $user_name = $_POST["username"];
//     $user_email = $_POST["email"];
//     $password = $_POST['psw'];
//     $cpassword = $_POST['pswrepeat'];
//     $user_dob = $_POST['dob'];
//     $user_gender = $_POST["gender"];
//     $new_img = $_FILES['newfile']['name'];
//     $old_img = $_POST["oldfile"];

//     if ($new_img != '') {
//         $update_file = "images/" . $_FILES['newfile']['name'];
//     } else {
//         $update_file = $old_img;
//     }

//     $sql = "UPDATE user_data SET user_name  = '$user_name', user_email = '$user_email',user_password = '$password', user_dob  = '$user_dob', user_gender = '$user_gender',user_photo  = '$update_file' WHERE user_id='$user_id'";

//     $result = mysqli_query($conn, $sql) or die("query unsuccessful");

//     if ($result) {
//         if ($_FILES['newfile']['name'] != '') {
//             if (move_uploaded_file($_FILES['newfile']['tmp_name'], $update_file)){
//                 unlink($old_img);
//             }
//         }

//         echo 'update successfully';
//         header("Location:load.php");

//     } else {
//         echo 'data can not be saved, please try again after some time';
//     }
// }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP & Ajax CRUD</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Last Name : <input type="text" id="lname">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "ajax-load.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load

    // Insert New Records
    $("#save-button").on("click",function(e){
      e.preventDefault();
      var fname = $("#fname").val();
      var lname = $("#lname").val();
      if(fname == "" || lname == ""){
        $("#error-message").html("All fields are required.").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url: "ajax-insert.php",
          type : "POST",
          data : {first_name:fname, last_name: lname},
          success : function(data){
            if(data == 1){
              loadTable();
              $("#addForm").trigger("reset");
              $("#success-message").html("Data Inserted Successfully.").slideDown();
              $("#error-message").slideUp();
            }else{
              $("#error-message").html("Can't Save Record.").slideDown();
              $("#success-message").slideUp();
            }

          }
        });
      }

    });

    //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var studentId = $(this).data("id");
        var element = this;

        $.ajax({
          url: "ajax-delete.php",
          type : "POST",
          data : {id : studentId},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

    //Show Modal Box
    $(document).on("click",".edit-btn", function(){
      $("#modal").show();
      var studentId = $(this).data("eid");

      $.ajax({
        url: "load-update-form.php",
        type: "POST",
        data: {id: studentId },
        success: function(data) {
          $("#modal-form table").html(data);
        }
      })
    });

    //Hide Modal Box
    $("#close-btn").on("click",function(){
      $("#modal").hide();
    });

    //Save Update Form
      $(document).on("click","#edit-submit", function(){
        var stuId = $("#edit-id").val();
        var fname = $("#edit-fname").val();
        var lname = $("#edit-lname").val();

        $.ajax({
          url: "ajax-update-form.php",
          type : "POST",
          data : {id: stuId, first_name: fname, last_name: lname},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });

    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "ajax-live-search.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#table-data").html(data);
         }
       });
     });
  });
</script>
</body>





</html> -->

<?php

// $search_value = $_POST["search"];

// $conn = mysqli_connect("localhost","root","","test") or die("Connection Failed");

// $sql = "SELECT * FROM students WHERE first_name LIKE '%{$search_value}%' OR last_name LIKE '%{$search_value}%'";
// $result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
// $output = "";
// if(mysqli_num_rows($result) > 0 ){
//   $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
//               <tr>
//                 <th width="60px">Id</th>
//                 <th>Name</th>
//                 <th width="90px">Edit</th>
//                 <th width="90px">Delete</th>
//               </tr>';

//               while($row = mysqli_fetch_assoc($result)){
//                 $output .= "<tr><td align='center'>{$row["id"]}</td><td>{$row["first_name"]} {$row["last_name"]}</td><td align='center'><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td><td align='center'><button Class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
//               }
//     $output .= "</table>";

//     mysqli_close($conn);

//     echo $output;
// }else{
//     echo "<h2>No Record Found.</h2>";
// }

?>
sorting
<?php
//index.php
//  $connect = mysqli_connect('localhost', 'root', '', 'testing');
//  $query = "SELECT * FROM tbl_employee ORDER BY id DESC";
//  $result = mysqli_query($connect, $query);
//  ?>
//  <!DOCTYPE html>
//  <html>
//       <head>
//            <title>Webslesson Tutorial | Ajax Jquery Column Sort with PHP & MySql</title>
//            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
//            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
//            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
//       </head>
//       <body>
//            <br />
//            <div class="container" style="width:700px;" align="center">
//                 <h3 class="text-center">Ajax Jquery Column Sort with PHP & MySql</h3><br />
//                 <div class="table-responsive" id="employee_table">
//                      <table class="table table-bordered">
//                           <tr>
//                                <th><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>
//                                <th><a class="column_sort" id="name" data-order="desc" href="#">Name</a></th>
//                                <th><a class="column_sort" id="gender" data-order="desc" href="#">Gender</a></th>
//                                <th><a class="column_sort" id="designation" data-order="desc" href="#">Designation</a></th>
//                                <th><a class="column_sort" id="age" data-order="desc" href="#">Age</a></th>
//                           </tr>
//                           <?php
//                           while($row = mysqli_fetch_array($result))
//                           {
//                           ?>
//                           <tr>
//                                <td><?php echo $row["id"]; ?></td>
//                                <td><?php echo $row["name"]; ?></td>
//                                <td><?php echo $row["gender"]; ?></td>
//                                <td><?php echo $row["designation"]; ?></td>
//                                <td><?php echo $row["age"]; ?></td>
//                           </tr>
//                           <?php
//                           }
//                           ?>
//                      </table>
//                 </div>
//            </div>
//            <br />
//       </body>
//  </html>
//  <script>
//  $(document).ready(function(){
//       $(document).on('click', '.column_sort', function(){
//            var column_name = $(this).attr("id");
//            var order = $(this).data("order");
//            var arrow = '';
//            //glyphicon glyphicon-arrow-up
//            //glyphicon glyphicon-arrow-down
//            if(order == 'desc')
//            {
//                 arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';
//            }
//            else
//            {
//                 arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';
//            }
//            $.ajax({
//                 url:"sort.php",
//                 method:"POST",
//                 data:{column_name:column_name, order:order},
//                 success:function(data)
//                 {
//                      $('#employee_table').html(data);
//                      $('#'+column_name+'').append(arrow);
//                 }
//            })
//       });
//  });
 </script>














+

<?php
//sort.php
//  $connect = mysqli_connect("localhost", "root", "", "testing");
// //  $output = '';
//  $order = $_POST["order"];
//  if($order == 'desc')
//  {
//       $order = 'asc';
//  }
//  else
//  {
//       $order = 'desc';
//  }
//  $query = "SELECT * FROM tbl_employee ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
//  $result = mysqli_query($connect, $query);
//  $output .= '
//  <table class="table table-bordered">
//       <tr>
//            <th><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>
//            <th><a class="column_sort" id="name" data-order="'.$order.'" href="#">Name</a></th>
//            <th><a class="column_sort" id="gender" data-order="'.$order.'" href="#">Gender</a></th>
//            <th><a class="column_sort" id="designation" data-order="'.$order.'" href="#">Designation</a></th>
//            <th><a class="column_sort" id="age" data-order="'.$order.'" href="#">Age</a></th>
//       </tr>
//  ';
//  while($row = mysqli_fetch_array($result))
//  {
//       $output .= '
//       <tr>
//            <td>' . $row["id"] . '</td>
//            <td>' . $row["name"] . '</td>
//            <td>' . $row["gender"] . '</td>
//            <td>' . $row["designation"] . '</td>
//            <td>' . $row["age"] . '</td>
//       </tr>
//       ';
//  }
//  $output .= '</table>';
//  echo $output;
?>


 -->

 <!doctype html>
<html>
    <head>
        <title>Change number of records displayed in Pagination using PHP</title>
        <link href="style.css" type="text/css" rel="stylesheet">
        <script src="jquery-3.3.1.min.js" type="text/javascript"></script>
        <?php
include "config.php";

$row = 0;

// number of rows per page
$rowperpage = 5;
if (isset($_POST['num_rows'])) {
    $rowperpage = $_POST['num_rows'];
}

// Previous Button
if (isset($_POST['but_prev'])) {
    $row = $_POST['row'];
    $row -= $rowperpage;
    if ($row < 0) {
        $row = 0;
    }
}

// Next Button
if (isset($_POST['but_next'])) {
    $row = $_POST['row'];
    $allcount = $_POST['allcount'];

    $val = $row + $rowperpage;
    if ($val < $allcount) {
        $row = $val;
    }
}
?>
    </head>
    <body>
    <div class="container">

        <table width="100%" id="emp_table" border="0">
            <tr class="tr_header">
                <th>S.no</th>
                <th>Name</th>
                <th>Salary</th>
            </tr>
            <?php
// count total number of rows
$sql = "SELECT COUNT(*) AS cntrows FROM employee";
$result = mysqli_query($con, $sql);
$fetchresult = mysqli_fetch_array($result);
$allcount = $fetchresult['cntrows'];

// selecting rows
$sql = "SELECT * FROM employee  ORDER BY ID ASC limit $row," . $rowperpage;
$result = mysqli_query($con, $sql);
$sno = $row + 1;

while ($fetch = mysqli_fetch_array($result)) {
    $name = $fetch['emp_name'];
    $salary = $fetch['salary'];
    ?>
                <tr>
                    <td align='center'><?php echo $sno; ?></td>
                    <td align='center'><?php echo $name; ?></td>
                    <td align='center'><?php echo $salary; ?></td>
                </tr>
            <?php
$sno++;
}
?>
        </table>

        <!-- Pagination control -->
        <form method="post" action="" id="form">
            <div id="div_pagination">
                <input type="hidden" name="row" value="<?php echo $row; ?>">
                <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                <input type="submit" class="button" name="but_prev" value="Previous">
                <input type="submit" class="button" name="but_next" value="Next">

                <!-- Number of rows -->
                <div class="divnum_rows">
                <span class="paginationtextfield">Number of rows:</span>&nbsp;
                <select id="num_rows" name="num_rows">
                    <?php
$numrows_arr = array("5", "10", "25", "50", "100", "250");
foreach ($numrows_arr as $nrow) {
    if (isset($_POST['num_rows']) && $_POST['num_rows'] == $nrow) {
        echo '<option value="' . $nrow . '" selected="selected">' . $nrow . '</option>';
    } else {
        echo '<option value="' . $nrow . '">' . $nrow . '</option>';
    }
}
?>
                </select>
                </div>
            </div>
        </form>

    </div>
    </body>
</html>
<script>
 $(document).ready(function(){

// Number of rows selection
$("#num_rows").change(function(){
    // Submitting form
    $("#form").submit();

});
});








sorting

<?php
//index.php
$connect = mysqli_connect('localhost', 'root', '', 'testing');
$query = "SELECT * FROM tbl_employee ORDER BY id DESC";
$result = mysqli_query($connect, $query);
?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Webslesson Tutorial | Ajax Jquery Column Sort with PHP & MySql</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      </head>
      <body>
           <br />
           <div class="container" style="width:700px;" align="center">
                <h3 class="text-center">Ajax Jquery Column Sort with PHP & MySql</h3><br />
                <div class="table-responsive" id="employee_table">
                     <table class="table table-bordered">
                          <tr>
                               <th><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>
                               <th><a class="column_sort" id="name" data-order="desc" href="#">Name</a></th>
                               <th><a class="column_sort" id="gender" data-order="desc" href="#">Gender</a></th>
                               <th><a class="column_sort" id="designation" data-order="desc" href="#">Designation</a></th>
                               <th><a class="column_sort" id="age" data-order="desc" href="#">Age</a></th>
                          </tr>
                          <?php
while ($row = mysqli_fetch_array($result)) {
    ?>
                          <tr>
                               <td><?php echo $row["id"]; ?></td>
                               <td><?php echo $row["name"]; ?></td>
                               <td><?php echo $row["gender"]; ?></td>
                               <td><?php echo $row["designation"]; ?></td>
                               <td><?php echo $row["age"]; ?></td>
                          </tr>
                          <?php
}
?>
                     </table>
                </div>
           </div>
           <br />
      </body>
 </html>
 <script>
 $(document).ready(function(){
      $(document).on('click', '.column_sort', function(){
           var column_name = $(this).attr("id");
           var order = $(this).data("order");
           var arrow = '';
           //glyphicon glyphicon-arrow-up
           //glyphicon glyphicon-arrow-down
           if(order == 'desc')
           {
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';
           }
           else
           {
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';
           }
           $.ajax({
                url:"sort.php",
                method:"POST",
                data:{column_name:column_name, order:order},
                success:function(data)
                {
                     $('#employee_table').html(data);
                     $('#'+column_name+'').append(arrow);
                }
           })
      });
 });
 </script>

 <?php
//sort.php
$connect = mysqli_connect("localhost", "root", "", "testing");
$output = '';
$order = $_POST["order"];
if ($order == 'desc') {
    $order = 'asc';
} else {
    $order = 'desc';
}
$query = "SELECT * FROM tbl_employee ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";
$result = mysqli_query($connect, $query);
$output .= '
 <table class="table table-bordered">
      <tr>
           <th><a class="column_sort" id="id" data-order="' . $order . '" href="#">ID</a></th>
           <th><a class="column_sort" id="name" data-order="' . $order . '" href="#">Name</a></th>
           <th><a class="column_sort" id="gender" data-order="' . $order . '" href="#">Gender</a></th>
           <th><a class="column_sort" id="designation" data-order="' . $order . '" href="#">Designation</a></th>
           <th><a class="column_sort" id="age" data-order="' . $order . '" href="#">Age</a></th>
      </tr>
 ';
while ($row = mysqli_fetch_array($result)) {
    $output .= '
      <tr>
           <td>' . $row["id"] . '</td>
           <td>' . $row["name"] . '</td>
           <td>' . $row["gender"] . '</td>
           <td>' . $row["designation"] . '</td>
           <td>' . $row["age"] . '</td>
      </tr>
      ';
}
$output .= '</table>';
echo $output;
?>







PAGGINATION AND SRCH BAR








<?php
$search_keyword = '';
if (!empty($_POST['search']['keyword'])) {
    $search_keyword = $_POST['search']['keyword'];
}
$sql = 'SELECT * FROM posts WHERE post_title LIKE :keyword OR description LIKE :keyword OR post_at LIKE :keyword ORDER BY id DESC ';

/* Pagination Code starts */
$per_page_html = '';
$page = 1;
$start = 0;
if (!empty($_POST["page"])) {
    $page = $_POST["page"];
    $start = ($page - 1) * ROW_PER_PAGE;
}
$limit = " limit " . $start . "," . ROW_PER_PAGE;
$pagination_statement = $pdo_conn->prepare($sql);
$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
$pagination_statement->execute();

$row_count = $pagination_statement->rowCount();
if (!empty($row_count)) {
    $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
    $page_count = ceil($row_count / ROW_PER_PAGE);
    if ($page_count > 1) {
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i == $page) {
                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
            } else {
                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
            }
        }
    }
    $per_page_html .= "</div>";
}

$query = $sql . $limit;
$pdo_statement = $pdo_conn->prepare($query);
$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
?>
<form name='frmSearch' action='' method='post'>
<div style='text-align:right;margin:20px 0px;'><input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
<table class='tbl-qa'>
  <thead>
    <tr>
      <th class='table-header' width='20%'>Title</th>
      <th class='table-header' width='40%'>Description</th>
      <th class='table-header' width='20%'>Date</th>
    </tr>
  </thead>
  <tbody id='table-body'>
    <?php
if (!empty($result)) {
    foreach ($result as $row) {
        ?>
      <tr class='table-row'>
        <td><?php echo $row['post_title']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['post_at']; ?></td>
      </tr>
    <?php
}
}
?>
  </tbody>
</table>
<?php echo $per_page_html; ?>
</form>








///////////////////////////////////////////////////////////////////////////////////////////////////









<label>Show <select onchange="selectId()" name="myTablelength" id="myTablelength">
           <option value="5" <?php if ($_GET['length'] == 5) {
    echo "selected";
}
?>>5</option>
           <option value="10" <?php if ($_GET['length'] == 10) {
    echo "selected";
}
?>>10</option>
           <option value="20" <?php if ($_GET['length'] == 20) {
    echo "selected";
}
?>>20</option>
           <option value="50" <?php if ($_GET['length'] == 50) {
    echo "selected";
}
?>>50</option>
         </select> entries</label>




function selectId()
     {
       var x = document.getElementById("myTablelength").value;
        const params = new Proxy(new URLSearchParams(window.location.search), {
          get: (searchParams, prop) => searchParams.get(prop),
        });
        let value = params.page;
        if(params.page){
          location.href = 'view.php?page='+value+'&length=' + x;
        }
        else{
          location.href = 'view.php?length=' + x;
        }
     }

----------------------------------------------------------------------------------------------------

<?php
$query = "SELECT * FROM register LIMIT $start_from,$num_per_page";
$sql = $conn->query($query);
if ($sql) {
    while ($row = mysqli_fetch_assoc($sql)) {
        ?>
                 <tr>
                   <td><?php echo $row['id']; ?></td>
                   <td><?php echo $row['name']; ?></td>
                   <td><?php echo $row['email']; ?></td>
                   <td><?php echo $row['dob']; ?></td>
                   <td><?php echo $row['gender']; ?></td>
                   <td><img src="upload/<?php echo $row['image']; ?>" width="100" height="100"></td>
                   <td>
                     <a href="view1.php?id=<?php echo $row['id']; ?>" class='btn btn-info'>View</a>
                     <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                     <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                   </td>
                 </tr>
               <?php
$i++;
    }
    ?>
             <?php
} else {
    echo "No result found";
}
?>
           </tbody>
         </table>
       </div>
       <?php
$query = "SELECT * FROM register";
$sql = mysqli_query($conn, $query);
$totalrecord = mysqli_num_rows($sql);
$totalpages = ceil($totalrecord / $num_per_page);
for ($i = 1; $i <= $totalpages; $i++) {
    if ($_GET['length']) {
        echo "<a href='view.php?length=" . $_GET['length'] . "&page=" . $i . "' class='btn btn-info'>$i</a>";
    } else {
        echo "<a href='view.php?page=" . $i . "' class='btn btn-info'>$i</a>";
    }
}
?>
????????????????????????????????????????????????????????????????????????????????????????
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

</body>
</html>
<!-- <label for="records">Choose a records:</label>
<select id="records">
    <option value="5">5</a></option>
    <option value="10">10</a></option>
    <option value="15">15</a></option>
    <option value="20">20</a></option>
</select> -->
??????????????????????????????????????????????????????????????????????????????????????????????????????????









<form method="GET">
 <select id="records" name="records">
            <option value="10">10</option>
                <option value="20">20</option>
            <option  value="30">30</option>
            <option  value="40">Mostra tutti</option>
            </select><li>
            <li><input type = "submit" class = button2 name = "btnsubmit"></li>
            </form>
 </ul></nav>

<?php
$page_name = "admin_list.php";
$per_page = 10;

if ($result = $con->query("SELECT * FROM clienti  WHERE utenza =1  OR utenza =0 ORDER BY es_insegna_esercizio")) {

    if ($result->num_rows != 0) {
        $total_results = $result->num_rows;
        // ceil() returns the next highest integer value by rounding up value if necessary

        $total_pages = ceil($total_results / $per_page);

        // check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $show_page = $_GET['page'];

            // make sure the $show_page value is valid
            if ($show_page > 0 && $show_page <= $total_pages) {
                $start = ($show_page - 1) * $per_page;
                $end = $start + $per_page;
            } else {
                // error - show first set of results
                $start = 0;
                $end = $per_page;
            }
        } else {
            // if page isn't set, show first set of results
            $start = 0;
            $end = $per_page;
        }

        echo "<table id='my_table' class='tables' name ='tablename'>";

        echo "

          <thead><tr>
                    <th></th>
                    <th>
                <input type = checkbox >
                    </th>
                    <th>Azienda</th>
                     <th>Utente</th>
                     <th>Cognome</th>

          </tr></thead>
              ";

        // loop through results of database query, displaying them in the table
        for ($i = $start; $i < $end; $i++) {
            // make sure that PHP doesn't try to show results that don't exist
            if ($i == $total_results) {break;}
            // find specific row
            $result->data_seek($i);
            $row = $result->fetch_row();
            // echo out the contents of each row into a table
            echo "<tr>";

            echo '<td><img src ="images/edit_icon.png"class = "autoResizeImage" onclick="JavaScript:newPopup(\'admin_edit.php?id=' . $row['0'] . '\')" /></td>';
            echo '<td><input type=checkbox name=chk[] class= chk-box value=' . $row[0] . '/></td>';
            echo '<td>' . $row[14] . '</td>';
            echo '<td>' . $row[2] . '</td>';
            echo '<td>' . $row[3] . '</td>';
            echo '<td>' . $row[4] . '</td>';

            echo "</tr>";
        }
        // close table>
        echo "</table></form>";
    } else {
        echo "No results to display!";
    }
}
// error with the query
else {
    echo "Error: " . $con->error;
}
echo "<p>
 <b>View Page: </b>";
for ($i = 1; $i <= $total_pages; $i++) {
    if (isset($_GET['page']) && $_GET['page'] == $i) {
        echo $i;
    } else {
        echo "<a href='admin_list.php?page=$i'>$i</a> ";
    }
}

echo "</p>";
// close database connection
$con->close();

?>
</form>

</div>\












???????????????/////////////////////////////////////////







///////////////////////////////











<?Php
//****************************************************************************
////////////////////////Downloaded from  www.plus2net.com   //////////////////////////////////////////
///////////////////////  Visit www.plus2net.com for more such script and codes.
////////                    Read the readme file before using             /////////////////////
//////////////////////// You can distribute this code with the link to www.plus2net.com ///
/////////////////////////  Please don't  remove the link to www.plus2net.com ///
//////////////////////////
//*****************************************************************************
?>
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Plus2net.com paging script in PHP</title>
</head>

<body>
<?Php
require "config.php"; // All database details will be included here
$page_name = "demo_paging2.php"; //  If you use this code with a different page ( or file ) name then change this

////// starting of drop down to select number of records per page /////

@$limit = $_GET['limit']; // Read the limit value from query string.
if (strlen($limit) > 0 and !is_numeric($limit)) {
    echo "Data Error";
    exit;
}

// If there is a selection or value of limit then the list box should show that value , so we have to lock that options //
// Based on the value of limit we will assign selected value to the respective option//
switch ($limit) {
    case 2:
        $select2 = "selected";
        $select10 = "";
        $select5 = "";
        break;

    case 5:
        $select5 = "selected";
        $select10 = "";
        $select2 = "";
        break;

    default:
        $select10 = "selected";
        $select5 = "";
        $select2 = "";
        break;

}

@$start = $_GET['start'];
if (strlen($start) > 0 and !is_numeric($start)) {
    echo "Data Error";
    exit;
}

echo "Select Number of records per page: <form method=get action=$page_name>
<select name=limit>
<option value=10 $select10>10 Records</option>
<option value=5 $select5>5 Records</option>
<option value=2 $select2>2 Records</option>
</select>
<input type=submit value=GO>";

// You can keep the below line inside the above form, if you want when user selection of number of
// records per page changes, it should not return to first page.
// <input type=hidden name=start value=$start>
////////////////////////////////////////////////////////////////////////
//
///// End of drop down to select number of records per page ///////

$eu = ($start - 0);

if (!$limit > 0) { // if limit value is not available then let us use a default value
    $limit = 10; // No of records to be shown per page by default.
}
$this1 = $eu + $limit;
$back = $eu - $limit;
$next = $eu + $limit;

/////////////// Total number of records in our table. We will use this to break the pages///////
$nume = $dbo->query("select count(id) from student")->fetchColumn();
/////// The variable nume above will store the total number of records in the table////

/////////// Now let us print the table headers ////////////////
$bgcolor = "#f1f1f1";
echo "<TABLE width=50% align=center  cellpadding=0 cellspacing=0> <tr>";
echo "<td  bgcolor='dfdfdf' >&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='4'>Name</font></td>";
echo "<td  bgcolor='dfdfdf' >&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='4'>Class</font></td>";
echo "<td  bgcolor='dfdfdf'>&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='4'>Mark</font></td></tr>";

////////////// Now let us start executing the query with variables $eu and $limit  set at the top of the page///////////
$query = " SELECT * FROM student  limit $eu, $limit ";
//////////////// Now we will display the returned records in side the rows of the table/////////
foreach ($dbo->query($query) as $row) {

    if ($bgcolor == '#f1f1f1') {$bgcolor = '#ffffff';} else { $bgcolor = '#f1f1f1';}

    echo "<tr >";
    echo "<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='2'>$row[name]</font></td>";
    echo "<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='2'>$row[class]</font></td>";
    echo "<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='2'>$row[mark]</font></td>";

    echo "</tr>";
}
echo "</table>";
////////////////////////////// End of displaying the table with records ////////////////////////

/////////////// Start the buttom links with Prev and next link with page numbers /////////////////
echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";
//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
if ($back >= 0) {
    print "<a href='$page_name?start=$back&limit=$limit'><font face='Verdana' size='2'>PREV</font></a>";
}
//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
echo "</td><td align=center width='30%'>";
$i = 0;
$l = 1;
for ($i = 0; $i < $nume; $i = $i + $limit) {
    if ($i != $eu) {
        echo " <a href='$page_name?start=$i&limit=$limit'><font face='Verdana' size='2'>$l</font></a> ";
    } else {echo "<font face='Verdana' size='4' color=red>$l</font>";} /// Current page is not displayed as link and given font color red
    $l = $l + 1;
}

echo "</td><td  align='right' width='30%'>";
///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
if ($this1 < $nume) {
    print "<a href='$page_name?start=$next&limit=$limit'><font face='Verdana' size='2'>NEXT</font></a>";}
echo "</td></tr></table>";

?>
 <br><br>
<a href=demo_paging1.php>PHP paging demo I ></a> |
<a href=demo_paging2.php> User managing records per page</a> | <a href=demo_paging4.php>Sorting by column</a> |

<br><br>
<center><a href='http://www.plus2net.com' rel="nofollow">PHP SQL HTML free tutorials and scripts</a></center>

</body>

</html>




?????????????//////////////////I have a table that displays the records stored in a database. I have customized my pagination differently from what bootstrap uses to look like phpMyAdmin table pagination. What I have done so far works perfectly but refreshes the page on each user selection. I am stuck on how to use ajax to make the pagination work fine without refreshing the page.

Here's the HTML code to display the table with checkbox, select input and pagination links

            <!--DISPLAY TABLE-->
    <form class="" name="frmDisplay" id="frmDisplay" method="POST" action="">
        <div id="display_table"></div>
            <input type="checkbox" name="check" id="check" onchange=""></input> <label for="check">Show All</label>

                    <label class="clabel">|</label>

                    <label class="clabel" for="rowno">Number of Rows:</label>
                    <select class="" id="rowno" name="rowno" style="width:50px;height:25px;margin-bottom:3px;">
                        <option value='all' hidden disabled>All</option>
                        <?php
//set the value of $rowno
$rowno = isset($_POST['rowno']) ? $_POST['rowno'] : 5;
if ($rowno == 5) {
    $rowno = isset($_GET['limit']) ? $_GET['limit'] : 5;
}
?>
                        <option value='5' <?=$rowno == 5 ? 'selected' : ''?>>5</option>
                        <option value='10' <?=$rowno == 10 ? 'selected' : ''?>>10</option>
                        <option value='15' <?=$rowno == 15 ? 'selected' : ''?>>15</option>
                        <option value='20' <?=$rowno == 20 ? 'selected' : ''?>>20</option>
                        <option value='25' <?=$rowno == 25 ? 'selected' : ''?>>25</option>
                        <option value='30' <?=$rowno == 30 ? 'selected' : ''?>>30</option>
                    </select>

                    <label class="clabel">|</label>

                    <label class="clabel" for="filter">Filter Rows:</label>
                    <input class="" style="width:50%;height:25px;margin-bottom:10px;" id="filter" name="filter" placeholder="Filter this table" onkeyup="filtertbl();"></input>
            <div class='table-responsive-sm' style='width:100%;margin-top:10px;'>
                        <?php
//code to fetch all records from database on checkbox checked
if (isset($_POST['check'])) {
    $sql = "SELECT *FROM evatbl WHERE RegNo = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("s", $pregno);
        $pregno = $_SESSION['regno'];
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $count = 1;
            echo "<table id='t01'' class='table'>
                                        <tr id='tblhead'>
                                        <th>SN</th>
                                        <th>Course Title</th>
                                        <th>Course Code</th>
                                        <th>Credit Unit</th>
                                        <th>Course Lecturer</th>
                                        <th>Rating(%)</th>
                                        </tr>";
            while ($row = $result->fetch_assoc()) {
                $ccode = $row['CourseCode'];
                $ctitle = $row['CourseTitle'];
                $cunit = $row['CreditUnit'];
                $clec = $row['CourseLecturer'];
                $crate = $row['Rating'];
                echo "
                                            <tr>
                                            <td>$count</td>
                                            <td>$ctitle</td>
                                            <td>$ccode</td>
                                            <td>$cunit</td>
                                            <td>$clec</td>
                                            <td>$crate</td>
                                            </tr>";
                $count++;
            }
        } else {
            echo "<p style='color:darkblue;margin-bottom:0;'>Oops! No records found.</p>";
        }
    }
} else {
    //code for pagination
    //get current page
    $currentpage = isset($_GET['currentpage']) ? $_GET['currentpage'] : 1;

    $no_of_records_per_page = $rowno;
    $setoff = ($currentpage - 1) * $no_of_records_per_page;

    //get total number of records in database
    $sqlcount = "SELECT *FROM evatbl WHERE RegNo = ?";
    $stmt = $con->prepare($sqlcount);
    $stmt->bind_param("s", $pregno);
    $pregno = $_SESSION['regno'];
    $stmt->execute();
    $result = $stmt->get_result();
    $num_rows = $result->num_rows;
    $totalpages = ceil($num_rows / $no_of_records_per_page);

    //query for pagination
    $sqllimit = "SELECT *FROM evatbl WHERE RegNo = ? ORDER BY CourseTitle LIMIT $setoff, $no_of_records_per_page";
    if ($stmt = $con->prepare($sqllimit)) {
        $stmt = $con->prepare($sqllimit);
        $stmt->bind_param("s", $pregno);
        $pregno = $_SESSION['regno'];
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $count = 1;
            echo "<table id='t01' class='table' width='100%'>
                                        <tr id='tblhead'>
                                        <th>SN</th>
                                        <th>Course Title</th>
                                        <th>Course Code</th>
                                        <th>Credit Unit</th>
                                        <th>Course Lecturer</th>
                                        <th>Rating(%)</th>
                                        </tr>";
            while ($row = $result->fetch_assoc()) {
                $ccode = $row['CourseCode'];
                $ctitle = $row['CourseTitle'];
                $cunit = $row['CreditUnit'];
                $clec = $row['CourseLecturer'];
                $crate = $row['Rating'];
                echo "
                                            <tr>
                                            <td>$count</td>
                                            <td>$ctitle</td>
                                            <td>$ccode</td>
                                            <td>$cunit</td>
                                            <td>$clec</td>
                                            <td>$crate</td>
                                            </tr>";
                $count++;
            }
        } else {
            echo "<p style='color:darkblue;margin-bottom:0;'>Oops! No records found.</p>";
        }
        echo "</table>";
        ?><br>
                                        <div class="nav_div">
                                            <?php
//First Page Button
        if ($currentpage > 1) {
            echo "<a class='nav_a' href='view_eva.php?limit=" . $rowno . "¤tpage=" . (1) . "' title='First'><<</a>";
        }
        //Previous Page Button
        if ($currentpage >= 2) {
            echo "<a class='nav_a' href='view_eva.php?limit=" . $rowno . "¤tpage=" . ($currentpage - 1) . "' title='Previous'><</a>";
        }
        ?>

                                        <select class='navno' name='navno' id='navno' onchange="pageNav(this)">
                                        <?php
//Link to available number of pages with select drop-down
        for ($i = 1; $i <= $totalpages; $i++) {
            echo "<option class='bold'";
            if ($currentpage == $i) {
                echo "selected";
            }
            echo " value='view_eva.php?limit=" . $rowno . "¤tpage=" . $i . "'>" . $i . "</option>";
        }
        ?>
                                        </select>

                                        <?php
//Next Page Button
        if ($currentpage < $totalpages) {
            echo "<a class='nav_a' href='view_eva.php?limit=" . $rowno . "¤tpage=" . ($currentpage + 1) . "' title='Next'>></a>";
        }
        //Last Page Button
        if ($currentpage <= $totalpages - 1) {
            echo "<a class='nav_a' href='view_eva.php?limit=" . $rowno . "¤tpage=" . ($currentpage = $totalpages) . "' title='Last'>>></a>";
        }
        ?>
                                        </div>
                                    <?php
}
}
?>
                    </form>
                </div>
            </div>



            ?????????????????????????????????????????????|\\\\\\\








            <!doctype html>
<html>
<head>
    <?php
include "config.php";

// generating orderby and sort url for table header
function sortorder($fieldname)
{
    $sorturl = "?order_by=" . $fieldname . "&sort=";
    $sorttype = "asc";
    if (isset($_GET['order_by']) && $_GET['order_by'] == $fieldname) {
        if (isset($_GET['sort']) && $_GET['sort'] == "asc") {
            $sorttype = "desc";
        }
    }
    $sorturl .= $sorttype;
    return $sorturl;
}
?>
</head>
<body>
<div id="content">
    <table width="100%" id="emp_table" border="0">
        <tr class="tr_header">
            <th>S.no</th>
            <th ><a href="<?php echo sortorder('emp_name'); ?>" class="sort">Name</a></th>
            <th ><a href="<?php echo sortorder('salary'); ?>" class="sort">Salary</a></th>
            <th ><a href="<?php echo sortorder('gender'); ?>" class="sort">Gender</a></th>
            <th ><a href="<?php echo sortorder('city'); ?>" class="sort">City</a></th>
            <th ><a href="<?php echo sortorder('email'); ?>" class="sort">Email</a></th>
        </tr>
        <?php

// selecting rows
$orderby = " ORDER BY id desc ";
if (isset($_GET['order_by']) && isset($_GET['sort'])) {
    $orderby = ' order by ' . $_GET['order_by'] . ' ' . $_GET['sort'];
}

// fetch rows
$sql = "SELECT * FROM employee " . $orderby . " limit $row," . $rowperpage;
$result = mysqli_query($con, $sql);
$sno = $row + 1;
while ($fetch = mysqli_fetch_array($result)) {
    $name = $fetch['emp_name'];
    $salary = $fetch['salary'];
    $gender = $fetch['gender'];
    $city = $fetch['city'];
    $email = $fetch['email'];
    ?>
            <tr>
                <td align='center'><?php echo $sno; ?></td>
                <td align='center'><?php echo $name; ?></td>
                <td align='center'><?php echo $salary; ?></td>
                <td align='center'><?php echo $gender; ?></td>
                <td align='center'><?php echo $city; ?></td>
                <td align='center'><?php echo $email; ?></td>
            </tr>
            <?php
$sno++;
}
?>
    </table>
    <form method="post" action="">
        <div id="div_pagination">
            <input type="hidden" name="row" value="<?php echo $row; ?>">
            <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
            <input type="submit" class="button" name="but_prev" value="Previous">
            <input type="submit" class="button" name="but_next" value="Next">
        </div>
    </form>
</div>
</body>
</html>
?????????????????????????????????????????????????????????????????????????????????????



for ($i = 1; $i <= $totalpages; $i++)
         {
          if($_GET['length'] && $_GET['search']){
             echo "<a href='view.php?length=".$_GET['length']."&search=".$_GET['search']."&page=" . $i . "' class='btn btn-info'>$i</a>";
          }
          elseif($_GET['search']){
            echo "<a href='view.php?search=".$_GET['search']."&page=" . $i . "' class='btn btn-info'>$i</a>";

          }
          elseif($_GET['length']){
            echo "<a href='view.php?length=".$_GET['length']."&page=" . $i . "' class='btn btn-info'>$i</a>";

          }
          else{
            echo "<a href='view.php?page=" . $i . "' class='btn btn-info'>$i</a>";
          }
------------------------------------------------------------------------------------------------
function searchID()
     {
        var y = document.getElementById("search").value;
          const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
          });
          let value = params.search;
          if(params.search){
            location.href = 'view.php?search='+value+'&page=' + y;
          }
          else{
            location.href = 'view.php?search=' + y;
          }
     }


     / function selectId() {
//     var x = document.getElementById("myTablelength").value;
//     var params = new Proxy(new URLSearchParams(window.location.search), {
//         get: (searchParams, prop) => searchParams.get(prop),
//     });
//     var newconst = new URLSearchParams(window.location.search);
//     let value = params.length;
//     if (params.length) {
//         params.length = x
//         console.log("if ", params);
//         var href = 'load.php?' + params;
//     } else if(params) {
//         console.log("else if ", params);
//         var href = 'load.php' + params + '&length=' + x;
//     }
//         var href = 'load.php?length=' + x;
//     }
//     console.log('href', href);
// }
// var paramss = window.location.search
// console.log("length", paramss);



// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";















  // $("#search").on("keyup", function() {
    //     var search_term = $(this).val();

    //     $.ajax({
    //         url: "table.php",
    //         type: "get",
    //         data: {
    //             search: search_term
    //         },
    //         success: function(data) {
    //             $("#table-data").html(data);
    //         }
    //     });
    // });
    // $(document).ready(function() {
    //     var length = $("#length").val();
    //     var colname = $("#colname").val();

    //     function loadTable(page) {
    //         $.ajax({
    //             url: "table.php",
    //             type: "POST",
    //             data: {
    //                 page_no: page,
    //                 length: length,
    //                 colname: colname
    //             },
    //             success: function(data) {
    //                 $("#table-data").html(data);
    //             }
    //         });
    //     }
    //     loadTable();

    //     $(document).on("click", "#pagination a", function(e) {
    //         e.preventDefault();
    //         var page_id = $(this).attr("id");

    //         loadTable(page_id);
    //     })
    // });
    // $(document).ready(function() {
    //     $(document).on('click', '.column_sort', function() {
    //         var column_name = $(this).attr("id");
    //         var order = $(this).data("order");
    //         var arrow = '';

    //         if (order == 'desc') {
    //             arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';
    //         } else {
    //             arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';
    //         }
    //         $.ajax({
    //             url: "sort.php",
    //             method: "POST",
    //             data: {
    //                 column_name: column_name,
    //                 order: order
    //             },
    //             success: function(data) {
    //                 $('#table-data').html(data);
    //                 $('#' + column_name + '').append(arrow);
    //                 table();
    //             }
    //         })
    //     });
    // });