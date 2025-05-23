<?php

use Dom\Text;

require "../include/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    // data for single product
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_OBJ);


    // data for related product
    $relatedProduct = $conn->query("SELECT * FROM products WHERE type = '$product->type' AND id !=' $product->id'");
    $relatedProduct->execute();
    $allRelatedProduces = $relatedProduct->fetchAll(PDO::FETCH_OBJ);


    // add to cart
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $pro_id = $_POST['pro_id'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['user_id'];

        $insert_cart = $conn->prepare("INSERT INTO cart(name, image, price, pro_id, description, quantity, user_id) 
		VALUES(:name, :image, :price,:pro_id , :description,:quantity, :user_id)");

        $insert_cart->execute(params: [
            ":name" => $name,
            ":image" => $image,
            ":price" => $price,
            ":pro_id" => $pro_id,
            ":description" => $description,
            ":quantity" => $quantity,
            ":user_id" => $user_id,
        ]);
        echo "<script>alert('added to cart succesfully');</script>";
    }

    /// validation for the card
    if (isset($_SESSION['user_id'])) {
        $validationCart = $conn->query("SELECT * FROM cart WHERE pro_id = '$id' 
    AND user_id ='$_SESSION[user_id]'");
        $validationCart->execute();

        $rowCount = $validationCart->rowCount();
    }
}
?>

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Product Detail</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></span> <span>Product Detail</span></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="images/menu-2.jpg" class="image-popup"><img src="<?php echo APPURL ?>/images/<?php echo $product->image ?>" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $product->name ?></h3>
                <p class="price"><span><?php echo $product->price ?></span></p>
                <p><?php echo $product->description ?></p>
                <form method="POST" action="product-single.php?id=<?php echo $product->id ?>">
                    <div class="row mt-4">
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="icon-minus"></i>
                                </button>
                            </span>

                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="icon-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <input name="name" value="<?php echo $product->name ?>" type="hidden">
                            <input name="image" value="<?php echo $product->image ?>" type="hidden">
                            <input name="price" value="<?php echo $product->price ?>" type="hidden">
                            <input name="pro_id" value="<?php echo $product->id ?>" type="hidden">
                            <input name="description" value="<?php echo $product->description ?>" type="hidden">
                            <?php if (isset($_SESSION["user_id"])): ?>
                                <?php if ($rowCount > 0): ?>
                                    <button name="submit" type="submit" class="btn btn-primary py-3 px-5" disabled>Add to Cart</button>
                                <?php else: ?>
                                    <button name="submit" type="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
                                <?php endif; ?>
                            <?php else: ?>
                                <P>Login to add the product to cart</p>
                            <?php endif; ?>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Related products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($allRelatedProduces as $relatedProduct): ?>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="<?php echo APPURL ?>/produces/product-single.php?id=<?php echo $relatedProduct->id ?>" class="img" style="background-image: url(<?php echo APPURL; ?>images/<?php echo $relatedProduct->image ?>);"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="<?php echo APPURL ?>/produces/product-single.php?id=<?php echo $relatedProduct->id ?>"><?php echo $relatedProduct->name ?></a></h3>
                            <p><?php echo $relatedProduct->description ?></p>
                            <p class="price"><span><?php echo $relatedProduct->price ?></span></p>
                            <p><a href="<?php echo APPURL ?>/produces/product-single.php?id=<?php echo $relatedProduct->id ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require "../include/footer.php"; ?>