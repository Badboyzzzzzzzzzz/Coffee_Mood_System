<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php

if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "/admins/login-admins.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //delete image  
    $image = $conn->query("SELECT * FROM products WHERE id = '$id'");
    $image->execute();
    $image = $image->fetch(PDO::FETCH_OBJ);
    unlink("images/" . $image->image ."");
    
    //delete product
    $delete = $conn->query("DELETE FROM products WHERE id = '$id'");
    $delete->execute();
    header("location: show-products.php");
}
?>
<?php require "../layouts/footer.php"; ?>