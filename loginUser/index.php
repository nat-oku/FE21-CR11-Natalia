<!-- No login necessary, info about the ogranisation, display all animals on a single web page (index.php). -->

<?php
  require_once 'components/db_connect.php';


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
  </style>

  <title>Vienna Pet Adoption || Home</title>

</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>
    <?php require_once 'partials/hero.php' ?>

  </header>

  <div class="container mt-4 mb-4">
    
    <h2 class="text-center">Welcome to Vienna Pet Adoption<h2>
    <h5 class="text-center fw-light">We are a NGO which rescues animals from bad places and gives them a new home full of love.</h5>
    <h5 class="text-center fw-light"><i class="fas fa-paw"></i>
    <i class="far fa-heart text-orange"></i> Because everyone deserves love <i class="fas fa-paw"></i>
    <i class="far fa-heart text-orange"></i></h5>

  </div>
  
</body>
</html>