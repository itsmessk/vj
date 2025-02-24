<?php
// Include the database connection
include_once('includes/config.php');

// Session user ID for cart
$userid = $_SESSION['jsmsuid'];
$ret2 = mysqli_query($con, "select sum(products.shippingCharge+products.productPrice) as total,COUNT(orders.PId) as totalp from orders join products on products.id=orders.PId where orders.UserId='$userid' and orders.IsOrderPlaced is null");
$resultss = mysqli_fetch_array($ret2);

// Modified query to include type creation date for sorting
$sql = "SELECT t.typeName, t.typeDescription, t.creationDate as typeCreationDate, 
        c.categoryName, c.id AS category_id, c.creationDate, s.subcategoryName 
        FROM type t 
        LEFT JOIN category c ON t.id = c.type_id
        LEFT JOIN subcategory s ON c.id = s.categoryid 
        ORDER BY t.creationDate ASC, t.typeName ASC, c.creationDate ASC";

$result = $con->query($sql);

// Initialize array to hold the types, categories, and subcategories
$typeData = [];

// After fetching the data and grouping it by types
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $typeName = $row['typeName'];

        if (!isset($typeData[$typeName])) {
            $typeData[$typeName] = [
                'name' => $typeName,
                'description' => $row['typeDescription'],
                'creationDate' => $row['typeCreationDate'],
                'categories' => []
            ];
        }

        if ($row['categoryName']) {
            if (!isset($typeData[$typeName]['categories'][$row['categoryName']])) {
                $typeData[$typeName]['categories'][$row['categoryName']] = [
                    'name' => $row['categoryName'],
                    'subcategories' => []
                ];
            }

            if ($row['subcategoryName']) {
                $typeData[$typeName]['categories'][$row['categoryName']]['subcategories'][] = $row['subcategoryName'];
            }
        }
    }

    // Sort categories and subcategories alphabetically
    foreach ($typeData as $typeName => $type) {
        ksort($typeData[$typeName]['categories']);
        foreach ($typeData[$typeName]['categories'] as $categoryName => $category) {
            sort($typeData[$typeName]['categories'][$categoryName]['subcategories']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VJ - Jewellery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Original header styles -->
    
</head>
<body>
    <header id="site-header" class="site-header header-v4">
        <div class="header-mobile">
            <!-- Mobile header content remains the same -->
            <div class="section-padding">
                <div class="section-container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-left">
                            <div class="navbar-header">
                                <button type="button" id="show-megamenu" class="navbar-toggle"></button>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 header-left">
                        <div class="site-logo">
                                <a href="index.php">
                                    <img width="400" height="79" src="media/logonew.png" alt="VJ - Jewellery">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-right">
                            <div class="mojuri-topcart dropdown">
                                <div class="dropdown mini-cart top-cart">
                                    <div class="remove-cart-shadow"></div>
                                    <a class="dropdown-toggle cart-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="icons-cart">
                                            <i class="icon-large-paper-bag"></i>
                                            <span class="cart-count"><?php if (strlen($_SESSION['jsmsuid']>0)) {?><?php echo $resultss['totalp']; ?><?php }else { echo "0"; } ?></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile fixed header content remains the same -->
            <div class="header-mobile-fixed">
                <!-- Shop, Login, Search sections remain the same -->
            </div>
        </div>

        <div class="header-desktop">
            <!-- Desktop header content -->
            <div class="header-bottom">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="block block-feature">
                            <div class="block-widget-wrap">
                            <div class="row">

<div class="col-md-4 sm-m-b-50">
    <div class="box">
        <div class="box-icon">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg"xmlns:xlink="http://www.w3.org/1999/xlink"id="Layer_1"x="0px"y="0px"viewBox="0 0 512 512"style="enable-background:new 0 0 512 512;"xml:space="preserve"><g><g><path d="M509.473,256.394l-59.391-67.801c-1.937-2.21-4.733-3.479-7.672-3.479h-49.455v-41.872    c0-5.633-4.567-10.199-10.199-10.199H172.109c-5.632,0-10.199,4.566-10.199,10.199v13.762H63.818    c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h98.092v132.21h-59.046    c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h59.046v10.365c0,5.633,4.567,10.199,10.199,10.199    h21.288c4.485,16.339,19.459,28.382,37.203,28.382c17.744,0,32.718-12.043,37.204-28.382h136.089v-0.001    c4.485,16.339,19.459,28.382,37.203,28.382c17.744,0,32.718-12.043,37.204-28.382h23.502c5.632,0,10.199-4.566,10.199-10.199    v-77.261C512,260.642,511.101,258.253,509.473,256.394z M230.6,358.558c-10.026,0-18.182-8.157-18.182-18.183    s8.156-18.183,18.182-18.183s18.183,8.157,18.183,18.183S240.626,358.558,230.6,358.558z M267.802,330.176    c-4.485-16.339-19.46-28.382-37.204-28.382s-32.717,12.043-37.203,28.382h-11.089V153.44h190.247v176.736H267.802z     M441.094,358.558c-10.026,0-18.182-8.157-18.182-18.183s8.156-18.183,18.182-18.183c10.026,0,18.183,8.157,18.183,18.183    S451.121,358.558,441.094,358.558z M491.602,330.176h-13.304c-4.485-16.339-19.46-28.382-37.204-28.382    c-17.744,0-32.717,12.043-37.203,28.382h-10.939V205.512h44.831l53.818,61.437V330.176z"></path></g></g><g><g><path d="M69.261,309.611h-5.442c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h5.442    c5.632,0,10.199-4.566,10.199-10.199C79.46,314.177,74.894,309.611,69.261,309.611z"></path></g></g><g><g><path d="M119.5,232.276H10.199C4.567,232.276,0,236.842,0,242.475c0,5.633,4.567,10.199,10.199,10.199H119.5    c5.632,0,10.199-4.566,10.199-10.199C129.699,236.842,125.132,232.276,119.5,232.276z"></path></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            </span>
        </div>
        <div class="box-title-wrap">
            <h3 class="box-title">
                 FREE SHIPPING ALL OVER INDIA
            </h3>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="box">
        <div class="box-icon icon-3">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg"xmlns:xlink="http://www.w3.org/1999/xlink"id="Layer_1"x="0px"y="0px"viewBox="0 0 512 512"style="enable-background:new 0 0 512 512;"xml:space="preserve"><g><g><path d="M498.946,294.959c-5.521-1.116-10.902,2.455-12.018,7.977C464.834,412.256,367.715,491.602,256,491.602    c-129.911,0-235.602-105.69-235.602-235.602S126.089,20.398,256,20.398c61.287,0,120.041,23.97,163.818,66.295h-26.361    c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h51.229c5.633,0,10.199-4.566,10.199-10.199V45.664    c0-5.633-4.566-10.199-10.199-10.199c-5.633,0-10.199,4.566-10.199,10.199v26.848C386.87,26.228,322.823,0,256,0    C187.62,0,123.333,26.628,74.98,74.98C26.628,123.333,0,187.62,0,256s26.628,132.667,74.98,181.02    C123.333,485.372,187.62,512,256,512c59.438,0,117.352-20.83,163.074-58.652c45.116-37.321,76.315-89.304,87.849-146.372    C508.039,301.455,504.467,296.075,498.946,294.959z"></path></g></g><g><g><path d="M501.801,245.801c-5.633,0-10.199,4.566-10.199,10.199c0,2.281-0.033,4.585-0.098,6.848    c-0.161,5.631,4.273,10.326,9.903,10.487c0.1,0.002,0.198,0.004,0.297,0.004c5.497,0,10.031-4.376,10.19-9.907    c0.07-2.457,0.106-4.957,0.106-7.43C512,250.367,507.434,245.801,501.801,245.801z"></path></g></g><g><g><path d="M248.858,350.416H145.234v-20.14c0-43.204,109.147-65.293,109.147-135.134c0-35.082-27.286-62.369-64.644-62.369    c-34.434,0-61.07,22.739-61.07,53.924c0,9.745,3.248,13.319,9.745,13.319c7.471,0,11.369-4.548,11.369-8.771    c0-25.662,16.892-38.332,39.306-38.332c29.886,0,43.854,22.414,43.854,42.88c0,56.846-109.797,80.56-109.797,134.484v31.51    c0,5.198,5.847,8.446,10.07,8.446h115.644c4.223,0,7.796-4.872,7.796-10.071C256.654,354.964,253.081,350.416,248.858,350.416z"></path></g></g><g><g><path d="M388.538,293.893h-17.866v-62.695c0-5.523-5.523-8.121-10.72-8.121c-5.523,0-10.719,2.599-10.719,8.121v62.695h-63.669    l75.039-148.127c0.65-1.625,0.975-2.924,0.975-4.223c0-5.198-6.173-8.771-10.395-8.771c-3.898,0-7.796,1.949-10.071,6.497    l-81.535,160.797c-0.974,1.625-1.299,3.573-1.299,5.523c0,4.872,2.924,8.771,8.446,8.771h82.51v47.426    c0,5.522,5.198,8.446,10.719,8.446c5.198,0,10.72-2.924,10.72-8.446v-47.426h17.866c4.872,0,8.121-5.198,8.121-10.395    C396.658,299.091,394.059,293.893,388.538,293.893z"></path></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            </span>
        </div>
        <div class="box-title-wrap">
            <h3 class="box-title">
                 24/7 Free Support 
            </h3>
        </div>
    </div>
</div>

<?php
    // Fetch the latest gold and silver rates along with the creation timestamp
    $query = mysqli_query($con, "SELECT gold_rate, silver_rate, created_at FROM rates ORDER BY created_at DESC LIMIT 1");
    $row = mysqli_fetch_assoc($query);
    $gold_rate = $row['gold_rate'];
    $silver_rate = $row['silver_rate'];
    // Format the timestamp
    $last_updated = date('d M Y, h:i A', strtotime($row['created_at']));
?>

<div class="col-md-4">
    <div class="box" style="gap: 10px;">
        <div class="box-title-wrap" style="background-color: black; padding: 10px; border-radius: 5px;">
            <h3 class="box-title" style="color: gold; font-weight: bold;">
                Gold rate: ₹<?php echo $gold_rate; ?>/gm
            </h3>
        </div>
        <div class="box-title-wrap" style="background-color: black; padding: 10px; border-radius: 5px;">
            <h3 class="box-title" style="color: silver; font-weight: bold;">
                Silver rate: ₹<?php echo $silver_rate; ?>/gm
            </h3>
        </div>
        <div class="last-updated" style="text-align: right; font-size: 12px; color: #666; margin-top: 5px; font-style: italic;">
            Last updated: <?php echo $last_updated; ?>
        </div>
    </div>
</div>


</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>

            <div class="header-wrapper">
						<div class="section-padding">
							<div class="section-container large p-l-r">
								<div class="row">
									
									<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 header-left">
										<div >
											<a href="index.php">
												<img width="70px" height="140" src="media/logonew.png" alt="VJ - Jewellery">
											</a>
										</div>
									</div>

                            <!-- Navigation section -->
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-center header-center">
                                <div class="site-navigation">
                                    <nav id="main-navigation">
                                        <ul id="menu-main-menu" class="menu">
                                        <li class="level-0 menu-item">
														<a href="index.php" ><span class="menu-item-text">Home</span></a>
													</li>
                                                    <li class="level-0 menu-item">
                                                <a href="about.php"><span class="menu-item-text">About</span></a>
                                            </li>
                                            <?php if (!empty($typeData)) : ?>
                                                <?php foreach ($typeData as $type) : ?>
													<li class="level-0 menu-item menu-item-has-children mega-menu mega-menu-fullwidth align-center">
                                                        <a href="#"><span class="menu-item-text"><?php echo htmlspecialchars($type['name']); ?></span></a>
                                                        <?php if (!empty($type['categories'])) : ?>
                                                            <div class="sub-menu">
															<div class="row d-flex">
                                                                    <?php foreach ($type['categories'] as $category) : ?>
                                                                        <div class="col-md-3">
                                                                        <div class="menu-section">
                                                                                <h2 class="sub-menu-title" style="padding-top: 20px;"><?php echo htmlspecialchars($category['name']); ?></h2>
                                                                                <?php if (!empty($category['subcategories'])) : ?>
                                                                                    <ul class="menu-list">
                                                                                        <?php foreach ($category['subcategories'] as $subcategory) : ?>
                                                                                            <li>
                                                                                                <a style="text-decoration:none;" href="products.php?subcategory=<?php echo urlencode($subcategory); ?>">
                                                                                                    <span class="menu-item-text"><?php echo htmlspecialchars($subcategory); ?></span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php endforeach; ?>
                                                                                    </ul>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <li class="level-0 menu-item">
                                                <a href="contact.php"><span class="menu-item-text">Contact</span></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                            <!-- Right section (Login/Register, Cart) -->
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 header-right">
										<div class="header-page-link">
											

											<!-- Login -->
											

											<!-- Search -->
											<?php if (strlen($_SESSION['jsmsuid']==0)) {?>
											<!-- Login -->
											<div class="login-header">
												<a class="btn" href="login.php"><button style="color:black; width: 150px; height: 50px; background-color: goldenrod;" >LOGIN/REGISTER</button></a>
												
											</div><?php }?>
											
											<!-- Cart -->
											<?php if (strlen($_SESSION['jsmsuid']>0)) {?>
											<!-- Wishlist --><?php   $userid= $_SESSION['jsmsuid'];
																$ret2=mysqli_query($con,"select sum(products.shippingCharge+products.productPrice) as total,COUNT(orders.PId) as totalp from orders join products on products.id=orders.PId where orders.UserId='$userid' and orders.IsOrderPlaced is null");
																$resultss=mysqli_fetch_array($ret2);

																?>
                                            <div class="login-header icon">
												<a class="active-login" onclick="window.location.href='profile.php'"><i style="color:black;" class="icon-user"></i></a>

												
											</div>
											<?php
											if (strlen($_SESSION['jsmsuid'] > 0)) {
												// Get the user ID from session
												$userid = $_SESSION['jsmsuid'];

												// Query to fetch total wishlist value and product count
												$wishlist_query = mysqli_query($con, "
													SELECT 
														SUM(products.productPrice) AS totalPrice, 
														COUNT(wishlist.ProductId) AS totalProducts 
													FROM wishlist 
													JOIN products ON products.id = wishlist.ProductId 
													WHERE wishlist.UserId = '$userid'
												");

												// Fetch query results
												$wishlist_result = mysqli_fetch_array($wishlist_query);

												// Display wishlist data
											?>
											
											<div class="mojuri-topcart dropdown light">
													<div class="dropdown mini-cart top-cart">
														<div class="remove-cart-shadow"></div>
														<!-- Link directly to cart.html -->
														<a class="cart-icon" href="wishlist.php" role="button" style="text-decoration: none;">
															<div class="icons-cart">
															<i class="icon-heart" style="color: black;"></i>

																<span class="cart-count"><?php echo $wishlist_result['totalProducts']; ?></span>
															</div>
														</a>
													</div>
													
													
											</div>

											<?php
												} else {
													// If the user is not logged in, show default wishlist count
													?>
													<div class="wishlist-box">
														<a href="login.php" style="text-decoration: none;">
															<i class="icon-heart" style="color: black;" ></i>
															<span class="wishlist-count">0</span>
														</a>
													</div>
												<?php
												}
											?>
										

											
											<!-- Cart -->
											<div class="mojuri-topcart dropdown light">
													<div class="dropdown mini-cart top-cart">
														<div class="remove-cart-shadow"></div>
														<!-- Link directly to cart.html -->
														<a class="cart-icon" href="cart.php" role="button" style="text-decoration: none;">
															<div class="icons-cart">
																<i class="icon-large-paper-bag" style="color: black;"></i>
																<span class="cart-count"><?php echo $resultss['totalp']; ?></span>
															</div>
														</a>
													</div>
													
											</div>

											<div class="login-header">
												<button style="color:black; width: 100px; height: 50px; background-color: goldenrod;" class="active-login" onclick="window.location.href='logout.php'">Logout</button>
											</div>
											
                                            <?php }?>
										</div>
									</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>