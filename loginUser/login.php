<?php
  //start new session or continue the previous one
  session_start();

  if(isset($_SESSION['user']) != "") {
    header("Location: home.php" ); // redirects to home.php
  }
  if(isset($_SESSION[ 'adm' ]) != "") {
    header("Location: dashboard.php"); // redirects to dashboard.php
  }

  require_once 'components/db_connect.php';
  
  $error = false ;
  $email = $password = $emailError = $passError = '';
  if (isset ($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
 
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs
 
    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }
 
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }
 
    // if there's no error, continue to login
    if (!$error) {
 
        $password = hash('sha256', $pass); // password hashing
 
        $sqlSelect = "SELECT userID, first_name, password, status FROM user WHERE email = ? ";
        $stmt = $connect->prepare($sqlSelect);
        $stmt->bind_param("s", $email);
        $work = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $result->num_rows;
        if ($count == 1 && $row['password'] == $password) {
            if($row['status'] == 'adm'){
            $_SESSION['adm'] = $row['userID'];          
            header( "Location: dashboard.php");}
            else{
                $_SESSION['user'] = $row['userID'];
               header( "Location: home.php");
            }          
        } else {
            $errMSG = "Incorrect Credentials, Try again..." ;
        }
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
   <style>
    <?php include 'css/style.css'; #adding css to file ?>
   </style>   
   <title>VPA || Login</title> </head>
 <body>
  <header>
    <!-- navbar -->
    <?php require_once 'partials/navbar.php' ?>
  </header>
  <div class="container">
    <h2>Log in.</h2>
    <form class="w-75"  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <?php
        if (isset($errMSG)) {
          echo $errMSG;
        }
      ?>
      <input type="email" autocomplete="off" name= "email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength ="40" />
      <span class="text-danger"><?php echo $emailError; ?></span>
      <input type="password" name="pass" class="form-control"  placeholder="Your Password" maxlength="15"/>
      <span class="text-danger"><?php echo $passError; ?></span>
      <button class="btn btn-block btn-primary" type="submit" name ="btn-login">Click to log In</button>
      <a class="btn" href="register.php">Click to register</a>

    </form>
  </div>
   
 </body>
 </html>