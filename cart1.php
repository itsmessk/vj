<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('includes/config.php');

// Check if user is logged in
if (strlen($_SESSION['jsmsuid'] == 0)) {
    header('location:logout.php');
    exit();
} 

// Handle item deletion
if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    // Sanitize the input
    $rid = mysqli_real_escape_string($con, $rid);
    
    // First verify if the order belongs to the current user
    $userid = $_SESSION['jsmsuid'];
    $verifyQuery = mysqli_query($con, "SELECT id FROM orders WHERE id='$rid' AND UserId='$userid' AND IsOrderPlaced IS NULL");
    
    if (mysqli_num_rows($verifyQuery) > 0) {
        $query = mysqli_query($con, "DELETE FROM orders WHERE id='$rid'");
        if ($query) {
            echo "<script>alert('Item removed from cart successfully');</script>";
        } else {
            echo "<script>alert('Error removing item. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid request');</script>";
    }
    echo "<script>window.location.href = 'cart.php';</script>";
    exit();
}

// Handle quantity updates
if (isset($_POST['update_quantity'])) {
    $orderId = intval($_POST['order_id']);
    $quantity = intval($_POST['quantity']);
    $userid = $_SESSION['jsmsuid'];
    
    // Verify ownership and update quantity
    $updateQuery = mysqli_query($con, "UPDATE orders SET Quantity='$quantity' 
                                     WHERE id='$orderId' AND UserId='$userid' 
                                     AND IsOrderPlaced IS NULL");
    
    if ($updateQuery) {
        echo "<script>alert('Quantity updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating quantity');</script>";
    }
    echo "<script>window.location.href = 'cart.php';</script>";
    exit();
}

// Function to check if product exists in cart
function isProductInCart($con, $userId, $productId) {
    $query = mysqli_query($con, "SELECT id FROM orders 
                                WHERE UserId='$userId' 
                                AND PId='$productId' 
                                AND IsOrderPlaced IS NULL");
    return mysqli_num_rows($query) > 0;
}

// Handle adding items to cart
if (isset($_POST['add_to_cart'])) {
    $userid = $_SESSION['jsmsuid'];
    $pid = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
    // Check if product already exists in cart
    if (isProductInCart($con, $userid, $pid)) {
        echo "<script>alert('This product is already in your cart!');</script>";
    } else {
        $query = mysqli_query($con, "INSERT INTO orders (UserId, PId, Quantity) 
                                   VALUES ('$userid', '$pid', '$quantity')");
        if ($query) {
            echo "<script>alert('Product added to cart successfully');</script>";
        } else {
            echo "<script>alert('Error adding product to cart');</script>";
        }
    }
    echo "<script>window.location.href = 'cart.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- [Previous head content remains the same] -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart - VJ Jewellery</title>
    
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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
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
                                <h1 class="text-title-heading">Shopping Cart</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>Shopping Cart
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
                                                                <th class="product-price">Shipping</th>
                                                                <th class="product-subtotal">Total</th>
                                                                <th class="product-remove">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $userid = $_SESSION['jsmsuid'];
                                                            $query = mysqli_query($con, "SELECT products.id, products.productName, 
                                                                                              products.shippingCharge, products.productPrice, 
                                                                                              products.productImage1, orders.id as orderId,
                                                                                              orders.Quantity 
                                                                                       FROM orders 
                                                                                       JOIN products ON products.id=orders.PId 
                                                                                       WHERE orders.UserId='$userid' 
                                                                                       AND orders.IsOrderPlaced IS NULL");
                                                            
                                                            if (!$query) {
                                                                echo "<tr><td colspan='6'>Error fetching cart items: " . mysqli_error($con) . "</td></tr>";
                                                            } else {
                                                                $num = mysqli_num_rows($query);
                                                                if ($num > 0) {
                                                                    $grandtotal = 0;
                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                        $quantity = $row['Quantity'];
                                                                        $subtotal = $row['productPrice'] * $quantity;
                                                                        $total = $subtotal + $row['shippingCharge'];
                                                                        $grandtotal += $total;
                                                            ?>
                                                            <tr class="cart-item">
                                                                <td class="product-thumbnail">
                                                                    <a href="shop-details.php?id=<?php echo htmlspecialchars($row['id']); ?>">
                                                                        <img src="admin/productimages/<?php echo htmlspecialchars($row['productImage1']); ?>" 
                                                                             class="product-image" 
                                                                             alt="<?php echo htmlspecialchars($row['productName']); ?>">
                                                                    </a>
                                                                    <div class="product-name">
                                                                        <a href="shop-details.php?id=<?php echo htmlspecialchars($row['id']); ?>">
                                                                            <?php echo htmlspecialchars($row['productName']); ?>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td class="product-price">₹<?php echo number_format($row['productPrice'], 2); ?></td>
                                                                <td class="product-quantity">
                                                                    <form method="post" action="">
                                                                        <input type="hidden" name="order_id" value="<?php echo $row['orderId']; ?>">
                                                                        <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="10">
                                                                        <button type="submit" name="update_quantity" class="btn btn-sm btn-primary">Update</button>
                                                                    </form>
                                                                </td>
                                                                <td class="product-price">₹<?php echo number_format($row['shippingCharge'], 2); ?></td>
                                                                <td class="product-subtotal">₹<?php echo number_format($total, 2); ?></td>
                                                                <td class="product-remove">
                                                                    <a href="javascript:void(0);" 
                                                                       onclick="removeItem(<?php echo $row['orderId']; ?>);" 
                                                                       class="remove">×</a>
                                                                </td>
                                                            </tr>
                                                            <?php 
                                                                    }
                                                                } else { 
                                                            ?>
                                                            <tr>
                                                                <td colspan="6" class="text-center">Your cart is currently empty.</td>
                                                            </tr>
                                                            <?php 
                                                                }
                                                            } 
                                                            ?>
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
                                                        <div class="title">Total</div>
                                                        <div><span>₹<?php echo isset($grandtotal) ? number_format($grandtotal, 2) : '0.00'; ?></span></div>
                                                    </div>
                                                </div>
                                                <?php if (isset($num) && $num > 0) { ?>
                                                <div class="proceed-to-checkout">        
                                                    <a href="checkout.php" class="checkout-button button">Proceed to checkout</a>
                                                </div>
                                                <?php } ?>
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

        <?php include_once('includes/footer.php'); ?>
    </div>

    <!-- [Previous scripts section remains the same] -->
    
    <!-- Custom Script for Cart Functionality -->
      <!-- Dependency Scripts -->
    <script src="libs/jquery/js/jquery.min.js"></script>
    <script src="libs/popper/js/popper.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="libs/slick/js/slick.min.js"></script>
    <script src="libs/mmenu/js/jquery.mmenu.all.min.js"></script>
    <script src="libs/slider/js/tmpl.js"></script>
    <script src="libs/slider/js/jquery.dependClass-0.1.js"></script>
    <script src="libs/slider/js/draggable-0.1.js"></script>
    <script src="libs/slider/js/jquery.slider.js"></script>
    
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
    <script>
    function removeItem(orderId) {
        if (confirm('Do you really want to remove this product?')) {
            window.location.href = 'cart.php?delid=' + orderId;
        }
    }
    </script>
</body>
</html>