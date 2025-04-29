<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php

if (!isset($_SESSION['admin_name'])) {
  header("Location: " . ADMINURL . "/admins/login-admins.php");
}

if (isset($_POST['submit'])) {
  if (empty($_POST['name']) || empty($_POST['price']) || empty($_FILES['image']) || empty($_POST['description']) || empty($_POST['type'])) {
    echo "<script>alert('All fields are required');</script>";
  } else {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    $dir = "images/" . basename($image);

    //add to database
    $insert = $conn->prepare("INSERT INTO products (name, price, image, description, type) 
    VALUES (:name, :price, :image, :description, :type)");
    $insert->execute([
      ':name' => $name,
      ':price' => $price,
      ':image' => $image,
      ':description' => $description,
      ':type' => $type
    ]);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
      header("location: show-products.php");
    } else {
      echo "<script>alert('Error uploading image');</script>";
    }
  }
}
?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Product</h5>
        <form method="POST" action="create-products.php" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

          </div>
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />

          </div>
          <div class="form-outline mb-4 mt-4">
            <input type="file" name="image" id="form2Example1" class="form-control" />

          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-outline mb-4 mt-4">
            <select name="type" class="form-select form-control" aria-label="Default select example">
              <option selected disabled>Choose Type</option>
              <option value="drink">Drink</option>
              <option value="dessert">Dessert</option>
            </select>
          </div>


          <br>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
  <?php require "../layouts/footer.php"; ?>