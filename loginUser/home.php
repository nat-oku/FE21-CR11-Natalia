<!-- Display all animals on a single web page (home.php). -->

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
  <link rel="stylesheet" href="css/style.css">

  <title>Vienna Pet Adoption || Home</title>

</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>
    <?php require_once 'partials/hero.php' ?>

  </header>
  
</body>
</html>