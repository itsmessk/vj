<?php 
session_start();
include_once('includes/config.php');

if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
} else {
    // For Adding Products
    if (isset($_POST['submit'])) {
        $type = $_POST['type']; // Type first
        $category = $_POST['category']; // Category second
        $subcat = $_POST['subcategory']; // Subcategory third
        $productname = $_POST['productName'];
        $productweight = $_POST['productweight'];
        $productprice = $_POST['productprice'];
        $productdescription = $_POST['productDescription'];
        $productscharge = $_POST['productShippingcharge'];
        $productavailability = $_POST['productAvailability'];
        $gender = $_POST['gender'];
        $productimage1 = $_FILES["productimage1"]["name"];
        $productimage2 = $_FILES["productimage2"]["name"];
        $productimage3 = $_FILES["productimage3"]["name"];

        $extension1 = substr($productimage1, strlen($productimage1) - 4, strlen($productimage1));
        $extension2 = substr($productimage2, strlen($productimage2) - 4, strlen($productimage2));
        $extension3 = substr($productimage3, strlen($productimage3) - 4, strlen($productimage3));

        // Renaming the image files
        $imgnewfile1 = md5($productimage1.time()).$extension1;
        $imgnewfile2 = md5($productimage2.time()).$extension2;
        $imgnewfile3 = md5($productimage3.time()).$extension3;
        $addedby = $_SESSION['aid'];

        // Move the uploaded files
        move_uploaded_file($_FILES["productimage1"]["tmp_name"], "productimages/" . $imgnewfile1);
        move_uploaded_file($_FILES["productimage2"]["tmp_name"], "productimages/" . $imgnewfile2);
        move_uploaded_file($_FILES["productimage3"]["tmp_name"], "productimages/" . $imgnewfile3);

        // Insert the product data into the database
        $sql = mysqli_query($con, "INSERT INTO products(type, category, subCategory, productName, productweight, productPrice, productDescription, shippingCharge, productAvailability, productImage1, productImage2, productImage3, gender, addedBy) 
        VALUES('$type', '$category', '$subcat', '$productname', '$productweight', '$productprice', '$productdescription', '$productscharge', '$productavailability', '$imgnewfile1', '$imgnewfile2', '$imgnewfile3', '$gender', '$addedby')");
        
        echo "<script>alert('Product Added successfully');</script>";
        echo "<script>window.location.href='manage-products.php'</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jewellery Management System || Add Product</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
        // Fetching subcategories based on the category selected
        function getSubcat(val) {
            $.ajax({
                type: "POST",
                url: "get_subcat.php",
                data: 'cat_id=' + val,
                success: function(data) {
                    $("#subcategory").html(data);
                }
            });
        }

        // Fetching types dynamically from the database
        function getTypes() {
            $.ajax({
                type: "POST",
                url: "get_types.php",
                success: function(data) {
                    $("#type").html(data);
                }
            });
        }

        $(document).ready(function() {
            // Load types when the page loads
            getTypes();
        });
    </script>
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Product</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
    <!-- Type Dropdown -->
    <!-- Type Dropdown -->
<div class="row">
    <div class="col-2">Type</div>
    <div class="col-4">
        <select name="type" id="type" class="form-control" required>
            <option value="">Choose Type</option>
            
            <!-- Types will be loaded here dynamically -->
        </select>
    </div>
</div>

<!-- Category Dropdown -->
<div class="row" style="margin-top:1%;">
    <div class="col-2">Category Name</div>
    <div class="col-4">
        <select name="category" id="category" class="form-control" onChange="getSubcat(this.value);" required>
            <option value="">Select Category</option>
            <!-- Categories will be loaded here based on selected type -->
        </select>
    </div>
</div>

<!-- Subcategory Dropdown -->
<div class="row" style="margin-top:1%;">
    <div class="col-2">Sub Category name</div>
    <div class="col-4">
        <select name="subcategory" id="subcategory" class="form-control" required>
            <!-- Subcategories will be loaded here based on selected category -->
        </select>
    </div>
</div>

    <!-- Product Name and Other Inputs -->
    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Name</div>
        <div class="col-4">
            <input type="text" name="productName" placeholder="Enter Product Name" class="form-control" required>
        </div>
    </div>

    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Weight</div>
        <div class="col-4">
            <input type="text" name="productweight" placeholder="Enter Product Weight" class="form-control" required>
        </div>
    </div>

    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Price</div>
        <div class="col-4">
            <input type="text" name="productprice" placeholder="Enter Product Price" class="form-control" required>
        </div>
    </div>

    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Description</div>
        <div class="col-4">
            <textarea name="productDescription" class="form-control" placeholder="Enter Product Description" required></textarea>
        </div>
    </div>

    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Shipping Charge</div>
        <div class="col-4">
            <input type="text" name="productShippingcharge" placeholder="Enter Shipping Charge" class="form-control" required>
        </div>
    </div>

    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Availability</div>
        <div class="col-4">
            <select name="productAvailability" id="productAvailability" class="form-control" required>
                <option value="">Select</option>
                <option value="In Stock">In Stock</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>
        </div>
    </div>

    <!-- File Inputs for Images -->
    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Image 1</div>
        <div class="col-4">
            <input type="file" name="productimage1" class="form-control" required>
        </div>
    </div>

    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Image 2</div>
        <div class="col-4">
            <input type="file" name="productimage2" class="form-control" required>
        </div>
    </div>

    <div class="row" style="margin-top:1%;">
        <div class="col-2">Product Image 3</div>
        <div class="col-4">
            <input type="file" name="productimage3" class="form-control" required>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
// Fetching types dynamically when the page loads
function getTypes() {
    $.ajax({
        type: "POST",
        url: "get_types.php", // Fetch types
        success: function(data) {
            $("#type").html(data); // Populate types dropdown
        }
    });
}

// Fetching categories based on the selected type
function getCategoriesByType(val) {
    $.ajax({
        type: "POST",
        url: "get_categories_by_type.php", // Fetch categories based on the type
        data: { type_id: val },
        success: function(data) {
            $("#category").html(data); // Populate category dropdown
            $("#subcategory").html("<option value=''>Select Subcategory</option>"); // Clear subcategory dropdown
        }
    });
}

// Fetching subcategories based on the selected category
function getSubcat(val) {
    $.ajax({
        type: "POST",
        url: "get_subcat.php", // Fetch subcategories
        data: { cat_id: val },
        success: function(data) {
            $("#subcategory").html(data); // Populate subcategory dropdown
        }
    });
}

$(document).ready(function() {
    // Load types when the page loads
    getTypes();

    // When the type is selected, fetch related categories
    $("#type").change(function() {
        var type_id = $(this).val();
        if (type_id) {
            getCategoriesByType(type_id);
        } else {
            $("#category").html("<option value=''>Select Category</option>");
            $("#subcategory").html("<option value=''>Select Subcategory</option>");
        }
    });
});

    </script>

</body>
</html>

