<?php
  //start new session or continue the previous one
  if(isset($_SESSION['user']) != "") {
    header("Location: home.php" ); // redirects to home.php
  }
  if(isset($_SESSION[ 'adm' ]) != "") {
    header("Location: dashboard.php"); // redirects to dashboard.php
  }

  require_once 'components/db_connect.php';
  require_once 'components/file_upload.php' ;
  $error = false;
  $fname = $lname = $email = $date_of_birth = $pass = $picture = '';
  $fnameError = $lnameError = $emailError = $dateError = $passError = $picError = '';

  if (isset($_POST[ 'btn-signup'])) {

    // sanitize user input to prevent sql injection
    $fname = trim($_POST['fname']);
 
     //trim - strips whitespace (or other characters) from the beginning and end of a string
    $fname = strip_tags($fname);
 
    // strip_tags -- strips HTML and PHP tags from a string
 
    $fname = htmlspecialchars($fname);
    // htmlspecialchars converts special characters to HTML entities
    
    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);    
 
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
 
    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = strip_tags($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);
 
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
 
    $uploadError = '';
    $picture = file_upload($_FILES['picture']);
 
    // basic name validation
    if(empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3  || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }
  
    //basic email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
    // checks whether the email exists or not
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    //checks if the date input was left empty
    if(empty($date_of_birth)) {
        $error = true;
        $dateError = "Please enter your date of birth.";
    }
    // password validation
    if(empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6 ) {
        $error = true;
        $passError = "Password must have at least 6 characters." ;
    }
 
    // password hashing for security
    $password = hash('sha256', $pass);
    // if there's no error, continue to signup
     if (!$error) {
 
        $query = "INSERT INTO user(first_name, last_name, password, date_of_birth, email, picture)
                  VALUES('$fname', '$lname', '$password', '$date_of_birth', '$email', '$picture->fileName')";
        $res = mysqli_query($connect, $query);
 
        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
 
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later..." ;
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        }
    }
 }
 
 
 $connect->close();

?>