<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php
// for secure that see content when already login otherwise go to login
if (!isset($_SESSION['admin_name'])) {
  header("Location: " . ADMINURL . "/admins/login-admins.php");
}

if (isset($_POST['submit'])) {
  if (empty($_POST['adminname']) || empty($_POST['email']) || empty($_POST['password'])) {
    echo "All fields are required";
  } else {
    $adminname = $_POST['adminname'];
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
      $insert = $conn->prepare("INSERT INTO admins (adminname, email, password) VALUES (:adminname, :email, :hashed_password)");

      $insert->execute([
        ':adminname' => $adminname,
        ':email' => $email,
        ':hashed_password' => $hashed_password
      ]);

      header('Location: ' . ADMINURL . '/admins/admins.php');
      exit();
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
        <h5 class="card-title mb-5 d-inline">Create Admins</h5>
        <form method="POST" action="create-admins.php" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />

          </div>

          <div class="form-outline mb-4">
            <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="adminname" />
          </div>
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
          </div>

          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php require "../layouts/footer.php"; ?>