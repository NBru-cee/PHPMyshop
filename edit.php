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


     $id="";
     $name="";
     $email="";
     $phone = "";
     $address = "";
     $successMessage = "";
     $errorMessage = "";

     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
          // get method: show the data of the client
          if (!isset($_GET['id'])) {
          header("location: /myshop/index.php");
          exit;
          }
          $id = $_GET['id'];

          // read the row of the selected client from database table
          $sql = "SELECT * FROM clients WHERE id =$id";
          $result = $connection->query($sql);
          $row = $result->fetch_assoc();

          if (!$row) {
               header("Location: /myshop/index.php");
               exit;
          }
          $name = $row['name'];
          $email = $row['email'];
          $phone = $row['phone'];
          $address = $row['address'];
     }else{
     // post method: update the data of the client
         $id= $_POST['id'];
         $name= $_POST['name'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $address = $_POST['address'];

          do{
               if (
                    empty($id)||
                    empty($name) || 
                    empty($email) || 
                    empty($phone) || 
                    empty($address)
                    ) {
               $errorMessage= "All fields are required";
               break;
               }

               $sql = "UPDATE clients SET name='$name', email='$email', phone='$phone', address='$address' WHERE id = $id";

               $result = $connection->query($sql);

               if (!$result) {
                    $errorMessage = 
                    "Invalid query:".$connection->error;
                    break;
               }
               
               $successMessage = "Client updated successfully!";
               header("location: /myshop/index.php");
               exit;
          }while(false);
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <title>My Ship</title>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
     <div class="container my-5">
          <h2>New Client</h2>
          <?php  
          if (!empty($errorMessage)) {
             echo"
             <div 
             class='alert alert-warning alert-dismissible fade show' 
             role='alert'>
                    <strong>$errorMessage</strong>
                    <button 
                         type='button'
                         class='btn-close'
                         data-bs-dismiss='alert'
                         aria-label='Close'
                    ></button>
             </div>
             ";
          }
          ?>
          <form method="post">
               <input 
                    type="hidden" 
                    value="<?php echo $id; ?>"
                    name="id"
               >
               <div class="row md-3">
                    <label 
                         for="name" 
                         class="col-sm-3 col-form-label"
                    >
                    Name:
               </label>
                    <div class="col-sm-6">
                         <input 
                              type="text" 
                              class="form-control my-2" 
                              name="name" 
                              value="<?php echo $name; ?>"
                         >
                    </div>
               </div>
               <div class="row md-3">
                    <label 
                         for="email" 
                         class="col-sm-3 col-form-label"
                    >
                    Email:
               </label>
                    <div class="col-sm-6">
                         <input 
                              type="text" 
                              class="form-control my-2" 
                              name="email" 
                              value="<?php echo $email; ?>"
                         >
                    </div>
               </div>
               <div class="row md-3">
                    <label 
                         for="phone" 
                         class="col-sm-3 col-form-label"
                    >
                    Phone:
               </label>
                    <div class="col-sm-6">
                         <input 
                              type="text"
                              class="form-control my-2" 
                              name="phone" 
                              value="<?php echo $phone; ?>"
                         >
                    </div>
               </div>
               <div class="row md-3">
                    <label 
                         for="address" 
                         class="col-sm-3 col-form-label"
                    >
                    Address:
               </label>
                    <div class="col-sm-6">
                         <input 
                              type="text" 
                              class="form-control my-2" 
                              name="address" 
                              value="<?php echo $address; ?>"
                         >
                    </div>
               </div>
               <?php 
               if (!empty($successMessage)) {
                    echo"
                    <div class='row mb-3'>
                         <div class='offset-sm-3 col-sm-6'>
                              <div 
                              class='alert alert-success alert-dismissable fade show'
role='alert'
                              >
                              <strong?>$successMessage</strong>
                               <button 
                                   type='button'
                                   class='btn-close'
                                   data-bs-dismiss='alert'
                                   aria-label='Close'
                    ></button>
                              </div>
                         </div>
                    </div>
                    ";
               }
               ?>
               <div class="row md-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                         <button 
                         type="submit" 
                         class="btn btn-primary"
                         >
                         Submit
                    </button>
                    </div>
                    <div class="col-sm-3 d-grid">
                         <a 
                         class="btn btn-outline-secondary" href="/myshop/index.php" 
                         role="button"
                         >
                         Cancel
                    </a>
                    </div>
               </div>
          </form>
     </div>
</body>
</html>