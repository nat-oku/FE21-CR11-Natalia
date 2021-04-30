<?php 
  session_start();
  require_once 'components/db_connect.php';
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['adm']) && !isset($_SESSION['user' ]) ) {
    header("Location: index.php");
    exit;
  }
  if(isset($_SESSION["user" ])){
    header("Location: home.php");
    exit;
  }

  //initial bootstrap class for the confirmation message
    $class = 'd-none';

  //the GET method will show the info from the user to be deleted
    if  ($_GET['userID']) {
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM user WHERE userID = {$userID}" ;
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    if ($result->num_rows == 1) {
    $f_name = $data['first_name' ];
    $l_name = $data[ 'last_name'];
    $email = $data['email'];
    $date_of_birth = $data['date_of_birth'];
    $picture = $data['picture'];
    }
  }
  
  //the POST method will actually delete the user permanently
  if ($_POST) {
    $userID = $_POST['userID'];
    $picture = $_POST['picture'];
    ($picture =="avatar.png")?: unlink("pictures/$picture");

    $sql = "DELETE FROM user WHERE userID = {$userID}";
    if ($connect->query($sql) === TRUE) {
    $class = "alert alert-success" ;
    $message = "Successfully Deleted!";
    header("refresh:3;url=dashboard.php");
  } else {
    $class = "alert alert-danger";
    $message = "The entry was not deleted due to: <br>".$connect->error;
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
  <link rel="stylesheet" href="css/style.css">
  <style type= "text/css" >
      fieldset {
           margin: auto;
           margin-top: 100px;
           width: 70% ;
       }    
       .img-thumbnail{
           width: 70px  !important;
           height: 70px !important;
       }    
  </style>

  <title>VPA || Delete user</title>
</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>
  </header>
  <div class="<?php echo $class; ?>" role="alert" >
       <p><?php echo ($message) ?? ''; ?></p>           
  </div>
  <div class="container">
    <h2>Delete user</h2>
    <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $picture ?>' alt="<?php echo $f_name ?>">
    
    <h5>You have selected the data below: </h5>
    
    <table class="table w-75 mt-3">
      <tr>
        <td><?php echo "$f_name $l_name"?></td>
        <td><?php echo $email?></td>
        <td ><?php echo $date_of_birth?></td>
      </tr>
    </table>
    <h3 class="mb-4">Do you really want to delete this user?</h3>
    <form method="post">
      <input type="hidden" name ="userID" value= "<?php echo $userID ?>" />
      <input type="hidden" name="picture" value="<?php echo $picture ?>" />
      <button class="btn btn-danger" type="submit">Yes, delete it!</button  >
      <a href="dashboard.php" ><button class="btn btn-warning" type= "button">No, go back!</button></a>
    </form>

  </div>

</body>
</html>