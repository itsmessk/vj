<?php 
session_start();
include_once('includes/config.php');

// For deleting a banner
if(isset($_GET['del']))
{
    $id = $_GET['id'];
    $query = mysqli_query($con, "DELETE FROM banners WHERE id='$id'");
    echo "<script>alert('Banner deleted successfully');</script>";
    echo "<script>window.location.href='manage-banners.php'</script>";
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
    <title>Manage Banners</title>
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
                    <h1 class="mt-4">Manage Banners</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Banners</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Link</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = mysqli_query($con, "SELECT * FROM banners");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($query))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($row['title']);?></td>
                                        <td><?php echo htmlentities($row['subtitle']);?></td>
                                        <td><?php echo htmlentities($row['link']);?></td>
                                        <td><img src="uploads/<?php echo htmlentities($row['image']);?>" width="100"></td>
                                        <td>
                                            <a href="edit-banner.php?id=<?php echo $row['id']?>" class="btn btn-primary">Edit</a>
                                            <a href="manage-banners.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $cnt++; } ?>
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
