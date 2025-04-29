<?php require "../include/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php
if (isset($_POST['submit'])) {
    if (
        empty($_POST['review'])
    ) {
        echo "<script>alert('All fields are required'); </script>";
    } else {
        $review = $_POST['review'];
        $username = $_SESSION['username'];
        $writeReview = $conn->prepare("INSERT INTO reviews (review,username) VALUES (:review, :username)");
        $writeReview->execute([
            ":review" => $review,
            ":username" => $username,
        ]);
        header("location: " . APPURL . "/users/bookings.php");
    }
}
?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Write Review</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></span>
                        <span>Write review</span>
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form action="write-review.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading">Write Review</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="review">Review</label>
                                <input name="review" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <p><button type="submit" name="submit" class="btn btn-primary py-3 px-4">Submit Review</button></p>

                                </div>
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