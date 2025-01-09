<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['review']))
  {
  	$userid= $_SESSION['jsmsuid'];
       $review=$_POST['reviewdescription'];
    $reviewtitle=$_POST['reviewtitle'];
     $pid=$_GET['pid'];
    $query=mysqli_query($con, "insert into tblreview(ProductID,ReviewTitle,Review,UserId) value('$pid','$reviewtitle','$review','$userid')");
    if ($query) {
   echo "<script>alert('Your review was sent successfully!.');</script>";
echo "<script>window.location.href ='index.php'</script>";
  }
  else
    {
       echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
if(isset($_POST['submit']))
{
$pid=$_POST['pid'];
$userid= $_SESSION['jsmsuid'];
$query=mysqli_query($con,"insert into orders(UserId,PId) values('$userid','$pid') ");
if($query)
{
 echo "<script>alert('Jewellery has been added in to the cart');</script>";
 echo "<script type='text/javascript'> document.location ='cart.php'; </script>";   
} else {
 echo "<script>alert('Something went wrong.');</script>";      
}
}

if(isset($_POST['wsubmit']))
{
$wpid=$_POST['wpid'];
$userid= $_SESSION['jsmsuid'];
$query=mysqli_query($con,"insert into wishlist(UserId,ProductId) values('$userid','$wpid') ");
if($query)
{
 echo "<script>alert('Jewellery has been added to the wishlist');</script>";
 echo "<script type='text/javascript'> document.location ='wishlist.php'; </script>";   
} else {
 echo "<script>alert('Something went wrong.');</script>";      
}
}
  ?>
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
	<meta charset="utf-8">
	<title>Jewellery Shop Management System|| Single Products</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<link rel="stylesheet" media="all" href="css/style.css">
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
		<link rel="stylesheet" href="libs/select2/css/select2.min.css">

		<!-- Site Stylesheet -->
		<link rel="stylesheet" href="assets/css/app.css" type="text/css">
		<link rel="stylesheet" href="assets/css/responsive.css" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- Google Web Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap" rel="stylesheet">
		<style>
        /* Custom CSS for improved UI */
        .product-container {
            padding: 40px 0;
            background-color: #f8f9fa;
        }
        
        .product-image {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            max-width: 100%;
            height: auto;
        }
        
        .product-details {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .product-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }
        
        .product-price {
            font-size: 2rem;
            color: #d4af37;
            font-weight: 600;
            margin: 15px 0;
        }
        
        .product-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            margin: 20px 0;
        }
        
        .product-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .tabs-container {
            margin-top: 30px;
        }
        
        .nav-tabs {
            border-bottom: 2px solid #d4af37;
        }
        
        .nav-tabs .nav-link {
            color: #666;
            font-weight: 500;
            border: none;
            padding: 10px 20px;
        }
        
        .nav-tabs .nav-link.active {
            color: #d4af37;
            background: none;
            border-bottom: 2px solid #d4af37;
        }
        
        .tab-content {
            padding: 20px;
            background: white;
            border-radius: 0 0 8px 8px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn-custom {
            padding: 12px 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .btn-cart {
            background-color: #d4af37;
            color: white;
            border: none;
        }
        
        .btn-wishlist {
            background-color: #333;
            color: white;
            border: none;
        }
        
        .btn-cart:hover, .btn-wishlist:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .review-form {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .review-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        
        .review-author {
            font-weight: 600;
            color: #333;
        }
        
        .review-date {
            color: #999;
            font-size: 0.9rem;
        }
		.product-image-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        
        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 490px;
            height: auto;
            transition: opacity 0.5s ease;
			border: 1px solid lightgray;
        }
        
        .product-image.primary {
            opacity: 1;
            position: relative;
        }
        
        .product-image.secondary {
            opacity: 0;
        }
        
        .product-image-container:hover .product-image.primary {
            opacity: 0;
        }
        
        .product-image-container:hover .product-image.secondary {
            opacity: 1;
        }
        
        /* Add space below image container */
        .product-image-wrapper {
            margin-bottom: 30px;
        }
    </style>
	</head>
	<body>
    <?php include_once('includes/header.php');?>
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
    <div class="product-container">
        <div class="container">
            <div class="row">
                <?php
                $pid=$_GET['pid'];
                $ret=mysqli_query($con,"select * from products where id='$pid'");
                while ($row=mysqli_fetch_array($ret)) {
                ?>
                <div class="col-md-6">
                    <div class="product-image-wrapper">
                        <div class="product-image-container">
                            <img src="admin/productimages/<?php echo $row['productImage1'];?>" 
                                 alt="<?php echo $row['productName'];?>" 
                                 class="product-image primary img-fluid">
                            <img src="admin/productimages/<?php echo $row['productImage2'];?>" 
                                 alt="<?php echo $row['productName'];?> - Alternative View" 
                                 class="product-image secondary img-fluid">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="product-details" style="padding: 30px; border: 1px solid lightgray;">
                        <h1 class="product-title"><?php echo $row['productName'];?></h1>
                        <p class="product-price">₹<?php echo number_format($row['productPrice'], 2);?></p>
                        <div class="product-description"><?php echo $row['productDescription'];?></div>
                        
                        <div class="product-info">
                            <p><strong>Product ID:</strong> <?php echo $row['id'];?></p>
                            <p><strong>Weight:</strong> <?php echo $row['productweight'];?> grams</p>
                            <p><strong>Availability:</strong> <?php echo $row['productAvailability'];?></p>
                        </div>
                        
                        <div class="buttons" style="display: flex; gap: 20px; padding-left: 10px;">
                            <form method="post">
                                <input type="hidden" name="pid" value="<?php echo $row['id'];?>">
                                    <input type="number" name="quantity" value="1" min="1" max="10">

								<button style="background-color: goldenrod; height: 50px; width: 170px; color: white; font-weight: bold;" type="submit" name="submit" class="btn"><i class="icon-cart"></i>  ADD TO CART</button>
								</form>
                            <form method="post">
                                <input type="hidden" name="wpid" value="<?php echo $row['id'];?>">
								<button style="background-color: goldenrod; height: 50px; width: 170px; color: white; font-weight: bold;" type="submit" name="wsubmit" class="btn"><i class="icon-heart"></i>  ADD TO WISHLIST</button>
								</form>
							
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
			
            
            <div class="tabs-container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#write-review">Write Review</a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div id="reviews" class="tab-pane fade show active">
                        <?php
                        $query1=mysqli_query($con,"select * from tblreview join users on users.id=tblreview.UserId where ProductID='$pid' && Status='Review Accept'");
                        while ($result=mysqli_fetch_array($query1)) {
                        ?>
                        <div class="review-item">
                            <p class="review-author"><?php echo $result['Name'];?></p>
                            <p class="review-date"><?php echo $result['DateofReview'];?></p>
                            <p><?php echo $result['Review'];?></p>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div id="write-review" class="tab-pane fade">
                        <?php if (strlen($_SESSION['jsmsuid']==0)) { ?>
                            <div class="alert alert-warning">Login is Required for Review</div>
                        <?php } else { ?>
                            <form method="post" class="review-form">
                                <div class="form-group">
                                    <label>Review Title</label>
                                    <input type="text" name="reviewtitle" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Your Review</label>
                                    <textarea name="reviewdescription" class="form-control" rows="5" required></textarea>
                                </div>
                                <button type="submit" name="review" class="btn btn-custom btn-cart">Submit Review</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once('includes/footer.php');?>
    
    <script src="libs/jquery/js/jquery.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="libs/slick/js/slick.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
