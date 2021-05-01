<!-- Display all adoptions on a single web page the admin should be able to see them -->

<?php
  session_start();

  require_once 'components/db_connect.php';

  #session check allowing only logged-in users to see the content
  if(!isset($_SESSION['adm']) && !isset ($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
  }

  $backBtn = '';
  //if it is a user it will create a back button to user's profile.php
  if (isset($_SESSION["user"])){
    header("Location: home.php");
    exit;
  }
  
  //if it is a adm it will create a back button to dashboard.php
  if(isset($_SESSION["adm"])){
   $backBtn = "dashboard.php";    
  }
  $tbody = '';

  $petsQuery = mysqli_query($connect, "SELECT pet_adoption.pet_adoptionID, pets.petID, pets.picture, pets.pet_name, pets.pet_date_of_birth, pets.pet_size, user.userID, user.first_name, user.last_name, user.email
          from pets
          inner join pet_adoption
          on fk_petID = pets.petID
          inner join user
          on fk_userID = user.userID;");
  
  if(mysqli_num_rows($petsQuery)  > 0) {
    while($petRow = mysqli_fetch_array($petsQuery, MYSQLI_ASSOC))
    {
      $tbody .= "
        <tr class='text-center'>
        <td><img class='img-thumbnail' src='pictures/pets/" . $petRow['picture'] . "' alt=" . $petRow['pet_name'] . "></td>
          <td>" . $petRow['pet_adoptionID'] . "</td>
          <td>" . $petRow['userID'] . "</td>
          <td>" . $petRow['first_name'] . " " . $petRow['last_name'] . "</td>
          <td>" . $petRow['email'] . "</td>
          <td>" . $petRow['petID'] . "</td>
          <td>" . $petRow['pet_name'] . "€</td>
          <td>" . $petRow['pet_date_of_birth'] . "</td>
          <td>" . $petRow['pet_size'] . "</td>
        </tr>";
    }
  } else $tbody = '<div class="row g-2 mb-3">No adoptions to display<div>';

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
            <?= $tbody ?>
          </tbody>
        </table>
  </div>
  
</body>
</html>