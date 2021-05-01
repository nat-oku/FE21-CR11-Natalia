<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm' ])) {
   header("Location: dashboard.php");
   exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: index.php" );
    exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM user WHERE userID=". $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
<title>Welcome - <?php  echo $row['first_name']; ?></title >
<?php require_once 'components/boot_fonts.php' ?>
<style>
.userImage{
width: 200px;
height: 200px;
}
.hero {
   background: rgb(2,0,36);
    background: linear-gradient(24deg, rgba(0, 102, 101) 0%, rgba(0, 102, 101,0.5) 100%);  
}
<?php include 'css/style.css'; #adding css to file ?>

</style>
</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>
  </header>

  <div class ="container mt-4 mb-4">
     <div class="mb-3">
        <h2>Hi <?php  echo $row['first_name']; ?> <i class="far fa-heart text-orange"></i></h2>
      <div>
      <div class="hero">
       <img class= "userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
      </div>
      <a href="update.php?userID=<?php echo $_SESSION['user'] ?>" class="btn bg-green text-light mt-2 me-1">Update your profile</a>
      <a href="home.php" class="btn bg-gold text-light mt-2 ms-1">Check out our pets</a>

   </div>
</body >
</html>

