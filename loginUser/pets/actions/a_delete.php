<?php 
  session_start();

  if (isset($_SESSION[ 'user']) != "") {
    header("Location: ../../home.php");
    exit;
  }

  if  (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php" );
      exit;
  }

  require_once '../../components/db_connect.php';

  if ($_POST) {
    $petID = $_POST['petID'];
    $picture = $_POST['picture'];
    ($picture =="pet.png")?: unlink("../../pictures/pets/$picture" );

    $sql = "DELETE FROM pets WHERE petID = {$petID}";
    if ($connect->query($sql) === TRUE) {
    $class = "success";
    $message = "Successfully Deleted!";
  } else {
    $class = "danger";
    $message = "The entry was not deleted due to: <br>" . $connect->error;
  }
  $connect->close();
  } else {
  header( "location: ../error.php");
  }
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS & fonts -->
  <?php require_once '../../components/boot_fonts.php' ?>
  <style>
    <?php include '../../css/style.css'; #adding css to file ?>
  </style>
   <title>VPA || Delete response</title>
</head>
<body>
   <div class="container">
       <div class= "mt-3 mb-3">
           <h1>Delete request response</h1>
       </div>
       <div class="alert alert-<?=$class;?>"  role="alert">
           <p><?=$message;?></p >
           <a  href='../index.php'><button  class="btn btn-success" type= 'button'>Home</button></a>
       </div >
   </div>
</body>
</html>