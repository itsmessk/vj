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
	<title>Jewellery Shop Management System || My Orders</title>
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
                                <h1 class="text-title-heading">My Orders</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>My orders
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
				<div class="cart-table" >
					<table style="color: black; text-align: center;">
						<tr style="color: black; text-align: center;">
                                    <th>Sl.No</th>
                                <th>Order ID</th>
                                <th>Order Date and Time</th>
                                <th>Order Status</th>
                                <th>Track Order</th>
                                <th>View Details</th>
                                </tr>
					<tr>
                                    <?php
									$userid= $_SESSION['jsmsuid'];
									$query=mysqli_query($con,"select * from  tblorderaddresses  where UserId='$userid'");
									$cnt=1;
												while($row=mysqli_fetch_array($query))
												{ ?>
												<tr>
									<td style="color: black; text-align: center;"><?php echo $cnt;?></td>
									<td style="color: black;  text-align: center;"><?php echo $row['Ordernumber'];?></td>
									<td style="color: black;  text-align: center;"><p><b>Order Date :</b> <?php echo $row['OrderTime']?></p></td>  
									<td style="color: black; "><?php $status=$row['Status'];
									if($status==''){
									echo "Waiting for confirmation";   
									} else{
									echo $status;
									}

																						?>  </td>   
									<td style="color: black;  text-align: center;"><li class="list-inline-item"><i class="fa fa-motorcycle"></i> 
									<?php    

									$link = "http"; 
									$link .= "://"; 
									$link .= $_SERVER['HTTP_HOST']; 
									?>
 <a  href="javascript:void(0);" onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['Ordernumber']);?>');" title="Track order">Track Order</a></li></td>
<td style="color: black;  text-align: center;"><a href="order-detail.php?orderid=<?php echo $row['Ordernumber'];?>" class="btn btn--box btn--small btn--blue btn--uppercase btn--weight">View Details</a></td>       
</tr><?php $cnt++; } ?>
					</table>
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
