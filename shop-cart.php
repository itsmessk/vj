<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['jsmsuid']==0)) {
  header('location:logout.php');
  } else{ 
// Code for deleting product from cart
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from orders where id='$rid'");
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'cart.php'</script>";     


}

  

    ?>
<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from caketheme.com/html/mojuri/shop-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Dec 2024 17:32:54 GMT -->
<head>
		<!-- Meta Data -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Shop Cart | Mojuri</title>
		
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
	</head>
	
	<body class="shop">
		<div id="page" class="hfeed page-wrapper">
			
		<?php include_once('includes/header.php')?>
			<div id="site-main" class="site-main">
				<div id="main-content" class="main-content">
					<div id="primary" class="content-area">
						<div id="title" class="page-title">
							<div class="section-container">
								<div class="content-title-heading">
									<h1 class="text-title-heading">
										Shopping Cart
									</h1>
								</div>
								<div class="breadcrumbs">
									<a href="index.html">Home</a><span class="delimiter"></span><a href="shop-grid-left.html">Shop</a><span class="delimiter"></span>Shopping Cart
								</div>
							</div>
						</div>

						<div id="content" class="site-content" role="main">
							<div class="section-padding">
								<div class="section-container p-l-r">
									<div class="shop-cart">	
										<div class="row">
											<div class="col-xl-8 col-lg-12 col-md-12 col-12">
												<form class="cart-form" action="#" method="post">
													<div class="table-responsive">
														<table class="cart-items table" cellspacing="0">
															<thead>
																<tr>
																	<th class="product-thumbnail">Product</th>
																	<th class="product-price">Price</th>
																	<th class="product-quantity">Quantity</th>
																	<th class="product-subtotal">Subtotal</th>
																	<th class="product-remove">&nbsp;</th>
																</tr>
															</thead>
															<tbody>
																<tr class="cart-item">		
																	<td class="product-thumbnail">
																		<a href="shop-details.html">
																			<img width="600" height="600" src="media/product/3.jpg" class="product-image" alt="">
																		</a>				
																		<div class="product-name">
																			<a href="shop-details.html">Twin Hoops</a>								
																		</div>
																	</td>
																	<td class="product-price">
																		<span class="price">$150.00</span>
																	</td>
																	<td class="product-quantity">
																		<div class="quantity">
																			<button type="button" class="minus">-</button>	
																			<input type="number" class="qty" step="1" min="0" max="" name="quantity" value="2" title="Qty" size="4" placeholder="" inputmode="numeric" autocomplete="off">
																			<button type="button" class="plus">+</button>
																		</div>
																	</td>
																	<td class="product-subtotal">
																		<span>$300.00</span>
																	</td>
																	<td class="product-remove">
																		<a href="#" class="remove">×</a>								
																	</td>
																</tr>
																<tr class="cart-item">		
																	<td class="product-thumbnail">
																		<a href="shop-details.html">
																			<img width="600" height="600" src="media/product/1.jpg" class="product-image" alt="">
																		</a>				
																		<div class="product-name">
																			<a href="shop-details.html">Medium Flat Hoops</a>								
																		</div>
																	</td>
																	<td class="product-price">
																		<span>$180.00</span>
																	</td>
																	<td class="product-quantity">
																		<div class="quantity">
																			<button type="button" class="minus">-</button>	
																			<input type="number" class="qty" step="1" min="0" max="" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" autocomplete="off">
																			<button type="button" class="plus">+</button>
																		</div>
																	</td>
																	<td class="product-subtotal">
																		<span class="price">$180.00</span>
																	</td>
																	<td class="product-remove">
																		<a href="#" class="remove">×</a>								
																	</td>
																</tr>
																<tr>
																	<td colspan="6" class="actions">
																		<div class="bottom-cart">
																			<div class="coupon">
																				<input type="text" name="coupon_code" class="input-text" id="coupon-code" value="" placeholder="Coupon code"> 
																				<button type="submit" name="apply_coupon" class="button" value="Apply coupon">Apply coupon</button>
																			</div>
																			<h2><a href="shop-grid-left.html">Continue Shopping</a></h2>
																			<button type="submit" name="update_cart" class="button" value="Update cart">Update cart</button>
																		</div>	
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</form>
											</div>
											<div class="col-xl-4 col-lg-12 col-md-12 col-12">
												<div class="cart-totals">
													<h2>Cart totals</h2>
													<div>
														<div class="cart-subtotal">
															<div class="title">Subtotal</div>
															<div><span>$480.00</span></div>
														</div>
														<div class="shipping-totals">
															<div class="title">Shipping</div>
															<div>
																<ul class="shipping-methods custom-radio">
																	<li>
																		<input type="radio" name="shipping_method" data-index="0" value="free_shipping" class="shipping_method" checked="checked"><label>Free shipping</label>
																	</li>
																	<li>
																		<input type="radio" name="shipping_method" data-index="0" value="flat_rate" class="shipping_method"><label>Flat rate</label>					
																	</li>
																</ul>
																<p class="shipping-desc">
																	Shipping options will be updated during checkout.				
																</p>
															</div>
														</div>
														<div class="order-total">
															<div class="title">Total</div>
															<div><span>$480.00</span></div>
														</div>
													</div>
													<div class="proceed-to-checkout">		
														<a href="shop-checkout.html" class="checkout-button button">
															Proceed to checkout
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="shop-cart-empty">
										<div class="notices-wrapper">
											<p class="cart-empty">Your cart is currently empty.</p>
										</div>	
										<div class="return-to-shop">
											<a class="button" href="shop-grid-left.html">
												Return to shop		
											</a>
										</div>
									</div>
								</div>
							</div>
						</div><!-- #content -->
					</div><!-- #primary -->
				</div><!-- #main-content -->
			</div>

			<?php include_once('includes/footer.php')?>


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

<!-- Mirrored from caketheme.com/html/mojuri/shop-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Dec 2024 17:32:54 GMT -->
</html><?php } ?>