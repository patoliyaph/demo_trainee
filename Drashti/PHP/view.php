<?php
include 'database.php';
session_start();
if (!isset($_SESSION['email'])) {
  header("location:login.php");
}
$length = $_GET['length'] ?? 5;
$page = $_GET['page'];
$search = $_GET['search'];
$num_per_page = $length;
if (isset($page)) {
  $page = $page;
} else {
  $page = 1;
}
$start_from = ($page - 1) * 5;
$query = "SELECT * FROM register";
$sql = mysqli_query($conn, $query);

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
<html lang="en">

<head>
  <title>View Data</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script>
    function selectId() {
      var length = document.getElementById("length").value;
      var search = document.getElementById("search").value;
      var sort = document.getElementById("sort").value;
      var order_by = document.getElementById("order_by").value;
      var hidField = document.getElementById("hidField").value;

      var query = '';
      if (length) {
        query = query + '&length=' + length;
      }
      if (search) {
        query = query + '&search=' + search;
      }
      if (sort) {
        query = query + '&sort=' + sort;
      }
      if (order_by) {
        query = query + '&order_by=' + order_by;
      }
      if (hidField) {
        query = query + '&hidField=' + hidField;
      }
      location.href = 'view.php?' + query;
    }

    function myFunction() {
      var id = alert("Are You Sure Delete Record..!!");
      location.href = 'delete.php?id=' + id;
    }
    $(document).ready(function() {
      $("#hidField").keyup(function() {
        alert($(this).val());
      });
    })
  </script>
</head>
<body>
  <div class="container my-5">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-body">
            <h2 class=text-center>View Data</h2>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <form method="GET">
              <div class="form-group col-md-4">
                <input class="form-control rounded-2 py-2" type="search" onchange="selectId()" value="<?php echo $search; ?>" placeholder="Search" id="search">
              </div>
              <div class="text-right">
                <a href="register.php" class="btn btn-info">Add</a>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
                <a href="cpass.php" class="btn btn-warning">ChangePassword</a>
              </div>
              <div>
                <label>show <select class="btn btn-light dropdown-toggle" onchange="selectId()" id="length">
                    <option value="5" <?php if ($length == 5) echo "selected"; ?>>5</option>
                    <option value="10" <?php if ($length == 10) echo "selected"; ?>>10</option>
                    <option value="20" <?php if ($length == 20) echo "selected"; ?>>20</option>
                    <option value="50" <?php if ($length == 50) echo "selected"; ?>>50</option>
                  </select> entries</label>
                <input type="hidden" id="sort" value="<?php echo $_GET['sort'] ?? ''; ?>">
                <input type="hidden" id="order_by" value="<?php echo $_GET['order_by'] ?? ''; ?>">
                <input type="hidden" id="hidField" value="<?php echo $_GET['sort'] ?? ''; ?>">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th><a href="<?php echo sortorder('id'); ?>" class="sort">ID</a></th>
                      <th><a href="<?php echo sortorder('name'); ?>" class="sort">Name</a></th>
                      <th><a href="<?php echo sortorder('email'); ?>" class="sort">Email</a></th>
                      <th><a href="<?php echo sortorder('dob'); ?>" class="sort">DOB</a></th>
                      <th><a href="<?php echo sortorder('gender'); ?>" class="sort">Gender</a></th>
                      <th><a href="<?php echo sortorder('image'); ?>" class="sort">Image</a></th>
                      <th><a href="<?php echo sortorder('action'); ?>" class="sort">Action</a></th>
                    </tr>
                  </thead>
                  <tbody id="table">
                    <?php
                    $orderby = " ORDER BY id asc ";
                    if (isset($_GET['order_by']) && isset($_GET['sort'])) {
                      $orderby = ' order by ' . $_GET['order_by'] . ' ' . $_GET['sort'];
                    }
                    $value = $search;
                    if ($search) {
                      $query = "SELECT * FROM register  WHERE CONCAT(id,name,email,gender) like '%$value%' LIMIT $start_from,$num_per_page";
                      $sql = mysqli_query($conn, $query);
                    } else {
                      $query = "SELECT * FROM register $orderby LIMIT  $start_from,$num_per_page";
                      $sql = mysqli_query($conn, $query);
                    }
                    ?>
                    <?php
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
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="myFunction()" class="btn btn-danger">Delete</a>
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
              $query =  "SELECT * FROM register ";
              $sql = mysqli_query($conn, $query);
              $totalrecord = mysqli_num_rows($sql);
              $totalpages = ceil($totalrecord / $num_per_page);
              for ($i = 1; $i <= $totalpages; $i++) {
                if ($length && $search) {
                  echo "<a href='view.php?length=" . $length . "&search=" . $search . "&page=" . $i . "' class='btn btn-info'>$i</a>";
                } else {
                  echo "<a href='view.php?page=" . $i . "' class='btn btn-info'>$i</a>";
                }
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</body>

</html>