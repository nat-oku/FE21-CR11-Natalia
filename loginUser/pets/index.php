<!-- this page is visible only for the admin -- who can edit and delete the "pet-entry" from the database -->

<?php
  session_start();
  require_once '../components/db_connect.php' ;

  if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
  }
 
  if (! isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php" );
     exit;
  }

  // create query to select all pets from the DB
  $sqlPets = "SELECT * FROM pets";
  $resultPets = mysqli_query($connect ,$sqlPets);
  $tbody=''; //this variable will hold the body for the table

  if(mysqli_num_rows($resultPets)  > 0) {
    while($rowPets = mysqli_fetch_array($resultPets, MYSQLI_ASSOC)){
      $tbody .= "
        <tr>
          <td>
            <img class='img-thumbnail' src='pictures/" .$rowPets['picture']."'
          </td>
          <td>
            ".$rowPets['name']."
          </td>
          <td>
          ".$rowPets['price']."
          </td>
          <td>
            <a href='update.php?id=".$rowPets['petID']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=".$rowPets['petID']."'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
          </td>
        </tr>
      ";}
  }  else {
    $tbody = "
      <tr>
        <td colspan='5'>
          <center>No Data Available</center>
        </td>
      </tr>
  ";
  }

  $connect->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- CSS & fonts -->
  <?php require_once '../components/boot_fonts.php' ?>
  <link rel="stylesheet" href="../css/style.css">
  <style type= "text/css">
       .manageProduct {          
           margin: auto;
       }
       .img-thumbnail{
           width: 70px !important;
            height: 70px !important;
       }
       td 
       {          
           text-align: left;
           vertical-align: middle;
       }
       tr
       {
           text-align: center;
       }
   </style>
   
  <title>VPA || Pets List</title> </head></head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once '../partials/navbar.php' ?>
  </header>
  <div class="manageProduct w-75 mt-3">   
    <div class='mb-3'>
      <a href="create.php"><button class='btn btn-primary' type="button">Add new pet</button></a>
    </div>
    <h2>All pets</h2>
    <table class='table table-striped'>
        <thead class='table-success'>
            <tr>
                <th>Picture</th>
                <th>Name</th >
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?= $tbody; ?>
        </tbody>
    </table>
  </div>
</body>
</html>