<!-- Display all animals on a single web page (home.php). the admin & the user should be able to see them -->

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
   $backBtn = "profile.php";    
  }
  
  //if it is a adm it will create a back button to dashboard.php
  if(isset($_SESSION["adm"])){
   $backBtn = "dashboard.php";    
  }
  $sql = "SELECT * FROM pets";
  $colbody = '';
  $result = mysqli_query($connect, $sql);
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $colbody .='
        <div class="col">
          <div class="card">
            <img src="pictures/pets/'.$row['picture'].'" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Meet '.$row['pet_name'].'</h5>
              <p class="card-text">'.$row['pet_descr'].'</p>
              <p class="card-text">Date of birth: '.$row['pet_date_of_birth'].'</p>
              <p class="card-text">Type: a '.$row['pet_size'].' '.$row['breed']. '</p>
              <p class="card-text">Address of shelter: '.$row['location']. '</p>
              <form action="home.php" method="post">
                <input type="hidden" name="petID" class="form-control" value="'.$row['petID'].'"/>
                <button class="btn" name="submitb" type="submit">Take me home</a></button>
              </form>
            </div>
          </div>
        </div>
      ';
    }
  } else {
    $colbody = '<div class="col">No Data Available</div>';
  } 


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

  </header>

  <main>
    <div class="container">
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <?= $colbody ;?>
      </div>
    </div>

  </main>
  
</body>
</html>