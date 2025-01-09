<?php
session_start();
include_once('includes/config.php');

if (!isset($_GET['order'])) {
    header('location: my-orders.php');
    exit();
}

$orderno = $_GET['order'];

// Log successful payment
error_log("Payment Successful - Order: $orderno");
?>

<!DOCTYPE html>
<html>
<head>
    <!-- (Your existing head content remains unchanged) -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
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
    
    <title>Payment Success - VJ Jewellers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        .success-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .success-icon {
            color: #28a745;
            font-size: 48px;
            margin-bottom: 20px;
        }
        .success-message {
            color: #155724;
            background-color: #d4edda;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 16px;
        }
        .action-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .view-order-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }
        .continue-shopping-btn {
            background-color: #6c757d;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }
        .order-number {
            font-family: monospace;
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .help-text {
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <div class="success-container">
        <div class="success-icon">✓</div>
        <h2>Payment Successful!</h2>
        
        <p>Order Number: <span class="order-number"><?php echo htmlspecialchars($orderno); ?></span></p>

        <div class="success-message">
            Thank you for your purchase! Your order has been successfully placed and is being processed.
        </div>

        <div class="action-buttons">
            <a href="my-orders.php" class="view-order-btn">View Order</a>
            <a href="shop.php" class="continue-shopping-btn">Continue Shopping</a>
        </div>

        <p class="help-text">
            A confirmation email with your order details has been sent to your registered email address.
            Please keep your order number <span class="order-number"><?php echo htmlspecialchars($orderno); ?></span> for future reference.
        </p>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <script>
    // Automatically redirect to orders page after 30 seconds
    setTimeout(function() {
        window.location.href = 'my-orders.php';
    }, 30000);

    // Track successful payments (optional - implement if you have analytics)
    function trackPaymentSuccess(orderNumber) {
        // Add your analytics code here
        console.log('Payment successful:', {
            orderNumber: orderNumber,
            timestamp: new Date().toISOString()
        });
    }

    // Call tracking function
    trackPaymentSuccess(<?php echo json_encode($orderno); ?>);
    </script>
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