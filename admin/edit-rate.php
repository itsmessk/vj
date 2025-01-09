<?php
session_start();
include_once('includes/config.php');

// Get the rate details by ID
$rate_id = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM rates WHERE id='$rate_id'");
$row = mysqli_fetch_assoc($query);

// Update the rates
if (isset($_POST['submit'])) {
    $gold_rate = $_POST['gold_rate'];
    $silver_rate = $_POST['silver_rate'];

    $sql = mysqli_query($con, "UPDATE rates SET gold_rate='$gold_rate', silver_rate='$silver_rate' WHERE id='$rate_id'");
    echo "<script>alert('Rates updated successfully');</script>";
    echo "<script>window.location.href='manage-rates.php'</script>";
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
    <title>Edit Gold and Silver Rates</title>
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
                    <h1 class="mt-4">Edit Gold and Silver Rates</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Rates</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-2">Gold Rate</div>
                                    <div class="col-4">
                                        <input type="text" value="<?php echo $row['gold_rate']; ?>" name="gold_rate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 1%;">
                                    <div class="col-2">Silver Rate</div>
                                    <div class="col-4">
                                        <input type="text" value="<?php echo $row['silver_rate']; ?>" name="silver_rate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 1%;">
                                    <div class="col-2">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
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
