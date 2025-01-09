
<?php
session_start();
include_once('includes/config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

if (!isset($_SESSION['jsmsuid']) || !isset($_SESSION['order_number'])) {
    header('location: checkout.php');
    exit();
}

$api_key = 'rzp_test_8HfnRnkRrt36sk';
$api_secret = 'CZB2YdoyERfFukIIMgFiav6T';
$api = new Api($api_key, $api_secret);

try {
    // Verify signature
    $attributes = [
        'razorpay_payment_id' => $_GET['razorpay_payment_id'],
        'razorpay_order_id' => $_GET['razorpay_order_id'],
        'razorpay_signature' => $_GET['razorpay_signature']
    ];
    
    $api->utility->verifyPaymentSignature($attributes);
    
    // Payment successful, update order status
    $orderno = $_SESSION['order_number'];
    $payment_id = $_GET['razorpay_payment_id'];
    
    $updateQuery = "UPDATE orders SET 
                   PaymentStatus = 'Completed',
                   RazorpayPaymentId = '$payment_id'
                   WHERE OrderNumber = '$orderno'";
    
    mysqli_query($con, $updateQuery);
    
    // Clear session order data
    unset($_SESSION['order_number']);
    
    // Redirect to success page
    header('location: payment-success.php?order=' . $orderno);
    
} catch (Exception $e) {
    // Payment verification failed
    header('location: payment-failed.php?error=' . urlencode($e->getMessage()));
}
?>