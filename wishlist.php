<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['jsmsuid'] == 0)) {
    header('location:login.php');
} else {

    if (isset($_POST['submit'])) {
        $pid = $_POST['pid'];
        $userid = $_SESSION['jsmsuid'];
        $query = mysqli_query($con, "insert into orders(UserId,PId) values('$userid','$pid')");
        if ($query) {
            $query = mysqli_query($con, "delete from wishlist where UserId='$userid' && ProductId='$pid'");
            echo "<script>alert('Jewellery has been added to the cart');</script>";
            echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    }

    // Code for deleting product from wishlist
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $query = mysqli_query($con, "delete from wishlist where id='$rid'");
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href = 'wishlist.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from caketheme.com/html/mojuri/shop-wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Dec 2024 17:32:54 GMT -->
<head>
		<!-- Meta Data -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Wishlist - VJ Jewellery</title>
		
		<!-- Favicon -->
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- Google Web Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap" rel="stylesheet">
	</head>
	
	<body class="shop">
<div id="page" class="hfeed page-wrapper">
    <?php include_once('includes/header.php'); ?>

    <div id="site-main" class="site-main">
        <div id="main-content" class="main-content">
            <div id="primary" class="content-area">
                <div id="title" class="page-title">
                    <div class="section-container">
                        <div class="content-title-heading">
                            <h1 class="text-title-heading">
                                Wishlist
                            </h1>
                        </div>
                        <div class="breadcrumbs">
                            <a href="index.html">Home</a><span class="delimiter"></span><a href="shop-grid-left.html">Shop</a><span class="delimiter"></span>Wishlist
                        </div>
                    </div>
                </div>

                <div id="content" class="site-content" role="main">
                    <div class="section-padding">
                        <div class="section-container p-l-r">
                            <div class="shop-wishlist">
                                <table class="wishlist-items">
                                    <tbody>
                                    <?php
                                    $userid = $_SESSION['jsmsuid'];
                                    $query = mysqli_query($con, "SELECT products.id as pid, products.productName, products.shippingCharge, products.productDescription, products.productPrice, products.productImage1, wishlist.id, wishlist.UserId, wishlist.ProductId, wishlist.postingDate FROM wishlist JOIN products ON products.id = wishlist.ProductId WHERE wishlist.UserId = '$userid'");
                                    $num = mysqli_num_rows($query);
                                    if ($num > 0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                            $price = $row['productPrice'];
                                            ?>
                                            <tr class="wishlist-item">
                                                <td class="wishlist-item-remove">
                                                    <a href="wishlist.php?delid=<?php echo $row['id']; ?>" class="ico-del" onclick="return confirm('Do you really want to delete?');">Delete</a>
                                                </td>
                                                <td class="wishlist-item-image">
                                                    <a href="shop-details.html">
                                                        <img src="admin/productimages/<?php echo $row['productImage1']; ?>" alt="">
                                                    </a>
                                                </td>
                                                <td class="wishlist-item-info">
                                                    <div class="wishlist-item-name">
                                                        <a href="shop-details.html"><?php echo $row['productName']; ?></a>
                                                    </div>
                                                    <div class="wishlist-item-price">
                                                        <span>₹<?php echo $price; ?></span>
                                                    </div>
                                                    <div class="wishlist-item-time"> <?php echo $row['productDescription']; ?>.</div>
                                                </td>
                                                <td>
                                                    <?php if ($_SESSION['jsmsuid'] == "") { ?>
                                                        <a href="login.php" class="btn-grey">Add to cart</a>
                                                    <?php } else { ?>
                                                        <form method="post">
                                                            <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                                                            <button type="submit" name="submit" class="btn-grey">Add to Cart</button>
                                                        </form>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7" style="text-align:center;color:red;font-size:20px;">Wishlist is empty</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- #content -->
            </div><!-- #primary -->
        </div><!-- #main-content -->
    </div>

    <?php include_once('includes/footer.php'); ?>
</div>
€
		<!-- Back Top button -->
		<div class="back-top button-show">
			<i class="arrow_carrot-up"></i>
		</div>

		

		<!-- Page Loader -->
		<div class="page-preloader">
	    	<div class="loader">
	    		<div></div>
	    		<div></div>
	    	</div>
	    </div>

		<!-- Dependency Scripts -->
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

<!-- Mirrored from caketheme.com/html/mojuri/shop-wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Dec 2024 17:32:54 GMT -->
</html>><?php } ?>
