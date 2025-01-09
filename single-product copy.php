<?php 
session_start();
error_reporting(0);
include('includes/config.php');

// Fetching the product details using the product ID
if(isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $query = mysqli_query($con, "SELECT * FROM products WHERE id = '$pid'");
    $product = mysqli_fetch_array($query);
}

// Handling Add to Cart
if(isset($_POST['submit'])) {
    $pid = $_POST['pid'];
    $userid = $_SESSION['jsmsuid'];
    $query = mysqli_query($con, "INSERT INTO orders(UserId, PId) VALUES('$userid', '$pid')");
    if($query) {
        echo "<script>alert('Jewellery has been added to the cart');</script>";
        echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}

// Handling Add to Wishlist
if(isset($_POST['wsubmit'])) {
    $wpid = $_POST['wpid'];
    $userid = $_SESSION['jsmsuid'];
    $query = mysqli_query($con, "INSERT INTO wishlist(UserId, ProductId) VALUES('$userid', '$wpid')");
    if($query) {
        echo "<script>alert('Jewellery has been added to the wishlist');</script>";
        echo "<script type='text/javascript'> document.location ='wishlist.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['productName']; ?> - VJ Jewellery</title>
	<link rel="shortcut icon" type="image/x-icon" href="media/favicon.png">
		
		<!-- Dependency Styles -->
		<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="libs/feather-font/css/iconfont.css" type="text/css">
		<link rel="stylesheet" href="libs/icomoon-font/css/icomoon.css" type="text/css">
		<link rel="stylesheet" href="libs/font-awesome/css/font-awesome.css" type="text/css">
		<link rel="stylesheet" href="libs/wpbingofont/css/wpbingofont.css" type="text/css">
		<link rel="stylesheet" href="libs/elegant-icons/css/elegant.css" type="text/css">
		<link rel="stylesheet" href="libs/slick/css/slick.css" type="text/css">
		<link rel="stylesheet" href="libs/slick/css/slick-theme.css" type="text/css">
		<link rel="stylesheet" href="libs/mmenu/css/mmenu.min.css" type="text/css">
		<link rel="stylesheet" href="libs/slider/css/jslider.css">

		<!-- Site Stylesheet -->
		<link rel="stylesheet" href="assets/css/app.css" type="text/css">
		<link rel="stylesheet" href="assets/css/responsive.css" type="text/css">
		
		<!-- Google Web Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap" rel="stylesheet">
</head>

<body class="shop">
<?php include_once('includes/header.php');?>

    <div id="page" class="hfeed page-wrapper">

        <div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    <div id="title" class="page-title">
                        <div class="section-container">
                            <div class="content-title-heading">
                                <h1 class="text-title-heading">
                                    <?php echo $product['productName']; ?>
                                </h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span><a href="products.php">Products</a><span class="delimiter"></span><span><?php echo $product['productName']; ?></span>
                            </div>
                        </div>
                    </div>

                    <div id="content" class="site-content" role="main">
                        <div class="section-padding">
                            <div class="section-container p-l-r">
                                <div class="product-top-info">
                                    <div class="section-padding">
                                        <div class="section-container p-l-r">
                                            <div class="row">
                                                <div class="product-images col-lg-7 col-md-12 col-12">
                                                    <!-- Product Image -->
                                                    <?php if (!empty($product['productImage1'])): ?>
                                                        <img width="400px" src="admin/productimages/<?php echo $product['productImage1']; ?>" alt="<?php echo $product['productName']; ?>" class="img-fluid">
                                                        
                                                    <?php endif; ?>
                                                </div>
                                                <div class="product-info col-lg-5 col-md-12 col-12">
                                                    <h1 class="title"><?php echo $product['productName']; ?></h1><br>
                                                    <span class="price">
                                                        <ins><span style="font-size: 25px;">₹<?php echo $product['productPrice']; ?></span></ins>
                                                    </span>
                                                    
                                                    <!-- Product Weight and Availability -->
                                                    
                                                    
                                                    <!-- Rating and Description -->
                                                    <br><hr>
                                                    <div class="product-meta" style="font-size: 18px; color: black;">
                                                        <strong>Product ID:</strong> <?php echo $product['id']; ?>
                                                    </div>
													<div class="product-meta" style="font-size: 18px; color: black;">
                                                        <strong>Weight:</strong> <?php echo $product['productweight']; ?> grams
                                                    </div>
                                                    <div class="product-meta" style="font-size: 18px; color: black;">
                                                        <strong>Availability:</strong> <?php echo $product['productAvailability']; ?>
                                                    </div><hr>
                                                    <div class="description" style="font-size: 16px; text-align: justify; ">
                                                        <p><?php echo $product['productDescription']; ?></p>
                                                    </div><hr>

                                                    <!-- Add to Cart and Wishlist buttons -->
                                                    <div class="tab-content" id="spec">
                                                                <?php if (strlen($_SESSION['jsmsuid']==0)) {

                                                                    echo "<font color='red'>Login is Required for Review</font>";
                                                                } else {?>
                                                                <p>Write Your Review</p>
                                                                <form action="#" method="post" class="form-box">
                                                                <div class="form-box__single-group">
                                                                    <label for="form-message">Title for your review*</label>
                                                                    <input type="text" id="reviewtitle" name="reviewtitle" required="true" class="form-control">
                                                                </div>
                                                                <div class="form-box__single-group">
                                                                    <label for="form-review">Your review*</label>
                                                                    <textarea id="reviewdescription" rows="5" name="reviewdescription" required="true" class="form-control"></textarea>
                                                                </div>
                                                
                                                                <div class="from-box__buttons d-flex justify-content-between d-flex-warp m-t-25 align-items-center">
                                                                    <div class="from-box__left">
                                                                        <span>* Required fields</span>
                                                                    </div>
                                                                    <div class="form-box-right">
                                                                        <button class="btn btn-primary" type="submit" name="review">Send</button>
                                                                        or
                                                                        <button class="btn btn-primary" type="reset" data-dismiss="modal" aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        <?php } ?>
                                                            </div>
                                                            <div class="tab-content" id="ret">
                                                                <?php
                                                                    $pid=$_GET['pid'];
                                                                                        
                                                                    $query1=mysqli_query($con,"select * from tblreview 

                                                                        join users on users.id=tblreview.UserId where ProductID='$pid' && Status='Review Accept'");
                                                                    $cnt=1;
                                                                    while ($result=mysqli_fetch_array($query1)) {

                                                                    ?>
                                                                <p><?php echo $result['Review'];?><br />
                                                                <span style="font-size:10px;"> Reviewed By
                                                                    <?php echo $result['Name'];?> on <?php echo $result['DateofReview'];?></span></p>
                            <hr />
                                                            <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons" style="display: flex; gap: 20px;">
                                                        <form method="post">
                                                            <input type="hidden" name="pid" value="<?php echo $product['id']; ?>">
                                                            <div class="add-to-cart-wrap">
                                                                <div class="btn-add-to-cart">
                                                                    <button type="submit" name="submit" class="btn">ADD TO CART</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form method="post" class="mt-2">
                                                            <input type="hidden" name="wpid" value="<?php echo $product['id']; ?>">
                                                            <button type="submit" name="wsubmit" class="btn">ADD TO WISHLIST</button>
                                                        </form>
                                                    </div>
													<style>
														button{
															background-color: black;
															color: white;
															width: 200px;
															height: 50px;
														}
														button:hover{
															background-color: goldenrod;
														}
													</style><br>

                                                    <div style="font-size: 25px; display: flex; gap: 20px; text-align: center;">
														<a style="background-color: lightgray; width: 45px;" href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
														<a style="background-color: lightgray; width: 45px;" href="#" title="Twitter" target="_blank" ><i class="fa fa-instagram"></i></a>
														<a style="background-color: lightgray; width: 45px;" href="#" title="Pinterest" target="_blank" ><i class="fa fa-whatsapp"></i></a>
													</div>
													                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>
    </div>
	<script src="libs/popper/js/popper.min.js"></script>
		<script src="libs/jquery/js/jquery.min.js"></script>
		<script src="libs/bootstrap/js/bootstrap.min.js"></script>
		<script src="libs/slick/js/slick.min.js"></script>
		<script src="libs/mmenu/js/jquery.mmenu.all.min.js"></script>
		<script src="libs/slider/js/tmpl.js"></script>
		<script src="libs/slider/js/jquery.dependClass-0.1.js"></script>
		<script src="libs/slider/js/draggable-0.1.js"></script>
		<script src="libs/slider/js/jquery.slider.js"></script>
		<script src="libs/elevatezoom/js/jquery.elevatezoom.js"></script>
		
		<!-- Site Scripts -->
		<script src="assets/js/app.js"></script>
</body>
</html>
