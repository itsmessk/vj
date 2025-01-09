<?php
if(isset($_POST['sub']))
  {
   
    $email=$_POST['email'];
 
     
    $query=mysqli_query($con, "insert into tblsubscriber(Email) value('$email')");
    if ($query) {
   echo "<script>alert('Your subscribe successfully!.');</script>";
echo "<script>window.location.href ='index.php'</script>";
  }
  else
    {
       echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
  ?>
<footer id="site-footer" class="site-footer background four-columns">
				<div class="footer">
					<div class="section-padding">
						<div class="section-container">
							<div class="block-widget-wrap">
								<div class="row">
									<div class="col-lg-3 col-md-6 column-1">
										<div class="block block-menu m-b-20">
											<h2 class="block-title">Contact Us</h2>
											<div class="block-content">
												<ul>
													<li>
														<span>Head Office:</span> Chennai
													</li>
													<li>
														<span>Tel:</span> 01743 234500
													</li>
													<li>
														<span>Email:</span> <a href="mailto:support@vjjewel.com">support@vjjewel.com</a>
													</li>
												</ul>
											</div>
										</div>

										<div class="block block-social">
											<ul class="social-link">
												<li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
												<li><a href="#"><i class="fa fa-instagram"></i></a></li>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-youtube"></i></a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 column-2">
										<div class="block block-menu">
											<h2 class="block-title">Customer Services</h2>
											<div class="block-content">
												<ul>
													<li>
														<a href="admin/">Admin</a>
													</li>
													
													<li>
														<a href="all-products.php">Product Care & Repair</a>
													</li>
													
													<li>
														<a href="all-products.php">Shipping & Returns</a>
													</li>
													<li>
														<a href="cart.php">Cart</a>
													</li>
													<li>
														<a href="wishlist.php">Wishlists</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 column-3">
										<div class="block block-menu">
											<h2 class="block-title">About Us</h2>
											<div class="block-content">
												<ul>
													<li>
														<a href="index.php">Home</a>
													</li>
													<li>
														<a href="about.php">About Us</a>
													</li>
													
													<li>
														<a href="contact.php">Sitemap</a>
													</li>
													<li>
														<a href="#">Terms & Conditions</a>
													</li>
													<li>
														<a href="#">Privacy Policy</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 column-4">
										<div class="block block-menu">
											<h2 class="block-title">Catalog</h2>
											<div class="block-content">
												<ul>
													<li>
														<a href="all-products.php">Earrings</a>
													</li>
													<li>
														<a href="all-products.php">Necklaces</a>
													</li>
													<li>
														<a href="all-products.php">Bracelets</a>
													</li>
													<li>
														<a href="all-products.php">Rings</a>
													</li>
													<li>
														<a href="all-products.php">Jewelry Box</a>
													</li>
													<li>
														<a href="all-products.php">Studs</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="section-padding">
						<div class="section-container">
							<div class="block-widget-wrap">
								<div class="row">
									<div class="col-md-6">
										<div class="footer-left">
											<p class="copyright">Copyright © 2024. All Right Reserved</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="footer-right">
											<div class="block block-image">
												<img width="309" height="32" src="media/payments.png" alt="">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
       <!-- / footer -->