<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Handling Add to Cart
if(isset($_POST['submit'])) {
    $pid = $_POST['pid'];
    $userid = $_SESSION['jsmsuid'];
    $query = mysqli_query($con, "INSERT INTO orders(UserId, PId) VALUES('$userid', '$pid')");
    if($query) {
        echo "<script>alert('Jewellery has been added to the cart');</script>";
        echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}

// Handling Add to Wishlist
if(isset($_POST['wsubmit'])) {
    $wpid = $_POST['wpid'];
    $userid = $_SESSION['jsmsuid'];
    $query = mysqli_query($con, "INSERT INTO wishlist(UserId, ProductId) VALUES('$userid', '$wpid')");
    if($query) {
        echo "<script>alert('Jewellery has been added to the wishlist');</script>";
        echo "<script type='text/javascript'> document.location ='wishlist.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}

// Get subcategory from URL
$subcategory = isset($_GET['subcategory']) ? $_GET['subcategory'] : '';

// Sorting and Pagination logic
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'default';
$items_per_page = isset($_GET['items_per_page']) ? $_GET['items_per_page'] : 8;
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
$offset = ($page_no - 1) * $items_per_page;

// Build the ORDER BY clause
$order_by = '';
if ($sort_by == 'price_low_high') {
    $order_by = 'ORDER BY p.productPrice ASC';
} elseif ($sort_by == 'price_high_low') {
    $order_by = 'ORDER BY p.productPrice DESC';
} elseif ($sort_by == 'latest') {
    $order_by = 'ORDER BY p.created_at DESC';
} else {
    $order_by = 'ORDER BY p.id ASC';
}

// Base query for counting total records
$count_query = "SELECT COUNT(DISTINCT p.id) as total_records 
                FROM products p
                LEFT JOIN subcategory s ON p.subcategory = s.id
                LEFT JOIN category c ON s.categoryid = c.id
                LEFT JOIN type t ON c.type_id = t.id";

// Base query for fetching products
$product_query = "SELECT DISTINCT p.* 
                 FROM products p
                 LEFT JOIN subcategory s ON p.subcategory = s.id
                 LEFT JOIN category c ON s.categoryid = c.id
                 LEFT JOIN type t ON c.type_id = t.id";

// Add WHERE clause if subcategory is specified
if (!empty($subcategory)) {
    $where_clause = " WHERE s.subcategoryName = '" . mysqli_real_escape_string($con, $subcategory) . "'";
    $count_query .= $where_clause;
    $product_query .= $where_clause;
}

// Get total records for pagination
$result_count = mysqli_query($con, $count_query);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $items_per_page);

// Final query with pagination and sorting
$product_query .= " $order_by LIMIT $offset, $items_per_page";

// Execute the query
$ret = mysqli_query($con, $product_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products - VJ Jewellery</title>
    
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
    <style>
        /* Enhanced Product Card Styling */
        .products-entry {
            transition: all 0.3s ease;
            background: #fff;
            border: 1px solid #eee !important;
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 450px;
            margin-bottom: 25px;
        }

        .products-entry:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .product-thumb-hover {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
            border-radius: 12px 12px 0 0;
        }

        .product-thumb-hover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-thumb-hover:hover img.post-image {
            opacity: 0;
            transform: scale(1.1);
        }

        .product-thumb-hover:hover img.hover-image {
            opacity: 1;
            transform: scale(1.1);
        }

        .product-button {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            background: rgba(255,255,255,0.9);
            padding: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
            transition: bottom 0.3s ease;
        }

        .products-entry:hover .product-button {
            bottom: 0;
        }

        .product-btn {
            padding: 8px 15px;
            border-radius: 25px;
            border: none;
            background: #333;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .product-btn:hover {
            background: #000;
            transform: translateY(-2px);
        }

        .products-content {
            padding: 15px;
        }

        .product-title {
            margin: 10px 0;
            font-size: 1.1em;
            font-weight: 600;
        }

        .product-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .product-title a:hover {
            color: #000;
        }

        .price {
            font-size: 1.2em;
            font-weight: 700;
            color: #2c3e50;
            margin: 10px 0;
        }

        /* Enhanced Pagination Styling */
        .pagination {
            margin: 30px 0;
            display: flex;
            justify-content: center;
        }

        .page-numbers {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 5px;
        }

        .page-numbers li a,
        .page-numbers li span {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-numbers li a:hover {
            background: #f5f5f5;
            border-color: #333;
        }

        .page-numbers li span.current {
            background: #333;
            color: #fff;
            border-color: #333;
        }

        /* Enhanced Sorting Controls */
        .products-topbar {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .products-sort .sort-toggle {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .sort-list {
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .sort-list li a {
            padding: 8px 15px;
            color: #333;
            transition: all 0.3s ease;
        }

        .sort-list li a:hover {
            background: #f5f5f5;
        }

        /* Price Format Animation */
        @keyframes pricePopup {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .price {
            animation: pricePopup 0.3s ease;
        }
    </style>
    <style>
        .product-thumb-hover {
            position: relative;
            width: 300px;
            height: 300px;
            overflow: hidden;
        }

        .product-thumb-hover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-thumb-hover .post-image {
            transition: opacity 0.3s ease;
        }

        .product-thumb-hover .hover-image {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-thumb-hover:hover .post-image {
            opacity: 0;
        }

        .product-thumb-hover:hover .hover-image {
            opacity: 1;
        }
    </style>
</head>

<body class="shop">
    <div id="page" class="hfeed page-wrapper">
        <?php include_once('includes/header.php');?>

        <div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    <div id="title" class="page-title">
                        <div class="section-container">
                            <div class="content-title-heading">
                                <h1 class="text-title-heading">
                                    Products
                                </h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a>
                                <span class="delimiter"></span>
                                <a href="products.php">Products</a>
                              
                            </div>
                        </div>
                    </div>

                    <div id="content" class="site-content" role="main">
                        <div class="section-padding">
                            <div class="section-container p-l-r">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                        <div class="products-topbar clearfix">
                                            <div class="products-topbar-left">
                                                <div class="products-count">
                                                    <?php
                                                    $start_item = ($page_no - 1) * $items_per_page + 1;
                                                    $end_item = min($page_no * $items_per_page, $total_records);
                                                    echo "Showing $start_item to $end_item of $total_records results";
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="products-topbar-right">
                                                <div class="products-sort dropdown">
                                                    <span class="sort-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                        <?php echo ucfirst(str_replace('_', ' ', $sort_by)); ?>
                                                    </span>
                                                    <ul class="sort-list dropdown-menu" x-placement="bottom-start">
                                                        <li><a href="?sort_by=default&items_per_page=<?php echo $items_per_page; ?><?php echo !empty($subcategory) ? '&subcategory='.urlencode($subcategory) : ''; ?>">Default sorting</a></li>
                                                        <li><a href="?sort_by=latest&items_per_page=<?php echo $items_per_page; ?><?php echo !empty($subcategory) ? '&subcategory='.urlencode($subcategory) : ''; ?>">Sort by latest</a></li>
                                                        <li><a href="?sort_by=price_low_high&items_per_page=<?php echo $items_per_page; ?><?php echo !empty($subcategory) ? '&subcategory='.urlencode($subcategory) : ''; ?>">Sort by price: low to high</a></li>
                                                        <li><a href="?sort_by=price_high_low&items_per_page=<?php echo $items_per_page; ?><?php echo !empty($subcategory) ? '&subcategory='.urlencode($subcategory) : ''; ?>">Sort by price: high to low</a></li>
                                                    </ul>
                                                </div>

                                                <div class="items-per-page">
                                                    <form method="get" action="">
                                                        <?php if (!empty($subcategory)) : ?>
                                                            <input type="hidden" name="subcategory" value="<?php echo htmlspecialchars($subcategory); ?>">
                                                        <?php endif; ?>
                                                        <label for="items_per_page">Items per page:</label>
                                                        <select name="items_per_page" id="items_per_page" onchange="this.form.submit()">
                                                            <option value="8" <?php echo ($items_per_page == 8) ? 'selected' : ''; ?>>8</option>
                                                            <option value="16" <?php echo ($items_per_page == 16) ? 'selected' : ''; ?>>16</option>
                                                            <option value="24" <?php echo ($items_per_page == 24) ? 'selected' : ''; ?>>24</option>
                                                            <option value="36" <?php echo ($items_per_page == 36) ? 'selected' : ''; ?>>36</option>
                                                            <option value="48" <?php echo ($items_per_page == 48) ? 'selected' : ''; ?>>48</option>
                                                        </select>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="layout-grid" role="tabpanel">
                                                <div class="products-list grid">
                                                    <div class="row">
                                                        <?php
                                                        while ($row = mysqli_fetch_array($ret)) {
                                                        ?>
                                                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                                            <div class="products-entry clearfix product-wapper" style="border: 1px solid gray; border-radius: 10px; padding: 10px; height: 420px;">
                                                                <div class="products-thumb">
                                                                    <div class="product-thumb-hover">
                                                                        <a href="single-product.php?pid=<?php echo $row['id'];?>">
                                                                            <img width="600" height="600" style="border-radius:10px" src="admin/productimages/<?php echo $row['productImage1'];?>" class="post-image" alt="">
                                                                            <img width="600" height="600" style="border-radius:10px" src="admin/productimages/<?php echo $row['productImage2'];?>" class="hover-image back" alt="">
                                                                        </a>
                                                                    </div>

                                                                    <div class="product-button">
                                                                        <div class="btn-add-to-cart" data-title="Add to cart">
                                                                            <?php if ($_SESSION['jsmsuid'] == "") { ?>
                                                                                <a href="login.php" class="product-btn button">Add to cart</a>
                                                                            <?php } else { ?>
                                                                                <form method="post">
                                                                                    <input type="hidden" name="pid" value="<?php echo $row['id']; ?>">
                                                                                    <button type="submit" name="submit" class="product-btn button">Add to cart</button>
                                                                                </form>
                                                                            <?php } ?>
                                                                        </div>

                                                                        <div class="" data-title="Wishlist">
                                                                            <?php if ($_SESSION['jsmsuid'] == "") { ?>
                                                                                <a href="login.php" class="product-btn">Add to wishlist</a>
                                                                            <?php } else { ?>
                                                                                <form method="post">
                                                                                    <input type="hidden" name="wpid" value="<?php echo $row['id']; ?>">
                                                                                    <button type="submit" name="wsubmit" class="product-btn">Add to wishlist</button>
                                                                                </form>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="products-content">
                                                                    <div class="contents text-center">
                                                                        <h3 class="product-title">
                                                                            <a href="single-product.php?pid=<?php echo $row['id'];?>"><?php echo $row['productName'];?></a>
                                                                        </h3>
                                                                        <p class="price">₹<?php echo number_format($row['productPrice'], 2);?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <nav class="pagination" >
    <ul class="page-numbers">
        <!-- Previous Button -->
        <li>
            <a class="prev page-numbers" <?php if($page_no <= 1) { echo 'class="disabled"'; } ?>
            href="<?php if($page_no > 1) { 
                echo '?page_no='.$previous_page.'&items_per_page='.$total_records_per_page.'&sort_by='.urlencode($sort_by);
            } ?>">Previous</a>
        </li>

        <!-- Page Numbers -->
        <?php
        if ($total_no_of_pages <= 10) {
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                if ($counter == $page_no) {
                    echo "<li><span class='page-numbers current'>$counter</span></li>";
                } else {
                    echo "<li><a class='page-numbers' href='?page_no=$counter&items_per_page=".urlencode($total_records_per_page)."&sort_by=".urlencode($sort_by)."'>$counter</a></li>";
                }
            }
        }
        ?>

        <!-- Next Button -->
        <li>
            <a class="next page-numbers" <?php if ($page_no >= $total_no_of_pages) { echo 'class="disabled"'; } ?>
            href="<?php if ($page_no < $total_no_of_pages) { 
                echo '?page_no='.$next_page.'&items_per_page='.$total_records_per_page.'&sort_by='.urlencode($sort_by);
            } ?>">Next</a>
        </li>
    </ul>
</nav>



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
</body>
</html>
