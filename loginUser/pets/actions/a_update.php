<?php
  session_start();
  require_once '../../components/db_connect.php';
  require_once '../../components/file_upload.php';

  if ($_POST) {    
    $breed = $_POST['breed'];
    $pet_name = $_POST['pet_name'];
    $pet_descr = $_POST['pet_descr'];
    $pet_date_of_birth = $_POST['pet_date_of_birth'];
    $hobbies = $_POST['hobbies'];
    $pet_size = $_POST['pet_size'];
    $location = $_POST['location'];

    $petID = $_POST['petID'];

    //variable for upload pictures errors is initialized
    $uploadError = '';
 
    $picture = file_upload($_FILES['picture'], 'pet');//file_upload() called  
    if ($picture->error===0){
        ($_POST["picture"]=="pet.png")?: unlink("../pictures/pets/$_POST[picture]");

        $sql = "UPDATE pets SET breed = '$breed', pet_name = '$pet_name', pet_descr = '$pet_descr', pet_date_of_birth = '$pet_date_of_birth', 
        hobbies ='$hobbies', pet_size = '$pet_size', location = '$location', picture = '$picture->fileName' where petID = {$petID}";
    } else{
        $sql = "UPDATE pets SET breed = '$breed', pet_name = '$pet_name', pet_descr = '$pet_descr', pet_date_of_birth = '$pet_date_of_birth', 
        hobbies ='$hobbies', pet_size = '$pet_size', location = '$location' where petID = {$petID}";
    }    
    if ($connect->query($sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    $connect->close();    
    } else {
    header("location: ../error.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS & fonts -->
  <?php require_once '../../components/boot_fonts.php' ?>
  <link rel="stylesheet" href="../../css/style.css">
  <title>VPA || Update response</title>
</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once '../../partials/navbar.php' ?>
  </header>
  <div class="container">
    <h2>Update request response</h2>
    <div class="alert alert-<?php echo $class;?>" role="alert">
      <p><?php echo ($message) ?? ''; ?></p>
      <p><?php echo ($uploadError) ?? ''; ?></p>
      <a href='../update.php?petID=<?=$petID;?>' ><button class="btn btn-warning" type='button'>Back</button></a>
      <a href='../index.php'><button class="btn btn-success"  type='button'>Home</button></a>
    </div>
  </div>

</body>
</html>