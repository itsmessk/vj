<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['jsmsuid']==0)) {
  header('location:logout.php');
  } else{ 

    ?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Jewellery Shop Management System || Order Detail</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
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
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap" rel="stylesheet">
	<!--[if lt IE 9]>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
</head>
<body>

	<?php include_once('includes/header.php');?>
	<div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    <div id="title" class="page-title">
                        <div class="section-container">
                            <div class="content-title-heading">
                                <h1 class="text-title-heading">Order Details</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>Order details
                            </div>
                        </div>
                    </div>
					
	<!-- / body -->

	<div id="body">
		
		<div class="container">
		<nav>
		<a href="profile.php"><button class="btn" style="background-color: goldenrod; color: white;">My Account</button></a>

						<a href="my-orders.php"><button class="btn" style="background-color: goldenrod; color: white;">My orders</button></a>
						<a href="change-password.php"><button class="btn" style="background-color: goldenrod; color: white;">Change password</button></a>

					</nav><br>
			<div id="content" class="full">
				<div class="cart-table">
					<p style="color:#000"><b>Order Number : </b><?php echo $oid=$_GET['orderid'];?></p>


    <?php
//Getting Url
$link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 

// Getting order Details
$userid= $_SESSION['jsmsuid'];
$ret=mysqli_query($con,"select OrderTime,Status from tblorderaddresses where UserId='$userid' and Ordernumber='$oid'");
while($result=mysqli_fetch_array($ret)) {
?>

<p style="color:#000"><b>Order Date : </b><?php echo $od=$result['OrderTime'];?></p>
<p style="color:#000"><b>Order Status :</b> <?php if($result['Status']==""){
    echo "Not Accpet Yet";
} else {
echo $result['Status'];
}?> &nbsp;&nbsp;&nbsp;

<button><a href="javascript:void(0);" onClick="popUpWindow('track-order.php?oid=<?php echo $oid;?>');" title="Track order" class="btn" style="background-color: goldenrod; color: white; ">TRACK MY ORDER</a></button></p>

<?php } ?>
<!-- Invoice -->
<p><button><a href="javascript:void(0);" onClick="popUpWindow('invoice.php?oid=<?php echo $oid;?>&&odate=<?php echo $od;?>');" title="Order Invoice" class="btn" style="background-color: goldenrod; color: white;">INVOICE</a></button></p>
 <br>
					<table style="color:black; text-align: center">
						<tr>
							<th>Order ID</th>
							<th class="items">Items</th>
							<th class="price" style="color:black;">Price</th>
							<th class="total">Shipping</th>
							<th class="qnt">Quantity</th>
							<th class="total">Total</th>
							<th>Payment Method</th>
						</tr>
						<?php 
$userid= $_SESSION['jsmsuid'];
$query=mysqli_query($con,"select products.id,products.productName,products.shippingCharge,products.productDescription,products.productPrice,products.productImage1,orders.id,orders.UserId,orders.PId,orders.IsOrderPlaced,orders.OrderNumber,orders.PaymentMethod from orders join products on products.id=orders.PId where orders.UserId='$userid' and orders.OrderNumber=$oid");
$num=mysqli_num_rows($query);
if($num>0){
while ($row=mysqli_fetch_array($query)) {
 

?>
						<tr>
							<td><?php echo $row['OrderNumber'];?></td>
							<td class="items">
								
								<?php  echo $row['productName'];?>
							</td>
							<td class="price" style="color:black;">₹<?php  echo $price=$row['productPrice'];?></td>
							<?php 
$totprice+=$price;
$cnt=$cnt+1; 
                           
 ?>
							<td class="price" style="color:black;">₹<?php  echo $shipping=$row['shippingCharge'];?></td>
							<?php 
$shippingtotal+=$shipping;
$cnt=$cnt+1; 
                           
 ?>
							<td class="qnt">1</td>
							<td class="total">₹<?php  echo $total=$price+$shipping;?></td>
							
							<?php 
$grandtotal+=$total;
$cnt=$cnt+1; 
                           
 ?>
							<td class="price" style="color:black;"><?php  echo $row['PaymentMethod'];?></td>
			
						</tr><?php $cnt++; } }?>
					</table>
				</div>

				<div class="total-count">
					<h3></b>Subtotal:</b> ₹<?php  echo $totprice;?> + ₹<?php  echo $shippingtotal;?></h3>
					<h3></b>Total:</b> <strong>₹<?php echo $grandtotal;?></strong></h3><br>
					<p>For the order cancellation contact admin</p>
				</div>
		
			</div>
			<!-- / content -->
		</div>
		<!-- / container -->
	</div>
	<!-- / body -->

	<?php include_once('includes/footer.php');?>


	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script>window.jQuery || document.write("<script src='js/jquery-1.11.1.min.js'>\x3C/script>")</script>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>
</body>
</html><?php } ?>
