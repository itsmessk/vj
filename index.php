<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
$awards = mysqli_query($con, "SELECT * FROM awards ORDER BY award_date DESC LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from caketheme.com/html/mojuri/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Dec 2024 17:33:05 GMT -->
<head>
		<!-- Meta Data -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>VJ - Jewellery</title>
		
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
		
		<!-- Google Web Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap" rel="stylesheet">
		
	<body class="home home-4 title-4">
		<div id="page" class="hfeed page-wrapper">
		<?php include_once('includes/header.php');?>

			<div id="site-main" class="site-main">
				<div id="main-content" class="main-content">
					<div id="primary" class="content-area">
						<div id="content" class="site-content" role="main">
						<?php 
session_start();
include_once('includes/config.php');

// Fetch all banners from the database
$banners_query = mysqli_query($con, "SELECT * FROM banners ORDER BY created_at DESC");

if (!$banners_query) {
    die("Query failed: " . mysqli_error($con));
}
?>

<section class="section m-b-0">
    <!-- Block Sliders (Layout 4) -->
    <div class="block block-sliders layout-4 auto-height color-white nav-center">
        <div class="slick-sliders" data-autoplay="true" data-dots="true" data-nav="true" data-columns4="1" data-columns3="1" data-columns2="1" data-columns1="1" data-columns1440="1" data-columns="1">
            <?php 
            // Check if there are any banners
            if (mysqli_num_rows($banners_query) > 0) {
                // Loop through each banner and display it in the slider
                while ($banner = mysqli_fetch_assoc($banners_query)) { 
					$banner_image_path = "admin/uploads/" . $banner['image'];

                    // Check if the image file exists
                    if (file_exists($banner_image_path)) {
            ?>
                        <div class="item slick-slide">
                            <div class="item-content">
                                <div class="content-image">
                                    <img width="1920" height="781" src="<?php echo $banner_image_path; ?>" alt="Image Slider">
                                </div>
                                <div class="item-info horizontal-center vertical-middle text-center">
                                    <div class="content">
                                        <div class="subtitle-slider"><?php echo $banner['subtitle']; ?></div>
                                        <h2 class="title-slider"><?php echo $banner['title']; ?></h2>
                                        <a class="button-slider button button-white button-outline thick-border" href="<?php echo $banner['link']; ?>">Explore Bestseller</a>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    } else {
                        echo "<p>Image not found: " . $banner_image_path . "</p>";
                    }
                }
            } else {
                echo "<p>No banners found in the database.</p>";
            }
            ?>
        </div>
    </div>
</section>


							<section class="section section-padding background-img bg-img-2 p-t-70 p-b-50 m-b-70">
								<div class="section-container">
									<!-- Block Product Categories (Layout 3) -->
									<div class="block block-product-cats slider layout-3">
										<div class="block-widget-wrap">
											<div class="block-title">
												<div class="sub-title">We’ve Got You Covered</div>
												<h2>Explore the Range</h2>
											</div>
											<div class="block-content">
												<div class="product-cats-list slick-wrap">
													<div class="slick-sliders content-category" data-dots="0" data-slidestoscroll="true" data-nav="0" data-columns4="1" data-columns3="3" data-columns2="4" data-columns1="4" data-columns1440="5" data-columns="5">
														<div class="item item-product-cat slick-slide">	
															<div class="item-product-cat-content">
																	<div class="item-image animation-horizontal">
																		<img width="273" height="376" src="media/product/cat-4-1.jpg" alt="Bracelets">
																	</div>
																<div class="product-cat-content-info">
																	<h1 class="title">
																	<button type="submit" class="btn" style="background-color: goldenrod; color: white; font-size:20px; " name="placeorder">Bracelets</button>
																		
																	</h1>
																</div>
															</div>
														</div>
														
														<div class="item item-product-cat slick-slide">	
															<div class="item-product-cat-content">
																	<div class="item-image animation-horizontal">
																		<img width="273" height="376" src="media/product/cat-4-2.jpg" alt="Charms">
																	</div>
																			
																<div class="product-cat-content-info">
																<h1 class="title">
																	<button type="submit" class="btn" style="background-color: goldenrod; color: white; font-size:20px; " name="placeorder">Pendants</button>
																		
																	</h1>
																</div>
															</div>
														</div>
														<div class="item item-product-cat slick-slide">	
															<div class="item-product-cat-content">
																	<div class="item-image animation-horizontal">
																		<img width="273" height="376" src="media/product/cat-4-3.jpg" alt="Earrings">
																	</div>
																<div class="product-cat-content-info">
																<h1 class="title">
																	<button type="submit" class="btn" style="background-color: goldenrod; color: white; font-size:20px; " name="placeorder">Earrings</button>
																		
																	</h1>
																</div>
															</div>
														</div>
														<div class="item item-product-cat slick-slide">	
															<div class="item-product-cat-content">
																	<div class="item-image animation-horizontal">
																		<img width="273" height="376" src="media/product/cat-4-4.jpg" alt="Necklaces">
																	</div>
																<div class="product-cat-content-info">
																<h1 class="title">
																	<button type="submit" class="btn" style="background-color: goldenrod; color: white; font-size:20px; " name="placeorder">Necklaces</button>
																		
																	</h1>
																</div>
															</div>
														</div>
														<div class="item item-product-cat slick-slide">	
															<div class="item-product-cat-content">
																	<div class="item-image animation-horizontal">
																		<img width="273" height="376" src="media/product/cat-4-5.jpg" alt="Rings">
																	</div>
																<div class="product-cat-content-info">
																<h1 class="title">
																	<button type="submit" class="btn" style="background-color: goldenrod; color: white; font-size:20px; " name="placeorder">Rings</button>
																		
																	</h1>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="section section-padding m-b-70">
								<div class="section-container large">
									<!-- Block Banners (Layout 4) -->
									<div class="block block-banners layout-4 banners-effect">
										<div class="block-widget-wrap">
											<div class="row">
												<div class="col-md-6 sm-m-b-40">
													<div class="block-widget-banner">
														<div class="bg-banner">
															<div class="banner-wrapper banners">
																<div class="banner-image">
																		<img width="690" height="398" src="media/banner/banner-4-1.jpg" alt="Banner Image">
																</div>
																<div class="banner-wrapper-infor">
																	<div class="info">
																		<div class="content">
																			<h3 class="title-banner">Our Exclusives</h3>
																			<div class="banner-image-description">
																				
																				VJ celebrates every occasion of life through its mindfully designed adornments that reflect tradition, culture and intricacy of craftsmanship embodied in exclusive ranges of quality jewellery
																			</div>
																			<a class="button button-outline border-black" href="products.php">SHOP NOW</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="block-widget-banner">
														<div class="bg-banner">
															<div class="banner-wrapper banners">
																<div class="banner-image">
																		<img width="690" height="398" src="media/banner/banner-4-2.jpg" alt="Banner Image">
																</div>
																<div class="banner-wrapper-infor">
																	<div class="info">
																		<div class="content">
																			<h3 class="title-banner">Devotional jewels</h3>
																			<div class="banner-image-description">
																				Our dedication to perfection, finesse and purity has humbled us with numerous opportunities to grace the pious, sacred Gods and Goddesses of many holy temples across the globe with our creations.
																			</div>
																			<a class="button button-outline border-black" href="products.php">SHOP NOW</a>
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
							</section>

							

							<section class="section m-b-70">
								<!-- Block Video -->
								<div class="block block-video">
									<div class="video-container">
										<div id="player"></div>
									</div>
									<div class="video-caption">
										<h2 class="caption-title">Stand Out In Style</h2>
										<a class="button button-white animation-horizontal" href="login.php">DISCOVER NOW</a>
									</div>
								</div>
							</section>

							<!-- First add the CSS to your head section, just before the closing </head> tag -->
<style>
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.product-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    margin-bottom: 30px;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.product-image-container {
    position: relative;
    padding-top: 100%;
    background: #f8f8f8;
    border-radius: 12px 12px 0 0;
    overflow: hidden;
}

.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.hover-image {
    opacity: 0;
    transform: scale(1.1);
}

.product-card:hover .post-image {
    opacity: 0;
}

.product-card:hover .hover-image {
    opacity: 1;
    transform: scale(1);
}

.product-labels {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.label {
    padding: 6px 12px;
    border-radius: 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.label-hot {
    background: linear-gradient(45deg, goldenrod, #FFD700);
    color: white;
}

.label-sale {
    background: linear-gradient(45deg, #DAA520, #FFD700);
    color: white;
}

.product-details {
    padding: 25px;
}

.product-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #2d3436;
    font-family: 'Cormorant Garamond', serif;
}

.product-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-title a:hover {
    color: goldenrod;
}

.price-container {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.original-price {
    color: #b2bec3;
    text-decoration: line-through;
    font-size: 16px;
}

.discounted-price {
    color: goldenrod;
    font-size: 22px;
    font-weight: 700;
}

.shop-now-btn {
    display: inline-block;
    width: 100%;
    padding: 12px 25px;
    background: linear-gradient(45deg, goldenrod, #FFD700);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    transition: all 0.3s ease;
}

.shop-now-btn:hover {
    background: linear-gradient(45deg, #FFD700, goldenrod);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(218, 165, 32, 0.3);
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
    font-family: 'Cormorant Garamond', serif;
}

.sub-title {
    color: goldenrod;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
}

.main-title {
    font-size: 36px;
    color: #2d3436;
    margin: 0;
}
</style>

<!-- Then replace your existing product section with this code -->
<section class="section section-padding m-b-70">
    <div class="section-container large">
        <!-- Block Products -->
        <div class="block block-products">
            <div class="block-widget-wrap">
                <div class="section-title">
                    <div class="sub-title">On Trend Hot Jewellery</div>
                    <h2 class="main-title">The Hot List</h2>
                </div>
                <div class="block-content" >
                    <div class="product-grid" >
                        <?php
                        // Fetch latest products
                        $query = "SELECT p.*, c.categoryName 
                                FROM products p 
                                LEFT JOIN category c ON p.category = c.id 
                                WHERE p.productAvailability = 'In Stock'
                                ORDER BY p.id DESC 
                                LIMIT 4";
                        $result = mysqli_query($con, $query);

                        if (!$result) {
                            echo "Error: " . mysqli_error($con);
                        }

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                $price = $row['productPrice'];
								$dis = $price * 0.10;
								$price = $price + $dis;
                                $discounted_price = $price - $dis;
                                
                                $image_path1 = "admin/productimages/" . $row['productImage1'];
                                $image_path2 = "admin/productimages/" . $row['productImage2'];
								
                                
                                // Check if images exist
                                if (!file_exists($image_path1)) {
                                    $image_path1 = "media/product/default.jpg";
                                }
                                if (!file_exists($image_path2)) {
                                    $image_path2 = "media/product/default.jpg";
                                }
                        ?>
                        <div class="product-card" style="border: 1px solid lightgray">
                            <div class="product-image-container">
                                <div class="product-labels">
                                    <span class="label label-hot">Hot</span>
                                    <!-- <span class="label label-sale">-10%</span> -->
                                </div>
                                <form method="post">
                                    <input type="hidden" name="pid" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <input type="hidden" name="wpid" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <img src="<?php echo htmlspecialchars($image_path1); ?>" 
                                         class="product-image post-image" 
                                         alt="<?php echo htmlspecialchars($row['productName']); ?>"
                                         loading="lazy">
                                    <img src="<?php echo htmlspecialchars($image_path2); ?>" 
                                         class="product-image hover-image" 
                                         alt="<?php echo htmlspecialchars($row['productName']); ?>"
                                         loading="lazy">
                            </div>
                            <div class="product-details">
                                <h3 class="product-title">
                                    <a href="shop-details.php?pid=<?php echo htmlspecialchars($row['id']); ?>">
                                        <?php echo htmlspecialchars($row['productName']); ?>
                                    </a>
                                </h3>
                                <div class="price-container">
                                    <span class="original-price">₹<?php echo number_format($price, 2); ?></span>
                                    <span class="discounted-price">₹<?php echo number_format($discounted_price, 2); ?></span>
                                </div>
                                <?php if($_SESSION['jsmsuid']==""){?>
                                    <a href="login.php" class="shop-now-btn">Login to Shop</a>
                                <?php } else { ?>
                                    <a href="products.php" class="shop-now-btn">Shop Now</a>

                                    <!-- <button type="submit" name="wsubmit" class="shop-now-btn" style="margin-top: 10px;">Add to Wishlist</button> -->
                                <?php } ?>
                                </form>
                            </div>
                        </div>
                        <?php 
                            }
                        } else {
                            echo '<div class="col-12 text-center"><p>No products available at the moment.</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

							<section class="section section-padding top-border p-t-70 m-b-70">
								<div class="section-container">
									<!-- Block Intro (Layout 3) -->
									<div class="block block-intro layout-3">
										<div class="block-widget-wrap">
											<div class="row">
												<div class="section-column left">
													<div class="intro-wrap">
														<h2 class="intro-title black">Jewellery Online<br> at the Most Affordable Price</h2>
														<div class="intro-item">
															Behind our 15-year success is our panel of expert jewellers who have been scouring the entire globe in pursuit of the best and most stunning jewellery that can be offered at affordable price for you. 
														</div>
														<div class="intro-item">
															Visit our online catalogue and shop for the finest earrings, rings, bracelets, watches, silver, and the most luxurious gemstones. 
														</div>
														<div class="intro-btn">
															<a href="about.php" class="button button-outline border-black animation-horizontal">Read more</a>
														</div>
													</div>
												</div>
												<div class="section-column right animation-horizontal hover-opacity">
													<img width="690" height="498" src="media/banner/intro-4.jpg" alt="intro">
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="section section-padding top-border p-t-70 m-b-70">
    <div class="section-container">
        <div class="block block-posts slider">
            <div class="block-widget-wrap">
                <div class="block-title">
                    <div class="sub-title">Awards & Inspired</div>
                    <h2>Awards and Prizes</h2>
                </div>
                <div class="block-content">
                    <div class="posts-wrap slick-wrap">
                        <div class="slick-sliders" data-slidestoscroll="true" data-dots="0" data-nav="1" 
                            data-columns4="1" data-columns3="1" data-columns2="2" data-columns1="3" data-columns="3">
                            <?php while($award = mysqli_fetch_array($awards)) { ?>
                            <div class="post-grid post">    
                                <div class="post-inner">
                                    <div class="post-image">
                                        <div class="post-date-wrap">
                                            <div class="post-date">
                                                <span><?php echo date('d', strtotime($award['award_date'])); ?></span>
                                                <span><?php echo date('M', strtotime($award['award_date'])); ?></span>
                                            </div>
                                        </div>
                                        <a class="post-thumbnail" href="#">
                                            <img width="720" height="484" 
                                                src="admin/uploads/<?php echo $award['image']; ?>" 
                                                alt="<?php echo $award['title']; ?>">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <div class="post-categories">
                                            <a href="#" style="color:black;"><?php echo $award['category']; ?></a>
                                        </div>
                                        <h2 class="post-title">
                                            <a href="#" style="color:black;"><?php echo $award['title']; ?></a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

							<section class="section section-padding background-img bg-img-3 p-t-70 p-b-70 m-b-0">
								<div class="section-container">
									<!-- Block Feature (Layout 2) -->
									<div class="block block-feature layout-2">
										<div class="block-widget-wrap">
											<div class="row">
												<div class="col-md-6 sm-m-b-50">
													<div class="box">
														<div class="box-icon animation-horizontal">
															<span>
																<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.998 511.998" style="enable-background:new 0 0 511.998 511.998;"><g><g><path d="M256.013,59.844c-108.193,0-196.218,88.025-196.218,196.218c0,108.201,88.025,196.218,196.218,196.218    S452.23,364.263,452.23,256.061C452.23,147.869,364.206,59.844,256.013,59.844z M256.013,435.217    c-98.791,0-179.155-80.372-179.155-179.155c0-98.791,80.364-179.155,179.155-179.155s179.155,80.364,179.155,179.155    C435.168,354.844,354.804,435.217,256.013,435.217z"></path></g></g><g><g><path d="M256.013,281.655h-68.25c-4.709,0-8.531,3.813-8.531,8.531v42.656c0,2.849,1.425,5.511,3.796,7.098l21.797,14.529v38.092    c0,3.489,2.124,6.629,5.358,7.925l42.656,17.062c1.032,0.409,2.107,0.606,3.174,0.606c1.689,0,3.353-0.503,4.786-1.467    c2.338-1.587,3.745-4.231,3.745-7.064V290.186C264.544,285.468,260.722,281.655,256.013,281.655z M247.482,397.022l-25.594-10.237    v-36.88c0-2.849-1.425-5.511-3.796-7.098l-21.797-14.529v-29.561h51.187V397.022z"></path></g></g><g><g><path d="M262.044,190.311l-42.656-42.656c-2.448-2.44-6.108-3.174-9.299-1.851c-3.182,1.322-5.264,4.436-5.264,7.883v17.062    h-17.062V85.437h-17.062v93.843c0,4.709,3.822,8.531,8.531,8.531h34.125c4.709,0,8.531-3.822,8.531-8.531v-4.999l25.594,25.594    v30.593h-59.718c-4.709,0-8.531,3.822-8.531,8.531v33.434l-25.594-20.466v-47.092c0-4.709-3.822-8.531-8.531-8.531h-68.25v17.062    h59.718v42.656c0,2.585,1.177,5.042,3.199,6.663l42.656,34.125c1.544,1.237,3.43,1.868,5.332,1.868    c1.263,0,2.525-0.273,3.694-0.845c2.96-1.425,4.837-4.402,4.837-7.687V247.53h59.718c4.709,0,8.531-3.822,8.531-8.531v-42.656    C264.544,194.082,263.648,191.915,262.044,190.311z"></path></g></g><g><g><path d="M343.824,87.937l-62.218,62.218l-17.062-17.062V68.375h-17.062v68.25c0,2.261,0.896,4.428,2.5,6.032l25.594,25.594    c1.595,1.604,3.762,2.5,6.032,2.5c2.261,0,4.428-0.896,6.032-2.5l68.25-68.25L343.824,87.937z"></path></g></g><g><g><path d="M442.829,243.785c-1.433-2.926-4.402-4.786-7.661-4.786h-25.594v-76.781c0-4.709-3.813-8.531-8.531-8.531h-51.187    c-2.269,0-4.428,0.896-6.032,2.5l-42.656,42.656c-3.336,3.336-3.336,8.727,0,12.063l31.625,31.625v81.78    c0,4.718,3.813,8.531,8.531,8.531h34.125c2.628,0,5.11-1.22,6.731-3.293l59.718-76.781    C443.895,250.2,444.262,246.711,442.829,243.785z M371.278,315.78h-21.422v-76.781c0-2.261-0.896-4.428-2.5-6.032l-28.093-28.093    l34.125-34.125h39.124v76.781c0,4.709,3.813,8.531,8.531,8.531h16.678L371.278,315.78z"></path></g></g><g><g><path d="M297.21,491.386c-13.582,2.355-27.445,3.549-41.197,3.549c-0.026,0-0.051,0-0.077,0    c-63.771,0-123.737-24.826-168.85-69.913c-45.139-45.096-70.007-105.079-70.024-168.884c-0.008-34.364,7.192-67.644,21.405-98.919    l-15.527-7.055C7.704,183.674-0.009,219.335,0,256.138c0.017,68.361,26.669,132.635,75.015,180.955    c48.338,48.304,112.586,74.904,180.921,74.904c0.026,0,0.051,0,0.085,0c14.725,0,29.561-1.271,44.106-3.796L297.21,491.386z"></path></g></g><g><g><path d="M346.623,477.147c-9.162,3.762-18.641,6.979-28.161,9.546l4.445,16.482c10.212-2.764,20.364-6.211,30.2-10.246    L346.623,477.147z"></path></g></g><g><g><path d="M506.506,202.895C477.235,64.843,341.146-23.694,203.06,5.602l3.54,16.687C335.43-5.027,462.502,77.589,489.81,206.435    c10.528,49.583,4.752,102.315-16.252,148.468l15.527,7.064C511.591,312.521,517.767,256.027,506.506,202.895z"></path></g></g><g><g><path d="M185.528,10.312c-8.983,2.44-17.898,5.417-26.506,8.838l6.296,15.859c8.019-3.182,16.32-5.955,24.681-8.233    L185.528,10.312z"></path></g></g><g><g><path d="M151.13,45.264c-17.54-17.455-45.795-18.274-64.325-1.868L39.491,85.437H8.608c-3.447,0-6.56,2.073-7.883,5.264    S0.136,97.56,2.576,100l42.656,42.656c1.664,1.664,3.848,2.5,6.032,2.5c2.056,0,4.112-0.734,5.742-2.227l93.843-85.312    c1.732-1.57,2.739-3.779,2.79-6.117C153.69,49.171,152.785,46.911,151.13,45.264z M51.546,124.843L29.202,102.5h13.531    c2.09,0,4.104-0.759,5.665-2.15l49.728-44.183c9.444-8.369,22.864-9.7,33.57-4.189L51.546,124.843z"></path></g></g><g><g><path d="M509.441,412.123l-42.656-42.656c-3.208-3.233-8.395-3.336-11.773-0.282l-93.843,85.312    c-1.723,1.578-2.73,3.796-2.79,6.125c-0.051,2.329,0.862,4.59,2.517,6.236c9.12,9.077,21.132,13.65,33.169,13.65    c11.116,0,22.266-3.907,31.156-11.79l47.306-42.033h30.883c3.447,0,6.569-2.073,7.883-5.264    C512.614,418.231,511.881,414.563,509.441,412.123z M469.293,409.623c-2.09,0-4.104,0.768-5.665,2.158l-49.72,44.175    c-9.444,8.352-22.864,9.7-33.579,4.189l80.151-72.865l22.343,22.343H469.293z"></path></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
															</span>
														</div>
														<div class="box-title-wrap">
															<h3 class="box-title">
											 		 			Shipping Worldwide
															</h3>
															<p class="box-description">
													 			We ship all the project worldwide 
															</p>
														</div>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="box">
														<div class="box-icon icon-3 animation-horizontal">
															<span>
																<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"><g><g><path d="M457.987,31.531c-2.688-6.997-13.013-8.533-17.749-3.499c-21.44,18.88-48.939,29.248-77.547,29.248    c-39.424,0-75.989-19.627-97.771-52.501C262.937,1.792,259.609,0,256.025,0c-3.563,0-6.912,1.792-8.875,4.757    c-21.845,32.875-58.411,52.501-97.835,52.501c-28.928,0-56.704-10.603-78.208-29.867c-3.136-2.816-7.616-3.499-11.477-1.792    c-3.84,1.707-6.315,5.525-6.315,9.728v231.317c0,133.205,189.44,239.552,197.504,244.011c1.6,0.896,3.392,1.344,5.163,1.344    c1.771,0,3.563-0.448,5.163-1.301c8.064-4.459,197.504-110.827,197.504-244.011v-230.4    C458.777,34.688,458.563,33.067,457.987,31.531z M437.315,266.667c0,109.163-151.232,204.459-181.333,222.336    C225.859,471.125,74.649,375.936,74.649,266.667V56.811c22.165,14.165,48,21.803,74.667,21.803    c41.579,0,80.469-18.496,106.667-50.091c26.24,31.616,65.131,50.091,106.709,50.091c26.645,0,52.48-7.637,74.624-21.781V266.667z"></path></g></g><g><g><path d="M327.577,195.136c-4.16-4.16-10.923-4.16-15.083,0l-77.845,77.781l-35.072-35.115c-4.16-4.16-10.923-4.16-15.083,0    c-4.16,4.139-4.16,10.923,0,15.083l42.581,42.667c2.005,1.984,4.715,3.115,7.552,3.115s5.547-1.131,7.531-3.115l85.419-85.333    C331.737,206.059,331.737,199.296,327.577,195.136z"></path></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
															</span>
														</div>
														<div class="box-title-wrap">
															<h3 class="box-title">
											 		 			Security Payment 
															</h3>
															<p class="box-description">
													 			The payment transaction are end to end enctyped and safe payment
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div><!-- #content -->
					</div><!-- #primary -->
				</div><!-- #main-content -->
			</div>

			<footer >
				<?php 
					include_once('includes/footer.php')
				?>
			</footer>
		</div>

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
		
		<!-- Site Scripts -->
		<script src="assets/js/app.js"></script>

		<script>
			var tag = document.createElement('script');

			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			var player;
			function onYouTubeIframeAPIReady() {
				player = new YT.Player('player', {
					width: '100%',
					videoId: 'yGMVKa8oryE',
					playerVars: {'autoplay': 1, 'playsinline': 1},
					events: {
						'onReady': onPlayerReady,
						'onStateChange': onPlayerStateChange
					}
				});
			}

			function onPlayerReady(event) {
				event.target.mute();
				event.target.playVideo();
			}

			function onPlayerStateChange(event) {
    			if (event.data == YT.PlayerState.ENDED) {
      				player.seekTo(0);
      				player.playVideo();
    			}
  			}
		</script>
	</body>

<!-- Mirrored from caketheme.com/html/mojuri/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Dec 2024 17:33:08 GMT -->
</html>