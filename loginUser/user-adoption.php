<?php 
  session_start();
  require_once 'components/db_connect.php';
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['adm']) && !isset($_SESSION['user' ]) ) {
    header("Location: index.php");
    exit;
    }
  if(isset($_SESSION["user" ])){
    header("Location: home.php");
    exit;
    }

     //initial bootstrap class for the confirmation message
     $class = 'd-none';
     //the GET method will show the info from user's order to be deleted
     if($_GET['userID']) {
       $userID = $_GET['userID'];
       $adoptRes = mysqli_query($connect, "SELECT pets.picture, pets.pet_name, pet_adoption.pet_adoptionID, user.userID, user.first_name, user.last_name, user.email, pets.petID, pets.pet_date_of_birth, pets.pet_size 
       from pet_adoption 
       join pets on fk_petID = pets.petID
       join user on fk_userID = user.userID
       where fk_userID = {$userID}");
       $adoptTable = '';
   
       if(mysqli_num_rows($adoptRes) > 0) {
         while($adoptRow = mysqli_fetch_array($adoptRes, MYSQLI_ASSOC))
         {
           $adoptTable .="
           <tr class='text-center'>
            <td><img class='img-thumbnail' src='pictures/pets/" . $adoptRow['picture'] . "' alt=" . $adoptRow['pet_name'] . "></td>
             <td>" . $adoptRow['pet_adoptionID'] . "</td>
             <td>" . $adoptRow['userID'] . "</td>
             <td>" . $adoptRow['first_name'] . " " . $adoptRow['last_name'] . "</td>
             <td>" . $adoptRow['email'] . "</td>
             <td>" . $adoptRow['petID'] . "</td>
             <td>" . $adoptRow['pet_name'] . "€</td>
             <td>" . $adoptRow['pet_date_of_birth'] . "</td>
             <td>" . $adoptRow['pet_size'] . "</td>
           </tr>";
         };
       } else {
         $adoptTable ="
             <td class=''>No adoptions to display</td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
         ";
       }
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
  <?php require_once 'components/boot_fonts.php' ?>
  <style>
    <?php include 'css/style.css'; #adding css to file ?>
    .img-thumbnail{
          width: 150px !important;
          height: auto !important;
      }
  </style>

  <title>Vienna Pet Adoption || Adoption List</title>

</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>

  </header>

  <div class="container mt-4 mb-4">
    <div class="mb-3 text-center">
      <h2>All adoptions</h2>
    </div>
    <a href="dashboard.php" ><button class="btn bg-green text-light mt-1 mb-3" type="button">Back to dashboard</button></a>
    <a href="home.php" ><button class="btn bg-gold text-light mt-1 mb-3" type="button">See all pets</button></a>
        <table class="table">
          <thead class="bg-green text-light">
            <tr>
              <th>Picture</th>
              <th>Adoption id</th>
              <th>User id</th>
              <th>User name</th>
              <th>Email</th>
              <th>Pet id</th>
              <th>Pet name</th>
              <th>Date of birth</th>
              <th>Pet size</th>
            </tr>
          </thead>
          <tbody>
            <?= $adoptTable; ?>
          </tbody>
        </table>
  </div>
  
</body>
</html>