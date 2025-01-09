<?php 
session_start();
include_once('includes/config.php');

if(isset($_POST['submit'])) {
    $award_title = $_POST['award_title'];
    $award_date = $_POST['award_date'];
    $category = $_POST['category'];
    $createdby = $_SESSION['aid'];

    // Upload award image
    $award_image = $_FILES["award_image"]["name"];
    $extension = substr($award_image, strlen($award_image)-4, strlen($award_image));
    $allowed_extensions = array(".jpg",".jpeg",".png",".gif");
    
    if(!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
        $new_award_name = md5($award_image).time().$extension;
        move_uploaded_file($_FILES["award_image"]["tmp_name"], "uploads/".$new_award_name);

        $sql = mysqli_query($con, "INSERT INTO awards(title, award_date, category, image, created_by) 
            VALUES('$award_title', '$award_date', '$category', '$new_award_name', '$createdby')");

        if($sql) {
            echo "<script>alert('Award added successfully');</script>";
            echo "<script>window.location.href='manage-awards.php'</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add Award</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <?php include_once('includes/header.php');?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php');?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Award</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Award</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-2">Award Title</div>
                                    <div class="col-4">
                                        <input type="text" placeholder="Enter Award Title" name="award_title" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">Award Date</div>
                                    <div class="col-4">
                                        <input type="date" name="award_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">Category</div>
                                    <div class="col-4">
                                        <input type="text" placeholder="Enter Award Category" name="category" 
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2">Award Image</div>
                                    <div class="col-4">
                                        <input type="file" name="award_image" class="form-control" required>
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
            <?php include_once('includes/footer.php');?>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>