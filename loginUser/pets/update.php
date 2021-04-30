<?php
  session_start();

  if (isset($_SESSION[ 'user']) != "") {
     header("Location: ../home.php");
     exit;
  }
  
  if (! isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
     header("Location: ../index.php" );
      exit;
  }
  
  require_once '../components/db_connect.php' ;

  if($_GET['petID']) {
    $petID = $_GET['petID'];
    $sql = "SELECT * FROM pets WHERE petID = {$petID}";
    $result = $connect->query($sql);
    
    if($result->num_rows == 1) {
      $data = $result->fetch_assoc();
      $breed = $data['breed'];
      $pet_name = $data['pet_name'];
      $pet_descr = $data['pet_descr'];
      $pet_date_of_birth = $data['pet_date_of_birth'];
      $hobbies = $data['hobbies'];
      $picture = $data['picture'];
      $pet_size = $data['pet_size'];
      $location = $data['location'];
    } else {
      header("location: error.php");
    }
    $connect->close();
  } else {
    header("location: error.php");
  }

?>