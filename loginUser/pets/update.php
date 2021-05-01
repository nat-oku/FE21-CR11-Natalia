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


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS & fonts -->
  <?php require_once '../components/boot_fonts.php' ?>
  <style type="text/css">
             fieldset {
               margin: auto;
               margin-top: 100px;
               width: 60% ;
           }  
           .img-thumbnail{
              width: 300px !important;
              height: 300px !important;
           }    
      <?php include '../css/style.css'; #adding css to file ?>
  </style>
  <title>VPA || Update request</title>
</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once '../partials/navbar.php' ?>
  </header>
  <div class="container mt-4 mb-4">
    <h2>Update request</h2>
    <div class="d-flex flex-row">
      <img class='img-thumbnail m-4' src='../pictures/pets/<?php echo $picture ?>' alt="<?php echo $breed ?>">

      <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
      <table class="table">
        <tr>
          <th>Breed</th>
          <td><input class ="form-control" type="text" name="breed" placeholder="Breed" value="<?php echo $breed ?>" /></td>
        </tr>
        <tr>
          <th>Pet name</th>
          <td><input class ="form-control" type="text" name="pet_name" placeholder="Pet Name" value="<?php echo $pet_name ?>" /></td>
        </tr>
        <tr>
          <th>Description</th>
          <td><input class ="form-control" type="text" name="pet_descr" placeholder="Description of the pet" value="<?php echo $pet_descr ?>" /></td>
        </tr>
        <tr>
          <th>Date of birth</th>
          <td><input class ="form-control  w-50" type="date" name="pet_date_of_birth" placeholder="Date of birth" value="<?php echo $pet_date_of_birth ?>" /></td>
        </tr>
        <tr>
          <th>Hobbies</th>
          <td><input class ="form-control" type="text" name="hobbies" placeholder="Hobbies" value="<?php echo $hobbies ?>" /></td>
        </tr>
        <tr>
          <th>Picture</th>
          <td><input class="form-control" type="file" name="picture"/></td>
        </tr>
        <tr>
          <th>Size</th>
          <td><input class ="form-control" type="text" name="pet_size" placeholder="small/large" value="<?php echo $pet_size ?>" /></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><input class ="form-control" type="text" name="location" placeholder="Address of pet's current animal sanctuary" value="<?php echo $location ?>" /></td>
        </tr>
        <tr>
        <input type="hidden" name="petID" value= "<?php echo $data['petID'] ?>" />
        <input type="hidden" name= "picture" value= "<?php echo $data['picture'] ?>" />
        <td>
          <button class ="btn bg-green text-light" type="submit">Save Changes</button>
        </td>
        <td>
          <a href="index.php"><button class="btn bg-orange text-light" type ="button">Back</button></a>
        </td>
        </tr>
      </table>
    </form>
    </div>
    

  </div>
  
</body>
</html>