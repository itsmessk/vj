<?php
// File: razorpay-payment.php

session_start();
include_once('includes/config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

// Redirect to checkout if necessary session variables are not set
if (!isset($_SESSION['jsmsuid']) || !isset($_SESSION['order_number'])) {
    header('Location: checkout.php');
    exit();
}

// Fetch order details
$userid = $_SESSION['jsmsuid'];
$orderno = $_SESSION['order_number'];

// Prepare and execute the query using prepared statements to prevent SQL injection
$stmt = $con->prepare("SELECT SUM(p.productPrice + p.shippingCharge) as total_amount 
                       FROM orders o 
                       JOIN products p ON p.id = o.PId 
                       WHERE o.UserId = ? AND o.OrderNumber = ?");
if ($stmt === false) {
    // Log and handle error appropriately
    error_log("Prepare failed: (" . $con->errno . ") " . $con->error);
    echo "An unexpected error occurred. Please try again later.";
    exit();
}

$stmt->bind_param("is", $userid, $orderno);
$stmt->execute();
$result = $stmt->get_result();
$order_details = $result->fetch_assoc();
$stmt->close();

if (!$order_details || $order_details['total_amount'] <= 0) {
    header('Location: checkout.php');
    exit();
}

// Initialize Razorpay
$api_key = 'rzp_test_8HfnRnkRrt36sk'; // Replace with your actual Razorpay API Key
$api_secret = 'CZB2YdoyERfFukIIMgFiav6T'; // Replace with your actual Razorpay API Secret

$api = new Api($api_key, $api_secret);

// Create Razorpay order
try {
    $orderData = [
        'amount' => $order_details['total_amount'] * 100, // Convert to paise
        'currency' => 'INR',
        'receipt' => 'order_' . $orderno,
        'notes' => [
            'user_id' => $userid,
            'order_number' => $orderno
        ]
    ];

    $razorpayOrder = $api->order->create($orderData);
    $razorpayOrderId = $razorpayOrder->id;

    // Store Razorpay order ID in database using prepared statements
    $updateStmt = $con->prepare("UPDATE orders SET RazorpayOrderId = ? WHERE OrderNumber = ?");
    if ($updateStmt === false) {
        error_log("Prepare failed: (" . $con->errno . ") " . $con->error);
        throw new Exception("Database update failed.");
    }
    $updateStmt->bind_param("si", $razorpayOrderId, $orderno);
    $updateStmt->execute();
    $updateStmt->close();

} catch (Exception $e) {
    // Log the error instead of displaying it to the user
    error_log("Razorpay Order Creation Error: " . $e->getMessage());
    echo "An error occurred while processing your payment. Please try again later.";
    exit();
}

// Fetch user details for prefill (ensure these session variables are set during login)
$userEmail = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '';
$userPhone = isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - VJ Jewellers</title>

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

    <!-- Enhanced Payment Stylesheet -->
    <style>
        /* General Styles */
        body {
            background-color: #f9f9f9;
            font-family: 'Lato', sans-serif;
            color: #333;
        }

        /* Payment Container */
        .payment-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 40px 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .payment-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .payment-container h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .payment-container p {
            font-size: 18px;
            margin: 10px 0;
        }

        .payment-container .order-details {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .payment-container .order-details p {
            margin: 8px 0;
        }

        .payment-container .order-details p strong {
            color: #2c3e50;
        }

        

        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-container {
                margin: 40px 20px;
                padding: 30px 20px;
            }

            .payment-container h2 {
                font-size: 24px;
            }

            .payment-container p {
                font-size: 16px;
            }

            
        }

        /* Loader Styles */
        .page-preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader {
            display: flex;
            gap: 10px;
        }

        .loader div {
            width: 15px;
            height: 15px;
            background-color: #528FF0;
            border-radius: 50%;
            animation: loader 0.6s infinite alternate;
        }

        .loader div:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loader div:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes loader {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0.3;
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    <div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    <div id="title" class="page-title">
                        <div class="section-container">
                            <div class="content-title-heading">
                                <h1 class="text-title-heading">Payment</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>Payment
                            </div>
                        </div>
                    </div>

    <div class="payment-container">
        <h2>Complete Your Payment</h2>
        <div class="order-details">
            <p><strong>Order Number:</strong> <?php echo htmlspecialchars($orderno); ?></p>
            <p><strong>Amount:</strong> ₹<?php echo number_format($order_details['total_amount'], 2); ?></p>
        </div>
        <div class="proceed-to-checkout">
        <button id="rzp-button" aria-label="Pay Now" class="checkout-button button">Click here to pay</button>
    </div>
    <style>
        button{
            background-color: black;
            color: white;
        }

        button:hover{
            background-color: goldenrod;
        }
    </style>
    </div>

    <!-- Loader (Optional) -->
    <div class="page-preloader">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Razorpay Checkout Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            key: "<?php echo $api_key; ?>", // Enter the Key ID generated from the Dashboard
            amount: <?php echo $orderData['amount']; ?>, // Amount is in currency subunits. Default currency is INR. Hence, 100 refers to 1 INR
            currency: "<?php echo $orderData['currency']; ?>",
            name: "VJ Jewellers",
            description: "Order #<?php echo htmlspecialchars($orderno); ?>",
            image: "assets/images/logo.png",
            order_id: "<?php echo $razorpayOrderId; ?>", // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            handler: function (response) {
                // Redirect to verify-payment.php with payment details
                window.location.href = "verify-payment.php?razorpay_payment_id=" + response.razorpay_payment_id + 
                                     "&razorpay_order_id=" + response.razorpay_order_id + 
                                     "&razorpay_signature=" + response.razorpay_signature;
            },
            prefill: {
                email: "<?php echo $userEmail; ?>",
                contact: "<?php echo $userPhone; ?>"
            },
            theme: {
                color: "#528FF0"
            }
        };
        var rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e){
            rzp.open();
            e.preventDefault();
        }

        // Optional: Hide loader after page loads
        window.onload = function() {
            document.querySelector('.page-preloader').style.display = 'none';
        };
    </script>

    <?php include_once('includes/footer.php'); ?>

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
