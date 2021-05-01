<!-- navbar for not logged in users -->

<?php
  require_once 'components/db_connect.php';

  if(!isset($_SESSION['adm']) && !isset ($_SESSION['user']) ) {
    $navInactive = '
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="btn nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="btn nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
    ';
  }

  session_start();

  if (isset($_SESSION['user']) != "" ) {
    $navUser = '
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Your profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pets/seniors.php">Our seniors</a>
        </li>

        <li class="nav-item">
          <a class="btn nav-link" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    </div>
    ';
  }

  if (isset($_SESSION['user']) != "" ) {
    $navAdm = '
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Your profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pets/seniors.php">Our seniors</a>
        </li>
        <li class="nav-item">
          <a class="btn nav-link" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    </div>
    ';
  }



?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a href="#" class="navbar-brand d-flex flex-column">
      <i class="fas fa-paw"></i>
      <h4>VPA</h4>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php echo ($navInactive) ?? '' ;?>
    <?php echo ($navUser) ?? '' ;?>
    <?php echo ($navAdm) ?? '' ;?>

  </div>
</nav>
