<?php
  session_start();
  require_once '../components/db_connect.php';


  if (isset($_SESSION['user']) != "" ) {
    header("Location: ../home.php");
    exit;
  }

  if (!isset($_SESSION['adm' ]) && !isset($_SESSION['user'])) {
    header("Location: ../index.php" );
      exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- CSS & fonts -->
  <?php require_once '../components/boot_fonts.php' ?>
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
       <?php include '../css/style.css'; #adding css to file ?>
   </style>
   
  <title>VPA || Add pet</title> </head></head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once '../partials/navbar.php' ?>
  </header>
  <div class="container mt-4 mb-4">
    <h2>Add pet</h2>
    <form action="actions/a_create.php"  method= "post" enctype= "multipart/form-data">
      <table class="table">
        <tr>
          <th>Breed</th>
          <td>
            <input class='form-control' type="text" name="breed" placeholder="Breed">
          </td>
        </tr>
        <tr>
          <th>Pet name</th>
          <td>
            <input class='form-control' type="text" name="pet_name" placeholder="Pet Name">
          </td>
        </tr>
        <tr>
          <th>Description</th>
          <td>
            <input class='form-control' type="text" name="pet_descr" placeholder="Description of the pet">
          </td>
        </tr>
        <tr>
          <th>Date of birth</th>
          <td>
            <input class='form-control w-50' type="date" name="pet_date_of_birth" placeholder="Date of birth">
          </td>
        </tr>
        <tr>
          <th>Hobbies</th>
          <td>
            <input class='form-control' type="text" name="hobbies" placeholder="Pet's hobbies">
          </td>
        </tr>
        <tr>
          <th>Picture</th>
          <td>
            <input class='form-control' type= "file" name="picture" />
          </td>
        </tr>
        <tr>
          <th>Size</th>
          <td>
            <input class='form-control' type="text" name="pet_size" placeholder="small/large">
          </td>
        </tr>
        <tr>
          <th>Location</th>
          <td>
            <input class='form-control' type="text" name="location" placeholder="Address of pet's current animal sanctuary">
          </td>
        </tr>
        <tr>
          <td>
            <button class='btn bg-green text-light' type="submit">Insert Pet </button></td>
            <td><a href="index.php"><button class='btn bg-orange text-light' type="button">Go back</button></a></td>
          </td>
        </tr>
       </table>
    </form>
  </div>

</body>
</html>