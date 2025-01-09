<?php
session_start();
include_once('includes/config.php');

// Get error message if any
$error_message = isset($_GET['error']) ? urldecode($_GET['error']) : 'Unknown error occurred';
$order_number = isset($_GET['order']) ? $_GET['order'] : '';

// Map common Razorpay error codes to user-friendly messages
function getFriendlyErrorMessage($error) {
    $error = strtolower($error);
    
    if (strpos($error, 'signature') !== false) {
        return "Payment verification failed. Please try again.";
    }
    if (strpos($error, 'network') !== false) {
        return "Network error occurred. Please check your internet connection.";
    }
    if (strpos($error, 'cancelled') !== false) {
        return "Payment was cancelled. Please try again when you're ready.";
    }
    if (strpos($error, 'insufficient') !== false) {
        return "Payment failed due to insufficient funds.";
    }
    
    return "Payment could not be completed. Please try again or choose a different payment method.";
}

$friendly_message = getFriendlyErrorMessage($error_message);

// Log the error for debugging
error_log("Payment Failed - Order: $order_number, Error: $error_message");
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
    
    <title>Payment Failed - VJ Jewellers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        .failed-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .failed-icon {
            color: #dc3545;
            font-size: 48px;
            margin-bottom: 20px;
        }
        .error-message {
            color: #721c24;
            background-color: #f8d7da;
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
        .retry-btn {
            background-color: #528FF0;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }
        .contact-btn {
            background-color: #6c757d;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }
        .help-text {
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        .order-number {
            font-family: monospace;
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <div class="failed-container">
        <div class="failed-icon">✕</div>
        <h2>Payment Failed</h2>
        
        <?php if ($order_number): ?>
            <p>Order Number: <span class="order-number"><?php echo htmlspecialchars($order_number); ?></span></p>
        <?php endif; ?>

        <div class="error-message">
            <?php echo htmlspecialchars($friendly_message); ?>
        </div>

        <div class="action-buttons">
            <a href="razorpay-payment.php" class="retry-btn">Retry Payment</a>
            <a href="contact.php" class="contact-btn">Contact Support</a>
        </div>

        <p class="help-text">
            If you continue to face issues, please contact our support team with your order number 
            <?php if ($order_number): ?>
                (<?php echo htmlspecialchars($order_number); ?>)
            <?php endif; ?>
            for assistance.
        </p>

        <div style="margin-top: 20px;">
            <a href="my-orders.php" style="color: #528FF0; text-decoration: none;">
                View My Orders
            </a>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <script>
    // Automatically redirect to checkout page after 30 seconds
    setTimeout(function() {
        window.location.href = 'my-orders.php';
    }, 30000);

    // Track failed payments (optional - implement if you have analytics)
    function trackPaymentFailure(error, orderNumber) {
        // Add your analytics code here
        console.log('Payment failed:', {
            error: error,
            orderNumber: orderNumber,
            timestamp: new Date().toISOString()
        });
    }

    // Call tracking function
    trackPaymentFailure(
        <?php echo json_encode($error_message); ?>, 
        <?php echo json_encode($order_number); ?>
    );
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