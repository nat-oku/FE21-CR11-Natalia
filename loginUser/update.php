<?php
  session_start();
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['adm']) && !isset ($_SESSION[ 'user']) ) {
  header("Location: index.php");
  exit;
 }

  $backBtn = '';
  //if it is a user it will create a back button to home.php
  if (isset($_SESSION["user"])){
   $backBtn = "home.php";    
  }
  
  //if it is an adm it will create a back button to dashboard.php
  if(isset($_SESSION["adm"])){
   $backBtn = "dashboard.php";    
  }

  require_once 'components/db_connect.php';
  require_once 'components/file_upload.php';

  //fetch and populate form
  if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM user WHERE userID = {$userID}";
    $result = $connect->query($sql);
    if ($result->num_rows == 1) {
      $data = $result->fetch_assoc();
      $f_name = $data['first_name'];
      $l_name = $data['last_name'];
      $email = $data['email'];
      $date_birth = $data['date_of_birth'];
      $picture = $data['picture'];
    }
  }

  //update
  $class = 'd-none';
  if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name' ];
    $email = $_POST[ 'email'];
    $date_of_birth = $_POST['date_of_birth'];
    $userID = $_POST['userID'];
    
    //variable for upload pictures errors is initialized
    $uploadError = '';    
    $pictureArray = file_upload($_FILES['picture']); //file_upload() called
    $picture = $pictureArray->fileName;

    if ($pictureArray->error === 0) {      
        ($_POST["picture"] == "avatar.png") ?: unlink("pictures/{$_POST["picture"]}");
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', date_of_birth = '$date_of_birth', picture='$pictureArray->fileName' WHERE userID = {$userID}";
    } else {
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', date_of_birth = '$date_of_birth' WHERE userID = {$userID}";
    }
      if ($connect->query($sql) === true) {    
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?userID={$userID}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?userID={$userID}");
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
  <?php require_once 'components/boot_fonts.php' ?>

  <style type= "text/css">
      fieldset {
           margin: auto;
           margin-top: 100px ;
           width: 60% ;
       }
       .img-thumbnail{
           width: 70px !important;
           height: 70px !important;
       }
    
       <?php include 'css/style.css'; #adding css to file ?>

  </style>

  <title>VPA || Update profile</title>
</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>
  </header>

  <div class="container mt-4 mb-4">
    <h2>Update</h2>
    <div class="<?php echo $class; ?>" role="alert">
       <p><?php echo ($message) ?? ''; ?></p>
        <p><?php echo ($uploadError) ?? ''; ?></p>       
    </div>
    <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
    
    <form method="post" enctype="multipart/form-data">
       <table class="table">
         <tr>
           <th>First Name</th>
           <td>
            <input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $f_name ?>"/>
           </td>
         </tr>
         <tr>
           <th>Last Name</th>
           <td>
            <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $l_name ?>"/>
           </td>
         </tr>
         <tr>
           <th>Email</th>
           <td>
            <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>"/>
           </td>
         </tr>
         <tr>
           <th>Date of birth</th>
           <td>
            <input class="form-control" type="date" name="date_of_birth" placeholder="Date of birth" value="<?php echo $date_of_birth ?>"/>
           </td>
         </tr>
         <tr>
           <th>Picture</th>
           <td>
            <input class="form-control" type="file" name="picture" value="<?php echo $picture ?>"/>
           </td>
         </tr>
         <tr>
           <input type="hidden" name="userID" value="<?php echo $data['userID'] ?>" />
           <input type="hidden" name="picture" value="<?php echo $picture ?>"/>
           <td>
             <button name="submit" class="btn bg-green text-light" type="submit">Save Changes</button>
            </td>
            <td>
              <a href="<?php echo $backBtn?>"><button class="btn bg-orange text-light" type="button">Back</button></a></td>
         </tr>
       </table>
    </form>
  </div>
</body>
</html>