<?php
session_start();
error_reporting(0);
include_once('includes/config.php');

// Check if user is logged in
if (strlen($_SESSION['jsmsuid']==0)) {
  header('location:logout.php');
  exit();
} 

// Handle order placement
if(isset($_POST['placeorder'])) {
    $userid = $_SESSION['jsmsuid'];
    $fnaobno = $_POST['flatbldgnumber'];
    $street = $_POST['streename'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $state = $_POST['billing_state'];
    $zipcode = $_POST['zipcode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $paymode = $_POST['paymode'];

    // Generate order number
    $orderno = mt_rand(100000000, 999999999);
    
    // Prepare queries
    $queries = [
        "UPDATE orders SET 
            OrderNumber='$orderno',
            IsOrderPlaced='1',
            PaymentMethod='$paymode'
        WHERE UserId='$userid' AND IsOrderPlaced IS NULL",

        "INSERT INTO tblorderaddresses 
            (UserId, Ordernumber, Flatnobuldngno, StreetName, Area, City, 
            Zipcode, Phone, Email, PaymentMethod)
        VALUES 
            ('$userid', '$orderno', '$fnaobno', '$street', '$area', '$city', 
            '$zipcode', '$phone', '$email', '$paymode')"
    ];

    // Execute transaction
    $success = mysqli_multi_query($con, implode(';', $queries));
    
    if ($success) {
        if ($paymode == 'razorpay') {
            $_SESSION['order_number'] = $orderno;
            echo "<script>window.location.href='razorpay-payment.php';</script>";
        } else {
            echo "<script>
                alert('Order placed successfully. Order number: $orderno');
                window.location.href='my-orders.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Something went wrong. Please try again.');
            window.location.href='checkout.php';
        </script>";
    }
}

// Array of Indian states
$indian_states = array(
    'AN' => 'Andaman and Nicobar Islands',
    'AP' => 'Andhra Pradesh',
    'AR' => 'Arunachal Pradesh',
    'AS' => 'Assam',
    'BR' => 'Bihar',
    'CH' => 'Chandigarh',
    'CT' => 'Chhattisgarh',
    'DL' => 'Delhi',
    'GA' => 'Goa',
    'GJ' => 'Gujarat',
    'HR' => 'Haryana',
    'KA' => 'Karnataka',
    'KL' => 'Kerala',
    'MP' => 'Madhya Pradesh',
    'MH' => 'Maharashtra',
    'TN' => 'Tamil Nadu',
    'UP' => 'Uttar Pradesh'
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- (Your existing head content remains unchanged) -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Checkout - VJ Jewellery</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="media/favicon.png">
    
    <!-- Original CSS imports -->
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
    
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
    <!-- Additional styles for payment options -->
    <style>
        .payment-method-container {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .payment-option {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .payment-option.selected {
            border-color: #007bff;
            background-color: #e9f5ff;
        }
        .payment-option input[type="radio"] {
            margin-right: 10px;
        }
        .payment-option img {
            height: 30px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .place-order-btn {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .place-order-btn:hover {
            background-color: #0056b3;
        }
    </style>
    
    <!-- Optional JavaScript for selecting payment options -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentOptions = document.querySelectorAll('.payment-option');
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    paymentOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    this.querySelector('input[type="radio"]').checked = true;
                });
            });
        });
    </script>
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
                                <h1 class="text-title-heading">Checkout</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.html">Home</a><span class="delimiter"></span>
                                <a href="shop-grid-left.html">Shop</a><span class="delimiter"></span>Checkout
                            </div>
                        </div>
                    </div>

                    <div id="content" class="site-content" role="main">
                        <div class="section-padding">
                            <div class="section-container p-l-r">
                                <div class="shop-checkout">
                                    <form name="checkout" method="post" class="checkout" action="" autocomplete="off">
                                        <div class="row">
                                            <!-- Billing Details Column -->
                                            <div class="col-xl-8 col-lg-7 col-md-12 col-12">
                                                <div class="customer-details">
                                                    <div class="billing-fields">
                                                        <h3>Billing Details</h3>
                                                        <div class="billing-fields-wrapper">
                                                            <p class="form-row address-field validate-required form-row-wide">
                                                                <label>Street address <span class="required" title="required">*</span></label>
                                                                <span class="input-wrapper">
                                                                    <input type="text" class="input-text" name="streename" placeholder="House number and street name" value="" required>
                                                                </span>
                                                            </p>
                                                            <p class="form-row address-field form-row-wide">
                                                                <label>Apartment, suite, unit, etc. <span class="optional">(optional)</span></label>
                                                                <span class="input-wrapper">
                                                                    <input type="text" class="input-text" name="flatbldgnumber" placeholder="Apartment, suite, unit, etc. (optional)" value="">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label>Area <span class="required" title="required">*</span></label>
                                                                <span class="input-wrapper">
                                                                    <input type="text" class="input-text" name="area" value="" required>
                                                                </span>
                                                            </p>
                                                            <p class="form-row address-field validate-required form-row-wide">
                                                                <label>Town / City <span class="required" title="required">*</span></label>
                                                                <span class="input-wrapper">
                                                                    <input type="text" class="input-text" name="city" value="" required>
                                                                </span>
                                                            </p>
                                                            <p class="form-row address-field validate-required validate-state form-row-wide">
                                                                <label>State <span class="required" title="required">*</span></label>
                                                                <span class="input-wrapper">
                                                                    <select name="billing_state" class="state-select custom-select" required>
                                                                        <option value="">Select a state...</option>
                                                                        <?php
                                                                        foreach($indian_states as $code => $state) {
                                                                            echo "<option value=\"$code\">$state</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </span>
                                                            </p>
                                                            <p class="form-row address-field validate-required validate-postcode form-row-wide">
                                                                <label>Postcode / ZIP <span class="required" title="required">*</span></label>
                                                                <span class="input-wrapper">
                                                                    <input type="text" class="input-text" name="zipcode" pattern="[0-9]{6}" title="Please enter valid 6 digit pincode" required>
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-wide validate-required validate-phone">
                                                                <label>Phone <span class="required" title="required">*</span></label>
                                                                <span class="input-wrapper">
                                                                    <input type="tel" class="input-text" name="phone" pattern="[0-9]{10}" title="Please enter valid 10 digit mobile number" required>
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-wide validate-required validate-email">
                                                                <label>Email address <span class="required" title="required">*</span></label>
                                                                <span class="input-wrapper">
                                                                    <input type="email" class="input-text" name="email" required>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Order Summary Column -->
                                            <div class="col-xl-4 col-lg-5 col-md-12 col-12">
                                                <div class="checkout-review-order">
                                                    <div class="checkout-review-order-table">
                                                        <h3 class="review-order-title">Your Order</h3>
                                                        <?php 
                                                        $userid = $_SESSION['jsmsuid'];
                                                        $query = mysqli_query($con,"SELECT products.id, products.productName, products.shippingCharge, products.productDescription, products.productPrice, products.productImage1, orders.id as orderid, orders.UserId, orders.PId, orders.IsOrderPlaced FROM orders JOIN products ON products.id=orders.PId WHERE orders.UserId='$userid' AND orders.IsOrderPlaced IS NULL");
                                                        $totprice = 0;
                                                        $shippingtotal = 0;
                                                        $grandtotal = 0;
                                                        
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <div class="cart-items">
                                                            <div class="cart-item">
                                                                <div class="info-product">
                                                                    <div class="product-thumbnail">
                                                                        <img width="600" height="600" src="admin/productimages/<?php echo htmlspecialchars($row['productImage1']);?>" alt="<?php echo htmlspecialchars($row['productName']);?>">                    
                                                                    </div>
                                                                    <div class="product-name">
                                                                        <p><?php echo htmlspecialchars($row['productName']);?></p>
                                                                        <span class="product-quantity"><?php echo htmlspecialchars($row['productDescription']);?></span>                                            
                                                                    </div>
                                                                </div>
                                                                <div class="product-total">
                                                                    <span>₹<?php echo number_format($price = $row['productPrice'], 2);?></span>
                                                                </div>
                                                            </div>
                                                            <?php 
                                                            $totprice += $row['productPrice'];
                                                            $shippingtotal += $row['shippingCharge'];
                                                            $grandtotal += ($row['productPrice'] + $row['shippingCharge']);
                                                            ?>
                                                        <?php } ?>
                                                        </div>

                                                        <div class="cart-subtotal">
                                                            <h2>Subtotal</h2>
                                                            <div class="subtotal-price">
                                                                <span>₹<?php echo number_format($totprice, 2);?></span>
                                                            </div>
                                                        </div>

                                                        <div class="shipping-totals shipping">
                                                            <h2>Shipping</h2>
                                                            <div data-title="Shipping">
                                                                <span>₹<?php echo number_format($shippingtotal, 2);?></span>
                                                            </div>
                                                        </div>

                                                        <div class="order-total">
                                                            <h2>Total</h2>
                                                            <div class="total-price">
                                                                <strong>
                                                                    <span>₹<?php echo number_format($grandtotal, 2);?></span>
                                                                </strong> 
                                                            </div>
                                                        </div>

                                                        <!-- Payment Methods -->
                                                        <div class="payment-method-container">
                                                            <h4>Select Payment Method</h4>
                                                            
                                                            <!-- Razorpay Option -->
                                                            <div class="payment-option">
                                                                <label>
                                                                    <input type="radio" name="paymode" value="razorpay" required>
                                                                    <img src="assets/images/razorpay-logo.png" alt="Razorpay">
                                                                    Razorpay
                                                                </label>
                                                            </div>

                                                            <!-- Cash on Delivery Option -->
                                                            <div class="payment-option">
                                                                <label>
                                                                    <input type="radio" name="paymode" value="cod" required>
                                                                    <img src="assets/images/cod-logo.png" alt="Cash on Delivery">
                                                                    Cash on Delivery
                                                                </label>
                                                            </div>

                                                            <!-- Add more payment options as needed -->
                                                            <!-- Example: PayPal -->
                                                            <!--
                                                            <div class="payment-option">
                                                                <label>
                                                                    <input type="radio" name="paymode" value="paypal" required>
                                                                    <img src="assets/images/paypal-logo.png" alt="PayPal">
                                                                    PayPal
                                                                </label>
                                                            </div>
                                                            -->
                                                        </div>

                                                        <!-- Place Order Button -->
                                                        <div class="place-order-section">
                                                            <button type="submit" name="placeorder" class="place-order-btn">Place Order</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- .shop-checkout -->
                            </div> <!-- .section-container.p-l-r -->
                        </div> <!-- .section-padding -->
                    </div> <!-- #content.site-content -->
                </div> <!-- #primary.content-area -->
            </div> <!-- #main-content.main-content -->
        </div> <!-- #site-main.site-main -->

        <?php include_once('includes/footer.php'); ?>
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
<script src="libs/select2/js/select2.min.js"></script>

<!-- Site Scripts -->
<script src="assets/js/app.js"></script>
</body>
</html>
