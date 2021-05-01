<?php
  session_start();

  if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
  }

  if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php" );
      exit;
  }

  require_once '../components/db_connect.php';
  if ($_GET['petID']) {
    $petID = $_GET[ 'petID'];
    $sql = "SELECT * FROM pets WHERE petID = {$petID}" ;
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
      if ($result->num_rows == 1) {
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
  <style type= "text/css">
      fieldset {
           margin: auto;
           margin-top: 100px ;
           width: 70% ;
       }    
       .img-thumbnail{
           width: 70px !important;
           height: 70px !important;
       }
    <?php include '../css/style.css'; #adding css to file ?>
  </style>
  <title>VPA || Delete request</title>
</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once '../partials/navbar.php' ?>
  </header>
  <div class="container">
    <h2>Delete request</h2>
    <img class='img-thumbnail rounded-circle' src='../pictures/pets/<?php echo $picture ?>' alt="<?php echo $breed ?>">
    <h5> You have selected the data below: </h5>
    <table class="table w-75 mt-3">
      <thead class="table-success">
        <tr>
          <th>Pet Id</th>
          <th>Pet breed</th>
          <th>Pet name</th>
          <th>Pet's date of birth</th>
          <th>Location</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $petID?></td>
          <td><?php echo $breed?></td>
          <td><?php echo $pet_name?></td>
          <td><?php echo $pet_date_of_birth?></td>
          <td><?php echo $location?></td>
        </tr>
      </tbody>
    </table>
    <h3 class="mb-4">Do you really want to delete this pet from your database?</h3>
    <form action="actions/a_delete.php" method="post">
      <input type="hidden" name="petID" value="<?php echo $petID ?>" />
      <input type="hidden" name="picture" value="<?php echo $picture ?>" />
      <button class="btn btn-danger" type="submit">Yes, delete it</button>
      <a href="index.php"><button class="btn btn-warning"  type="button">No, go back</button></a>
    </form>
  </div>
  
</body>
</html>