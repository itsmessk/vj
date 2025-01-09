<?php
session_start();
include_once('includes/config.php');

// For deleting a rate
if (isset($_GET['del'])) {
    $rate_id = $_GET['del'];
    $sql = mysqli_query($con, "DELETE FROM rates WHERE id='$rate_id'");
    echo "<script>alert('Rate deleted successfully');</script>";
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
    <title>Manage Gold and Silver Rates</title>
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
                    <h1 class="mt-4">Manage Gold and Silver Rates</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Rates</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gold Rate</th>
                                        <th>Silver Rate</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM rates ORDER BY created_at DESC");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td>₹<?php echo $row['gold_rate']; ?></td>
                                            <td>₹<?php echo $row['silver_rate']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td>
                                                <a href="edit-rate.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                                <a href="manage-rates.php?del=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
