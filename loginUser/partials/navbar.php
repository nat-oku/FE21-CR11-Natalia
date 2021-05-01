<!-- navbar for not logged in users -->

<?php

  if(!isset($_SESSION['adm']) && !isset ($_SESSION['user']) ) {
    $navInactive = '
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav d-flex flex-row justify-content-between w-100">
        <div class="me-1 ms-1">
          <a class="fs-4 fw-light text-green" href="index.php">Home</a>
        </div>
        <div class="me-1 ms-1">
          <a class="btn border-gold me-1" href="register.php">Register</a>
          <a class="btn border-green ms-1" href="login.php">Login</a>
        </div>

      </div>
    </div>
    ';
  }
  
  if (isset($_SESSION['user']) != "" ) {
    $navUser = '
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav d-flex flex-row justify-content-between w-100">
      <div class="me-1 ms-1 d-flex flex-row">
        <a class="fs-4 fw-light text-green ms-2 me-2" href="home.php?home">Home</a>
        <a class="fs-4 fw-light text-green ms-2 me-2" href="profile.php?profile">Your profile</a>
        <a class="fs-4 fw-light text-green ms-2 me-2" href="pets/seniors.php?seniors">Our seniors</a>
      </div>
        <div class="me-1 ms-1">
        <a class="btn bg-orange text-light me-1" href="logout.php?logout">Logout</a>
        </div>
      </div>
    </div>
    ';
  }

  if (isset($_SESSION['adm']) != "" ) {
    $navAdm = '
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav d-flex flex-row justify-content-between w-100">
      <div class="me-1 ms-1 d-flex flex-row">
        <a class="fs-4 fw-light text-green ms-2 me-2" href="home.php?home">Home</a>
        <a class="fs-4 fw-light text-green ms-2 me-2" href="dashboard.php">Dashboard</a>
        <a class="fs-4 fw-light text-green ms-2 me-2" href="pets/seniors.php?seniors">Our seniors</a>
      </div>
        <div class="me-1 ms-1">
        <a class="btn bg-orange text-light me-1" href="logout.php?logout">Logout</a>
        </div>
      </div>
    </div>
    ';
  }



?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a href="#" class="navbar-brand d-flex flex-column">
      <i class="fas fa-paw"></i>
      <h4 class="">VPA</h4>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php echo ($navInactive) ?? '' ;?>
    <?php echo ($navUser) ?? '' ;?>
    <?php echo ($navAdm) ?? '' ;?>

  </div>
</nav>
