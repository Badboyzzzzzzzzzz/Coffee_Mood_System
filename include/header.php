<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
define("APPURL", "http://localhost:3000/");
define("IMAGEURLPRODUCTS", "http://localhost:3000/images/products/");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Coffee - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo APPURL; ?>css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/animate.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/magnific-popup.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/aos.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/jquery.timepicker.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/flaticon.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/icomoon.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="<?php echo APPURL; ?>index.php">Coffee<small>Blend</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="<?php echo APPURL; ?>index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="<?php echo APPURL; ?>menu.php" class="nav-link">Menu</a></li>
          <li class="nav-item"><a href="<?php echo APPURL; ?>services.php" class="nav-link">Services</a></li>
          <li class="nav-item"><a href="<?php echo APPURL; ?>about.php" class="nav-link">About</a></li>
          <li class="nav-item"><a href="<?php echo APPURL; ?>contact.php" class="nav-link">Contact</a></li>

          <?php if (isset($_SESSION['username'])): ?>
            <li class="nav-item cart"><a href="<?php echo APPURL; ?>/products/cart.php" class="nav-link"><span class="icon icon-shopping_cart"></span></a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['username']; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo APPURL ?>/users/bookings.php">Your Booking</a></li>
                <li><a class="dropdown-item" href="<?php echo APPURL ?>/users/orders.php">Your Orders</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo APPURL; ?>/auth/logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item"><a href="<?php echo APPURL; ?>/auth/login.php" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="<?php echo APPURL; ?>/auth/register.php" class="nav-link">Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <!-- Required JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>