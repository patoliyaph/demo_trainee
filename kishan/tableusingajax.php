<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display table using ajax</title>
    <link rel="stylesheet" href="datatable.css">
</head>
<body>
    <h1>display data using Ajax</h1>

    <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
            <tbody class = "studentdata">
                
            </tbody>
</table>


<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
        getdata();
    });
    
    function getdata()
    {
        $.ajax({
            type: "GET",
            url: "fetch.php",
            success: function (response) {
                // console.log(response)
                $.each(response, function (key, value) { 
                    //  console.log(value['name']);
                    $('.studentdata').append('<tr>'+
                    '<td>'+value['id']+'</td>\
                    <td>'+value['name']+'</td>\
                    <td>'+value['email']+'</td>\
                    <td>'+value['DOB']+'</td>\
                    <td>'+value['gender']+'</td>\
                    <td><img height="40%" width="40%" src="'+value['photo']+'"/></td>\
                    <td><button style="width:100%;"">view</button>\
                   <button style="width:100%;">edit</button>\
                    <button style="width:100%;">delete</button></td>\
                 </tr>');
                });
            }
        });
    }
  </script>
  
</body>
</html>

