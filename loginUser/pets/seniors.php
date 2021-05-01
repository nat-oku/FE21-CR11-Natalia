<!-- Display all animals on a single web page (home.php). the admin & the user should be able to see them -->

<?php
  session_start();

  require_once '../components/db_connect.php';

  #session check allowing only logged-in users to see the content
  if(!isset($_SESSION['adm']) && !isset ($_SESSION['user']) ) {
    header("Location: ../index.php");
    exit;
  }

  $backBtn = '';
  //if it is a user it will create a back button to user's profile.php
  if (isset($_SESSION["user"])){
   $backBtn = "../profile.php";    
  }
  
  //if it is a adm it will create a back button to dashboard.php
  if(isset($_SESSION["adm"])){
   $backBtn = "../dashboard.php";    
  }
  $sql = "SELECT * FROM pets where pet_date_of_birth <= '2013-12-31'";
  $colbody = '';
  $result = mysqli_query($connect, $sql);
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $colbody .='
      <div class="col fw-light">
        <div class="card-group h-100">
            <img src="../pictures/pets/'.$row['picture'].'" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title text-green">Meet '.$row['pet_name'].'</h5>
              <p class="card-text">'.$row['pet_descr'].'</p>
              <p class="card-text">Date of birth: '.$row['pet_date_of_birth'].'</p>
              <p class="card-text">Type: a '.$row['pet_size'].' '.$row['breed']. '</p>
              <p class="card-text">Address of shelter: '.$row['location']. '</p>
              <form action="seniors.php" method="post">
              <input type="hidden" name="petID" class="form-control" value="'.$row['petID'].'"/>
              <button class="btn border-gold" name="submitb" type="submit">Take me home</a></button>
            </form>
            </div>
          </div>
        </div>
      ';
    }
  } else {
    $colbody = '<div class="col">No Data Available</div>';
  }

  if(isset($_POST['submitb'])) {
    $petID = $_POST['petID'];
    $userID = $_SESSION['user'];
    $sql = "INSERT INTO pet_adoption (fk_petID, fk_userID) VALUES ('$petID', '$userID')";
    if($connect->query($sql) === true){
      $msg = 'Congrats, you adopted a pet!';
      echo "<script type='text/javascript'>alert('$msg');</script>";
    } else {
      $msg = 'Something went wrong, try again later';
      echo "<script type='text/javascript'>alert('$msg');</script>";
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
  <?php require_once '../components/boot_fonts.php' ?>
    <style>
      <?php include '../css/style.css'; #adding css to file ?>
    </style>

  <title>Vienna Pet Adoption || Home</title>

</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once '../partials/navbar.php' ?>

  </header>

  <main>
    <div class="container mt-4 mb-4">
    <div class="mb-3 text-center">
        <h2>Our seniors <i class="far fa-heart text-orange"></i></h2>
        <h4 class="fw-light">Here you can find the senior animals who are older than 8 years and didn't find a home yet. <br> Will YOU adopt him?<h4>
        <h6 class="fw-light">With a click on the button "Take me home", you agree to adopt the selected pet.</h6>
      </div>
      <a href="<?php echo $backBtn?>" ><button class="btn bg-green text-light mt-1 mb-3" type="button">Back to your profile</button></a>
      <a href="../home.php" ><button class="btn bg-gold text-light mt-1 mb-3" type="button">See all pets</button></a>
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <?= $colbody ;?>
      </div>
    </div>

  </main>
  
</body>
</html>