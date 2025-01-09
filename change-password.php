<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['jsmsuid']==0)) {
  header('location:logout.php');
  } else{ 
if(isset($_POST['change']))
{
$userid=$_SESSION['jsmsuid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query1=mysqli_query($con,"select id from users where id='$userid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query1);
if($row>0){
$ret=mysqli_query($con,"update users set Password='$newpassword' where id='$userid'");

echo '<script>alert("Your password successully changed.")</script>';
} else {
echo '<script>alert("Your current password is wrong.")</script>';

}

}  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Jewellery Shop Management System || User Profile</title>
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
	<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
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
                                <h1 class="text-title-heading">Change password</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>Change password
                            </div>
                        </div>
                    </div>
	<!-- / body -->

	<div id="body" style="color: black;">
		<div class="container">
		<nav>
		<a href="profile.php"><button class="btn" style="background-color: goldenrod; color: white;">My Account</button></a>

						<a href="my-orders.php"><button class="btn" style="background-color: goldenrod; color: white;">My orders</button></a>
						<a href="change-password.php"><button class="btn" style="background-color: goldenrod; color: white;">Change password</button></a>

					</nav><br>
			<div id="content" class="full">
				<div class="cart-table">
					 <form action="#" method="post">
					 	
                                   	      <label> Current Password</label>
                                          <input type="text" name="currentpassword" required="true" class="form-control" placeholder="Current Password">
                                            <br>
                                          	<label> New Password</label>
                                          <input type="text" name="newpassword" required="true" class="form-control" placeholder="New Password">
                                           <br>
                                          	<label> Confirm Password</label>
                                          <input type="text" name="confirmpassword" required="true" class="form-control" placeholder="Confirm Password">
                                          <br>
                                          <button class="btn" style="background-color: goldenrod; color: white;" type="submit" name="change">Save Change</button>
                                   </form>
                                
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
