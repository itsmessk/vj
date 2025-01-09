<?php session_start();
include_once('includes/config.php');
error_reporting(0);

// For Adding categories
if(isset($_POST['submit'])){
    $oid = $_GET['orderid'];
    $ressta = $_POST['status'];
    $remark = $_POST['restremark'];
    
    $query = mysqli_query($con, "insert into tbltracking(OrderId,remark,status) value('$oid','$remark','$ressta')"); 
    $query = mysqli_query($con, "update tblorderaddresses set Status='$ressta',Remark='$remark' where Ordernumber='$oid'");
    if ($query) {
        echo '<script>alert("Order Has been updated.")</script>';
        echo "<script type='text/javascript'> document.location ='all-order.php'; </script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Jewellery Management System || View Orders</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php include_once('includes/header.php'); ?>
        <div id="layoutSidenav">
            <?php include_once('includes/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">View Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Orders</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <?php
                                $oid = $_GET['orderid'];
                                $ret = mysqli_query($con, "select * from tblorderaddresses join users on users.id = tblorderaddresses.UserId where tblorderaddresses.Ordernumber = '$oid'");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                    <table class="table table-bordered data-table">
                                        <tr align="center">
                                            <td colspan="4" style="font-size:20px;color:blue">
                                                User Details
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Order Number</th>
                                            <td><?php echo $row['Ordernumber']; ?></td>
                                            <th>First Name</th>
                                            <td><?php echo $row['FirstName']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td><?php echo $row['LastName']; ?></td>
                                            <th>Email</th>
                                            <td><?php echo $row['Email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile Number</th>
                                            <td><?php echo $row['MobileNumber']; ?></td>
                                            <th>Flat No./Building No.</th>
                                            <td><?php echo $row['Flatnobuldngno']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Street Name</th>
                                            <td><?php echo $row['StreetName']; ?></td>
                                            <th>Area</th>
                                            <td><?php echo $row['Area']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Landmark</th>
                                            <td><?php echo $row['Landmark']; ?></td>
                                            <th>City</th>
                                            <td><?php echo $row['City']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Order Final Status</th>
                                            <td>
                                                <?php  
                                                $orserstatus = $row['Status'];
                                                if($row['Status'] == "Order Confirmed") { echo "Order Confirmed"; }
                                                if($row['Status'] == "Pickup") { echo "Jewellery has been picked up"; }
                                                if($row['Status'] == "On The Way") { echo "Jewellery On The Way"; }
                                                if($row['Status'] == "Delivered") { echo "Jewellery Delivered"; }
                                                if($row['Status'] == "") { echo "Wait for shop approval"; }
                                                if($row['Status'] == "Order Cancelled") { echo "Order Cancelled"; }
                                                ?>
                                            </td>
                                            <th>Order Date</th>
                                            <td><?php echo $row['OrderTime']; ?></td>
                                        </tr>
                                    </table>

                                    <!-- Order Details -->
                                    <table class="table table-bordered data-table" style="text-align: center;">
                                        <tr align="center">
                                            <td colspan="7" style="font-size:20px;color:blue">
                                                Order Details
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Product ID</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Payment Method</th>
                                            <th>Price</th>
                                            <th>Shipping</th>
                                            <th>Total</th>
                                        </tr>

                                        <?php  
                                        $oid = $_GET['orderid'];
                                        $query = mysqli_query($con, "select products.id as id, products.productName, products.shippingCharge, products.productPrice, products.productImage1, orders.PaymentMethod from orders join products on products.id = orders.PId where orders.IsOrderPlaced='1' and orders.OrderNumber=$oid");
                                        $num = mysqli_num_rows($query);
                                        $cnt = 1;
                                        $grandtotal = 0;
                                        while ($row1 = mysqli_fetch_array($query)) { ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row1['id']; ?></td>
                                                <td><img src="productimages/<?php echo $row1['productImage1']; ?>" width="60" height="60" alt="<?php echo $row1['productName']; ?>"></td>
                                                <td><?php echo $row1['productName']; ?></td>
                                                <td><?php echo $row1['PaymentMethod']; ?></td>
                                                <td>₹<?php echo $price = $row1['productPrice']; ?></td>
                                                <td>₹<?php echo $shipping = $row1['shippingCharge']; ?></td>
                                                <td class="total">₹<?php echo $total = $price + $shipping; ?></td>
                                            </tr>
                                        <?php 
                                            $grandtotal += $total;
                                            $cnt++;
                                        } ?>

                                        <tr>
                                            <th colspan="7" style="text-align:center;color: red;">Grand Total</th>
                                            <td>₹<?php echo $grandtotal; ?></td>
                                        </tr>
                                    </table>

                                    <!-- Tracking History (if available) -->
                                    <?php  
                                    if($orserstatus != "") {
                                        $ret = mysqli_query($con, "select tbltracking.OrderCanclledByUser, tbltracking.remark, tbltracking.status as fstatus, tbltracking.StatusDate from tbltracking where tbltracking.OrderId ='$oid'");
                                        $cnt = 1;
                                        $cancelledby = $row['OrderCanclledByUser'];
                                    ?>
                                    <table class="table table-bordered">
                                        <tr align="center">
                                            <th colspan="4">Tracking History</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Time</th>
                                        </tr>
                                        <?php  
                                        while ($row = mysqli_fetch_array($ret)) { ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row['remark']; ?></td>
                                                <td><?php echo $row['fstatus']; ?> <?php echo ($cancelledby == 1) ? "(by user)" : "(by Shop)"; ?></td>
                                                <td><?php echo $row['StatusDate']; ?></td>
                                            </tr>
                                        <?php 
                                            $cnt++;
                                        } ?>
                                    </table>
                                    <?php } ?>
                                <?php } ?>
                                
                                <!-- Status Update Form -->
                                <?php if($orserstatus == "Order Confirmed" || $orserstatus == "Pickup" || $orserstatus == "On The Way" || $orserstatus == "") { ?>
                                <form name="submit" method="post">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Shop Remark :</th>
                                            <td colspan="6"><textarea name="restremark" rows="5" cols="14" class="form-control" required="true"></textarea></td>
                                        </tr>
                                        <tr>
                                            <th>Shop Status :</th>
                                            <td>
                                                <select name="status" class="form-control" required="true">
                                                    <?php if($orserstatus == ''): ?>
                                                        <option value="Order Confirmed" selected="true">Order Confirmed</option>
                                                        <option value="Order Cancelled">Order Cancelled</option>
                                                    <?php endif; ?>
                                                    <?php if($orserstatus == 'Order Confirmed'): ?>
                                                        <option value="Pickup">Pickup</option>
                                                        <option value="On The Way">On The Way</option>
                                                        <option value="Delivered">Delivered</option>
                                                    <?php endif; ?>
                                                    <?php if($orserstatus == 'Pickup'): ?>
                                                        <option value="On The Way">On The Way</option>
                                                        <option value="Delivered">Delivered</option>
                                                    <?php endif; ?>
                                                    <?php if($orserstatus == 'On The Way'): ?>
                                                        <option value="Delivered">Delivered</option>
                                                    <?php endif; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td></td>
                                            <td><button type="submit" name="submit" class="btn btn-primary">Update Order</button></td>
                                        </tr>
                                    </table>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
