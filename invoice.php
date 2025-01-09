<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['jsmsuid'] == 0)) {
    header('location:logout.php');
} else { ?>
    <script language="javascript" type="text/javascript">
        function f2() {
            window.close();
        }
        function f3() {
            window.print();
        }
    </script>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Mobile Store Management System - Invoice</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f7fa;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 900px;
                margin: 50px auto;
                background-color: #fff;
                padding: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            h2 {
                text-align: center;
                color: #333;
            }

            .invoice-header {
                background-color: #0066cc;
                color: white;
                text-align: center;
                padding: 10px;
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
                color: #333;
            }

            td {
                background-color: #fafafa;
            }

            .total {
                font-weight: bold;
                color: #e60000;
            }

            .grand-total {
                font-weight: bold;
                color: #0066cc;
            }

            .button-group {
                text-align: center;
                margin-top: 20px;
            }

            .button-group input {
                background-color: #0066cc;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin: 5px;
                font-size: 16px;
            }

            .button-group input:hover {
                background-color: #004a99;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="invoice-header">
            <h2>Invoice of Order #<?php echo $_GET['oid']; ?></h2>
        </div>

        <?php
        $oid = $_GET['oid'];
        $query = mysqli_query($con, "SELECT products.id, products.productName, products.shippingCharge, products.productDescription, products.productPrice, products.productImage1, orders.id, orders.UserId, orders.PId, orders.IsOrderPlaced, orders.OrderNumber, orders.PaymentMethod FROM orders JOIN products ON products.id = orders.PId WHERE orders.IsOrderPlaced = '1' AND orders.OrderNumber = $oid AND orders.IsOrderPlaced = 1");
        $num = mysqli_num_rows($query);
        $cnt = 1;
        ?>

        <table>
            <tr>
                <th colspan="2">Order Date:</th>
                <td colspan="4"><?php echo $_GET['odate']; ?></td>
            </tr>
            <tr>
                <th>#</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Payment Method</th>
                <th>Price</th>
                <th>Shipping</th>
                <th>Total</th>
            </tr>

            <?php
            while ($row1 = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><img src="admin/productimages/<?php echo $row1['productImage1']; ?>" width="60" height="40" alt="<?php echo $row1['productName']; ?>"></td>
                    <td><?php echo $row1['productName']; ?></td>
                    <td><?php echo $row1['PaymentMethod']; ?></td>
                    <td>₹<?php echo $price = $row1['productPrice']; ?></td>
                    <?php
                    $totprice += $price;
                    ?>
                    <td>₹<?php echo $shipping = $row1['shippingCharge']; ?></td>
                    <?php
                    $shippingtotal += $shipping;
                    ?>
                    <td class="total">₹<?php echo $total = $price + $shipping; ?></td>
                    <?php
                    $grandtotal += $total;
                    $cnt++;
                    ?>
                </tr>
            <?php } ?>

            <tr>
                <th colspan="6" class="grand-total">Grand Total</th>
                <td>₹<?php echo $grandtotal; ?></td>
            </tr>
        </table>

        <div class="button-group">
            <input type="button" value="Close" onclick="return f2();" />
            <input type="button" value="Print" onclick="return f3();" />
        </div>
    </div>
    </body>
    </html>

<?php } ?>
