<?php 
session_start();
include_once('includes/config.php');

// For Adding Banner
if(isset($_POST['submit']))
{
    $banner_title = $_POST['banner_title'];
    $banner_subtitle = $_POST['banner_subtitle'];
    $banner_link = $_POST['banner_link'];
    $createdby = $_SESSION['aid'];

    // Upload banner image
    $banner_image = $_FILES["banner_image"]["name"];
    $extension = substr($banner_image, strlen($banner_image) - 4, strlen($banner_image));
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
    
    if(!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
        $new_banner_name = md5($banner_image) . time() . $extension;
        move_uploaded_file($_FILES["banner_image"]["tmp_name"], "uploads/" . $new_banner_name);

        $sql = mysqli_query($con, "INSERT INTO banners (title, subtitle, link, image, created_by) VALUES('$banner_title', '$banner_subtitle', '$banner_link', '$new_banner_name', '$createdby')");

        echo "<script>alert('Banner added successfully');</script>";
        echo "<script>window.location.href='manage-banners.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add Banner</title>
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
                    <h1 class="mt-4">Add Banner</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Banner</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-2">Banner Title</div>
                                    <div class="col-4">
                                        <input type="text" placeholder="Enter Banner Title" name="banner_title" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">Banner Subtitle</div>
                                    <div class="col-4">
                                        <input type="text" placeholder="Enter Banner Subtitle" name="banner_subtitle" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">Link</div>
                                    <div class="col-4">
                                        <input type="url" placeholder="Enter Link URL" name="banner_link" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">Banner Image</div>
                                    <div class="col-4">
                                        <input type="file" name="banner_image" class="form-control" required>
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
</body>
</html>
