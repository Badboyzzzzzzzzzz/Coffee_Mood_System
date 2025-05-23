<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php
if (isset($_SESSION['admin_name'])) {
  header("Location: " . ADMINURL . "/admin.php");
}

if (isset($_POST['submit'])) {
  if (empty($_POST['email']) || empty($_POST['password'])) {
    echo "All fields are required";
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format";
      exit();
    }

    try {
      // Fetch user by email
      $login = $conn->prepare("SELECT * FROM admins WHERE email = :email");
      $login->execute([':email' => $email]);

      $fetch = $login->fetch(PDO::FETCH_ASSOC);

      if ($fetch && password_verify($password, $fetch['password'])) {
        // Start session and redirect

        $_SESSION['admin_name'] = $fetch['adminname'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['admin_id'] = $fetch['id'];


        header("Location: " . ADMINURL . "/admin.php");
        exit();
      } else {
        echo 'Invalid email or password';
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
?>


<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mt-5">Login</h5>
        <form method="POST" action="login-admins.php" class="p-auto">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

          </div>


          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

          </div>
          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


        </form>

      </div>
    </div>
  </div>
  <?php require "../layouts/footer.php"; ?>