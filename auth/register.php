<?php require "../include/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php
if (isset($_POST["username"])) {
  header("location" . APPURL . "");
}

if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
    echo "All fields are required";
  } else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format";
      exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
      // Insert into database
      $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :hashed_password)");

      $insert->execute([
        ':username' => $username,
        ':email' => $email,
        ':hashed_password' => $hashed_password
      ]);

      header('Location: login.php');
      exit();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
?>

?>

<section class="home-slider owl-carousel">

  <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_2.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">

        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Register</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Register</span></p>
        </div>

      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <form action="register.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
          <h3 class="mb-4 billing-heading">Register</h3>
          <div class="row align-items-end">
            <div class="col-md-12">
              <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>

            </div>
            <div class="col-md-12">
              <div class="form-group mt-4">
                <div class="radio">
                  <button class="btn btn-primary py-3 px-4" name="submit">Register</button>
                </div>
              </div>
            </div>


        </form><!-- END -->
      </div> <!-- .col-md-8 -->
    </div>
  </div>
  </div>
</section> <!-- .section -->

<?php require "../include/footer.php"; ?>