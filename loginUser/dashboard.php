<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION[ 'adm' ]) && !isset($_SESSION['user'])) {
   header("Location: index.php" );
    exit;
}
//if session user exist it shouldn't access dashboard.php
if ( isset($_SESSION["user"])) {
   header("Location: home.php");
   exit;
}

$userID = $_SESSION['adm' ];
$status = 'adm';
$sqlSelect = "SELECT * FROM user WHERE status != ? ";
$stmt = $connect->prepare($sqlSelect);
$stmt->bind_param("s", $status);
$work = $stmt->execute();
$result = $stmt->get_result();
//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
   while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
       $tbody .= "<tr>
           <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
           <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
           <td>" . $row['date_of_birth'] . "</td>
           <td>" . $row['email'] . "</td>
           <td class=''>
            <a href='update.php?userID=" . $row['userID'] . "'><button class='btn btn-primary btn-sm w-100 mb-1' type='button'>Edit</button></a>
            <a href='delete.php?userID=" . $row['userID'] . "'><button class='btn btn-danger btn-sm w-100 mt-1' type='button'>Delete</button></a>
           </td>
        </tr>";
   }
} else {
   $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
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
  <style type="text/css" >       
       .img-thumbnail{
           width: 70px !important;
            height: 70px !important;
       }
       td
       {
           text-align: left;
           vertical-align: middle;
       }
       tr
       {
           text-align: center;
       }
       .userImage{
          width: 100px ;
          height: auto;
      }
   </style>

  <title>Vienna Pet Adoption || Dashboard</title>

</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-2">
        <img class="userImage" src="pictures/avatar.png" alt="Adm avatar">
        <p class="">Administrator</p>
        <a  href="logout.php?logout">Sign Out </a>
        <a href="pets/index.php">See all pets</a>
      </div>
      <div class="col-8 mt-2">
        <h2>Users</h2>
        <table class="table table-stripped">
          <thead class="table-success">
            <tr>
              <th>Picture</th>
              <th>Name</th>
              <th>Date of birth</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?= $tbody ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</body>
</html>