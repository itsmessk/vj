<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $contno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $ret = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email' || MobileNumber='$contno'");
    $result = mysqli_fetch_array($ret);
    if ($result > 0) {
        echo '<script>alert("This email or Contact Number is already associated with another account");</script>';
    } else {
        $query = mysqli_query($con, "INSERT INTO users(FirstName, LastName, MobileNumber, Email, Password) VALUES('$fname', '$lname','$contno', '$email', '$password')");
        if ($query) {
            echo '<script>alert("You have successfully registered");</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>VJ - Jewellery</title>
		
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
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap" rel="stylesheet">
    <!-- Your existing head content -->
    <style>
        .signup-container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }

        .signup-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 800px;
        }

        .signup-image {
            background: url('media/product/cat-4-5.jpg') center/cover;
            animation: slideIn 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }

        .signup-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            animation: fadeIn 1s ease-out;
        }

        .signup-form-container {
            padding: 40px;
            animation: slideRight 0.8s ease-out;
        }

        .form-group {
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeUp 0.5s ease-out forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: goldenrod;
            box-shadow: 0 0 0 2px rgba(218,165,32,0.2);
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: black;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background: goldenrod;
            transform: translateY(-2px);
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:active::after {
            width: 200px;
            height: 200px;
            opacity: 0;
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        .required {
            color: #e3342f;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        @keyframes slideRight {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }

        @keyframes fadeUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .signup-grid {
                grid-template-columns: 1fr;
            }

            .signup-image {
                display: none;
            }

            .signup-form-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include_once('includes/header.php');?>
	<div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    <div id="title" class="page-title">
                        <div class="section-container">
                            <div class="content-title-heading">
                                <h1 class="text-title-heading">Signup</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>Signup
                            </div>
                        </div>
                    </div>
    <div class="signup-container">
        <div class="signup-grid">
            <!-- Left side image -->
            <div class="signup-image"></div>
            
            <!-- Right side form -->
            <div class="signup-form-container">
                <h2 class="text-center" style="margin-bottom: 30px;">Create an Account</h2>
                
                <form method="post" action="" class="signup">
                    <div class="form-group">
                        <label>Email Address <span class="required">*</span></label>
                        <input type="email" class="form-control" name="email" required 
                               placeholder="Enter your email">
                    </div>

                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="firstname" required 
                               placeholder="Enter your first name">
                    </div>

                    <div class="form-group">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="lastname" required 
                               placeholder="Enter your last name">
                    </div>

                    <div class="form-group">
                        <label>Mobile Number <span class="required">*</span></label>
                        <input type="text" class="form-control" name="mobilenumber" required 
                               maxlength="10" pattern="[0-9]{10}" 
                               placeholder="Enter your 10-digit mobile number">
                    </div>

                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" class="form-control" name="password" required 
                               placeholder="Enter your password">
                    </div>

                    <div class="form-group">
                        <label>Repeat Password <span class="required">*</span></label>
                        <input type="password" class="form-control" name="repeatpassword" required 
                               placeholder="Repeat your password">
                    </div><br>

                    <div class="form-group">
                        <button type="submit" class="btn" style=" color: white; height: 50px;background-color: black;" name="submit">CREATE ACCOUNT</button>
                    </div>

                    <div class="form-group" style="text-align: center; margin-top: 20px;">
                        <a href="login.php" style="color: #666; text-decoration: none;">
                            Already have an account? Click here to login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>
</body>
</html>