<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <title>My Shop</title>
</head>
<body>
     <div class="container my-5">
          <h2 >List of Clients</h2>
          <a href="/myshop/create.php" class="btn btn-secondary">New Client</a>
          <br>
          <table class="table">
               <thead>
                    <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    $servername = "localhost";
                    $username ="root";
                    $password = "";
                    $database = "myshop";

                    //create connection with database
                    $connection = new mysqli(
                         $servername, 
                         $username, 
                         $password, 
                         $database
                    );

                    //check connection status
                    if ($connection->connect_error) {
                         die("Connection failed: " . $connection->connect_error);
                    }

                    // read all row from database table
                    $sql = "SELECT * FROM clients";
                    $result = $connection->query($sql);

                    if (!$result) {
                    die("Invalid query:".$connection->error);
                    }

                    // read data of each row

                    while ($row = $result->fetch_assoc()) {
                         echo"
                           <tr>
                              <td>$row[id]</td>
                              <td>$row[firstname]</td>
                              <td>$row[email]</td>
                              <td>$row[phone]</td>
                              <td>$row[address]</td>
                              <td>$row[created_at]</td>
                              <td>
                                   <a 
                                        href='/myshop/edit.php?id=$row[id]' 
                                        class='btn btn-info btn-sm'
                                   >
                                        Edit
                                   </a>
                                   <a 
                                        href='/myshop/delete.php?id=$row[id]' 
                                        class='btn btn-danger btn-sm'
                                   >
                                        Delete
                                   </a>
                              </td>
                    </tr>
                    ";
                    }
                    ?>
                  
               </tbody>
          </table>
     </div>
   
</body>
</html>