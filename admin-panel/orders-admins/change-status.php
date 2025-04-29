<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php
// for secure that see content when already login otherwise go to login
if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "/admins/login-admins.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['submit'])) {
        if (empty($_POST['status'])) {
            echo "<script> alert('All fields are required'); </script>";
        } else {
            $status = $_POST['status'];
            $update = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
            $update->execute([
                ':status' => $status,
                ':id' => $id
            ]);
        }
        header("location: show-orders.php");
    }
}

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Status</h5>
                <form method="POST" action="change-status.php?id=<?php echo $id; ?>">
                    <div class="form-outline mb-4 mt-4">
                        <select name="status" class="form-select  form-control" aria-label="Default select example">
                            <option selected>Choose Status</option>
                            <option value="pending">Pending</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                </form>

            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>