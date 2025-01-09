<?php
session_start();
//error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['jsmsuid']==0)) {
  header('location:logout.php');
  } else{ 
if(isset($_POST['submit']))
  {
    $uid=$_SESSION['jsmsuid'];
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $query=mysqli_query($con, "update users set FirstName='$fname', LastName='$lname' where id='$uid'");
    if ($query) {
 echo '<script>alert("Profile updated successully.")</script>';
echo '<script>window.location.href=profile.php</script>';
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}
    ?>
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
	
</head>
<body>

	<?php include_once('includes/header.php');?>

	<div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    <div id="title" class="page-title">
                        <div class="section-container">
                            <div class="content-title-heading">
                                <h1 class="text-title-heading">My Profile</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>My profile
                            </div>
                        </div>
                    </div>
					
	<!-- / body -->

	<div id="body">
	
		<div class="container">
			<div id="content" class="full">
				<div class="cart-table" style="color:black;">
				<nav>
		<a href="profile.php"><button class="btn" style="background-color: goldenrod; color: white;">My Account</button></a>

						<a href="my-orders.php"><button class="btn" style="background-color: goldenrod; color: white;">My orders</button></a>
						<a href="change-password.php"><button class="btn" style="background-color: goldenrod; color: white;">Change password</button></a>

					</nav><br>
					 <form action="#" method="post">
					 	<?php
$uid=$_SESSION['jsmsuid'];
$ret=mysqli_query($con,"select * from users where id='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?> 
                                   	      <label> First Name</label>
                                          <input type="text" name="firstname" required="true" class="form-control" value="<?php  echo $row['FirstName'];?>">
                                            <br>
                                          	<label> Last Name</label>
                                          <input type="text" name="lastname" required="true" class="form-control" value="<?php  echo $row['LastName'];?>">
                                           <br>
                                          	<label> Mobile Number</label>
                                          <input type="text" name="mobilenumber" maxlength="10" pattern="[0-9]{10}" readonly="true" class="form-control" value="<?php  echo $row['MobileNumber'];?>">
                                          <br>
                                          	<label> Email address</label>
                                          <input type="email" name="email" required="true" class="form-control" value="<?php  echo $row['Email'];?>"  readonly="true">
                                          <br>
                                          	<label>Registration</label>
                                         <input type="text" name="regdate" value="<?php  echo $row['regDate'];?>"  readonly="true" class="form-control">
                                          <br>
                                          <button class="btn" style="background-color: goldenrod; color: white;" type="submit" name="submit">Save Change</button>
                                   </form>
                                   <?php }?>
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
