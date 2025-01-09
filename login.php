<?php 
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect if already logged in
if (isset($_SESSION['jsmsuid'])) {
    header('location:index.php');
    exit();
}

if (isset($_POST['login'])) {
    $emailcon = $_POST['emailcont'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "SELECT ID FROM users WHERE (Email='$emailcon' || MobileNumber='$emailcon') && Password='$password'");
    $ret = mysqli_fetch_array($query);
    if ($ret > 0) {
        $_SESSION['jsmsuid'] = $ret['ID'];
        header('location:index.php');
    } else {
        echo "<script>alert('Invalid Details.');</script>";
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
        .login-container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }

        .login-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        .login-image {
            background: url('media/slider/8-2.jpg') center/cover;
            animation: slideIn 0.8s ease-out;
        }

        .login-form-container {
            padding: 40px;
            animation: slideRight 0.8s ease-out;
        }

        .form-group {
            margin-bottom: 25px;
            opacity: 0;
            animation: fadeUp 0.5s ease-out forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-group:nth-child(4) { animation-delay: 0.5s; }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: goldenrod;
            box-shadow: 0 0 0 2px rgba(218,165,32,0.2);
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
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
            .login-grid {
                grid-template-columns: 1fr;
            }

            .login-image {
                display: none;
            }

            .login-form-container {
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
                                <h1 class="text-title-heading">Login</h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="index.php">Home</a><span class="delimiter"></span>Login
                            </div>
                        </div>
                    </div>
    <div class="login-container">
        <div class="login-grid">
            <!-- Left side image -->
            <div class="login-image"></div>
            
            <!-- Right side form -->
            <div class="login-form-container">
                <h2 class="text-center" style="margin-bottom: 30px; padding-top: 50px;">Login</h2>
                
                <form method="post" action="" class="login"> 
                    <div class="form-group">
                        <label>Email or Contact Number <span class="required">*</span></label>
                        <input type="text" class="form-control" name="emailcont" required 
                               placeholder="Enter your email or contact number">
                    </div>

                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" class="form-control" name="password" required 
                               placeholder="Enter your password">
                    </div>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label style="display: flex; align-items: center;">
                                <input type="checkbox" name="rememberme" style="margin-right: 8px;">
                                Remember me
                            </label>
                        </div>
                    </div><br>

                    <div class="form-group" >
                        <button type="submit" class="btn"  name="login" style=" color: white; height: 50px;background-color: black;">LOGIN</button>
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <a href="signup.php" style="color: #666;">
                            Don't have an account? Click here to register
                        </a><br><br>
						<a href="forgot-password.php" style="color: goldenrod;">If you forgot the password, please contact the admin</a>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>
</body>
</html>