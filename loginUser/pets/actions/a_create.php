<?php
  session_start();
  require_once '../../components/db_connect.php';
  require_once '../../components/file_upload.php';


  if (isset($_SESSION['user']) != "" ) {
    header("Location: ../../home.php");
    exit;
  }

  if (!isset($_SESSION['adm' ]) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php" );
      exit;
  }

  if ($_POST) {  
    $breed = $_POST['breed'];
    $pet_name = $_POST['pet_name'];
    $pet_descr = $_POST['pet_descr'];
    $pet_date_of_birth = $_POST['pet_date_of_birth'];
    $hobbies = $_POST['hobbies'];
    $pet_size = $_POST['pet_size'];
    $location = $_POST['location'];
 
    $uploadError = '';

    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture'], 'pet');  
    
    $sql = "INSERT INTO pets (breed, pet_name, pet_descr, pet_date_of_birth, hobbies, picture, pet_size, location) VALUES ('$breed', '$pet_name', '$pet_descr', '$pet_date_of_birth', '$hobbies', '$picture->fileName', '$pet_size', '$location')";
    
    if($connect->query($sql) === true){
   //checks if the supplier is undefined and insert null in the DB
      $class = "success";
      $message = "The entry below was successfully created <br>
                <table class='table w-50'><tr>
                <td> $breed </td>
                <td> $pet_name </td>
                <td> $pet_descr </td>
                <td> $pet_date_of_birth </td>
                <td> $hobbies </td>
                <td> $pet_size </td>
                <td> $location </td>
                </tr></table><hr>";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
      } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    $connect->close();
 } else {
    header("location: ../error.php");
 }

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset= "UTF-8" >
   <title>Update</title>
   <?php require_once '../../components/boot_fonts.php' ?>
</head>
<body>
   <div class="container">
       <div class= "mt-3 mb-3">
           <h1>Create request response</h1>
       </div>
       <div class="alert alert-<?=$class;?>"  role="alert">
           <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../create.php'><button class="btn btn-primary" type='button'>Add another pet</button></a>

            <a href='../index.php'><button class="btn btn-primary" type='button'> Home</button></a>

       </div>
   </div>
</body>
</html>